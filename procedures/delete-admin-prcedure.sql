DROP PROCEDURE IF EXISTS admin_review_action;


/*
	Response code:
    199: Failed to decline admin
    198: failed to approve admin
	197: failed to remove record on admin_review
    200: OKAY
    
    
*/

DELIMITER //
CREATE PROCEDURE admin_review_action(gadmin_id bigint, action int)
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
	-- UPDATE ADMIN STATUS
    
    IF action = -1 OR action = -2 THEN 
		-- IF THE ADMIN WAS DECLINED REMOVE THE ADMIN'S RECORD
		DELETE FROM admin WHERE admin_id = gadmin_id;
        IF ROW_COUNT() != 1 THEN
			SET error_msg = "199";
			SET has_error = TRUE;
		END IF;
        
	ELSEIF action = 1 THEN 
		-- IF THE ADMIN WAS APPROVE SET THE ADMIN'S STATUS TO 1
		 UPDATE admin a SET a.status = 1 WHERE a.admin_id = gadmin_id;
         IF ROW_COUNT() != 1 THEN 
			SET error_msg = "198";
			SET has_error = TRUE;
		END IF;
    END IF;
    
    -- REMOVE REQUEST RECORD
    DELETE FROM admin_review WHERE admin_id = gadmin_id;
   IF (ROW_COUNT() != 1 AND action != -2) THEN 
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