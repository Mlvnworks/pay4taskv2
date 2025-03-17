DROP PROCEDURE IF EXISTS request_activation;


/*
	Response code:
    200: OKAY
    199: FAILED TO INSERT REQUEST
    198: USER ALREADY SUBMITTED OR USER ALREADY ACTIVATED
    197: FAILED TO INSERT HISTORY
*/

DELIMITER //
CREATE PROCEDURE request_activation(user_id BIGINT, receipt_file_id text, time BIGINT)
BEGIN 
	-- Declare variables for error handling and status
    DECLARE error_msg VARCHAR(255);
    DECLARE has_error BOOLEAN;
   
    -- Error handling block
    DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING
    BEGIN
        -- Get the SQL exception message
        GET DIAGNOSTICS CONDITION 1 error_msg = MESSAGE_TEXT;

        -- Print or handle the error message as needed
        SELECT CONCAT('SQL Error: ', error_msg) AS status;
        ROLLBACK;
    END;
    
    --  Start transaction
    START TRANSACTION;
    
	-- ---------- Logic  -- ---------- 
    -- CHECK IF THERES EXISTING REQUEST
    IF (SELECT COUNT(*) FROM activation_requests ar WHERE ar.user_id = user_id AND (ar.status = 0 OR ar.status= 1)) > 0 THEN 
		SET error_msg = "198";
		SET has_error = TRUE;
    END IF;
    
    -- INSERT REQUEST 
    INSERT INTO activation_requests(request_id, user_id, receipt_id, status, datetime)
    VALUES(FLOOR(RAND() * 900000000) + 100000000, user_id, receipt_file_id, 0, time);
	IF ROW_COUNT() != 1 THEN 
		SET error_msg = "199";
		SET has_error = TRUE;
	END IF;
    
    -- INSERT HISTORY
    INSERT INTO history(history_id, text, user_id, status, category, datetime)
	VALUES(FLOOR(RAND() * 900000000) + 100000000, "Successfully request for account activation.", user_id, 1, 'account', time);
	IF ROW_COUNT() != 1 THEN 
		SET error_msg = "197";
		SET has_error = TRUE;
	END IF;
    
    -- ---------- -- ---------- -- ---------- 
    -- Rollback if there's an error, otherwise commit
    IF has_error THEN 
        SELECT error_msg, has_error;
        ROLLBACK;
    ELSE 
        SELECT "200" AS error_msg, FALSE as has_error;
        COMMIT;
    END IF;

END ; // DELIMITER ;