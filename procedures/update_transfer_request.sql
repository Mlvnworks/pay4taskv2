DROP PROCEDURE IF EXISTS update_transfer_request;


/*
	Response code:
    200: OKAY
	199: FAILED TO UPDATE REQUEST STATUS
    198: FAILED TO INSERT HISTORY
    197: FAILED TO REFUND
    
*/

DELIMITER //
CREATE PROCEDURE update_transfer_request(request_id BIGINT, status INT, time BIGINT)
BEGIN 
	-- Declare variables for error handling and status
    DECLARE error_msg VARCHAR(255);
    DECLARE has_error BOOLEAN;
   DECLARE user_id BIGINT;
   DECLARE amount DECIMAL(50, 2);
   
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
    SELECT tr.user_id, tr.amount INTO user_id, amount FROM  transfer_request tr WHERE tr.request_id = request_id;
    
	-- UPDATE REQUEST STATUS
    UPDATE transfer_request tr SET tr.status = status WHERE tr.request_id = request_id;
	IF ROW_COUNT() != 1 THEN 
		SET error_msg = "199";
		SET has_error = TRUE;
	END IF;
    
    
    -- CHECK THE STATUS
    IF status = 1 THEN
		INSERT INTO history(history_id, text, user_id, status, category, datetime)
		VALUES(FLOOR(RAND() * 900000000) + 100000000, "Transfer request successfully approved!", user_id, 1, 'transfer account', time);
		IF ROW_COUNT() != 1 THEN 
			SET error_msg = "198";
			SET has_error = TRUE;
		END IF;
    ELSEIF status = -1 THEN 
		-- REFUND THE TRANSFER BALANCE
        UPDATE wallet w SET w.earning = (w.earning + amount) WHERE w.user_id = user_id;
        IF ROW_COUNT() != 1 THEN 
			SET error_msg = "197";
			SET has_error = TRUE;
		END IF;
        
        INSERT INTO history(history_id, text, user_id, status, category, datetime)
		VALUES(FLOOR(RAND() * 900000000) + 100000000, "Failed to process transfer request!", user_id, 1, 'transfer account', time),
			(FLOOR(RAND() * 900000000) + 100000000, concat("Transfer amount refund ₱", amount), user_id, 1, 'transfer account', time) ;
		
        IF ROW_COUNT() != 2 THEN 
			SET error_msg = "198";
			SET has_error = TRUE;
		END IF;
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