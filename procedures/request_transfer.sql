DROP PROCEDURE IF EXISTS request_transfer;


/*
	Response code:
    200: OKAY
	199: INSUFFICIENT EARNING
    198: FAILED TO INSERT REQUEST 
    197: FAILED TO DEDUCT USER'S EARNING
    196: FAILED TO INSERT HISTORY
*/

DELIMITER //
CREATE PROCEDURE request_transfer(account TEXT, user_id BIGINT, method text, time BIGINT)
BEGIN 
	-- Declare variables for error handling and status
    DECLARE error_msg VARCHAR(255);
    DECLARE has_error BOOLEAN;
	DECLARE earning DECIMAL(50, 2);
	DECLARE request_id BIGINT;
    
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
    SET request_id = FLOOR(RAND() * 900000000) + 100000000;
    SELECT w.earning INTO earning FROM wallet w WHERE w.user_id = user_id;
    
	-- CHECK USERS CURRENT EARNING
    IF (SELECT w.earning FROM wallet w WHERE w.user_id = user_id) < 5 THEN 
		SET error_msg = "199";
		SET has_error = TRUE;
    END IF;
		
	-- INSERT REQUEST TO TRANSFER_REQUEST TABLE
    INSERT INTO transfer_request(request_id, user_id, method, account, amount, request_date, status)
    VALUES(request_id, user_id, method, account, earning, time, 0);
    IF ROW_COUNT() != 1 THEN 
		SET error_msg = "198";
		SET has_error = TRUE;
	END IF;
    
    -- DEDUCT USER EARNING
    UPDATE wallet SET wallet.earning = 0 WHERE wallet.user_id = user_id;
    IF ROW_COUNT() != 1 THEN 
		SET error_msg = "197";
		SET has_error = TRUE;
	END IF;
    
     -- INSERT INTO HISTORY
    INSERT INTO history(history_id, text, user_id, status, category, datetime)
	VALUES(FLOOR(RAND() * 900000000) + 100000000, "Tranfer successfully requested!", user_id, 1, 'earning transfer', time);
	IF ROW_COUNT() != 1 THEN 
		SET error_msg = "196";
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