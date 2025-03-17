DROP PROCEDURE IF EXISTS claim_energy;


/*
	Response code:
    200: OKAY
	199: ENERGY ALREADUY CLAIM
    198: FAILED T0 UPDATE USER'S ENERGY
    197: FAILED TO INSERT RECORD TO HISTORY
    196: FAILED TO UPDATE USER'S LAST CLAIM
*/

DELIMITER //
CREATE PROCEDURE claim_energy(uid BIGINT, day_of_year INT, time BIGINT)
BEGIN 
	-- Declare variables for error handling and status
    DECLARE error_msg VARCHAR(255);
    DECLARE has_error BOOLEAN;
	DECLARE last_claim INT;
	DECLARE user_status INT;
   
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
	-- CHECK IF THE USER CAN CLAIM
    SELECT u.last_claim, u.status INTO last_claim, user_status FROM users u WHERE u.user_id = uid;
    
	iF last_claim = day_of_year THEN
		SET error_msg = "199";
		SET has_error = TRUE;
    END IF;

	IF user_status = 1 THEN 
		 -- REWARD ENERGY 
		UPDATE wallet w SET  w.energy = (w.energy + 10) WHERE w.user_id = uid;
		IF ROW_COUNT() != 1 THEN 
			SET error_msg = "198";
			SET has_error = TRUE;
		END IF;
        
	ELSE
		 -- REWARD ENERGY 
		UPDATE wallet w SET  w.energy = (w.energy + 3) WHERE w.user_id = uid;
		IF ROW_COUNT() != 1 THEN 
			SET error_msg = "198";
			SET has_error = TRUE;
		END IF;
    END IF;
   
    
    
	-- UPDATE LAST CLAIM DATE 
    UPDATE users u SET u.last_claim = day_of_year WHERE u.user_id = uid;
    IF ROW_COUNT() != 1 THEN 
		SET error_msg = "196";
		SET has_error = TRUE;
	END IF;
    
    -- INSERT INTO HISTORY
    INSERT INTO history(history_id, text, user_id, status, category, datetime)
	VALUES(FLOOR(RAND() * 900000000) + 100000000, "Daily energy reward succesfully claimed!", uid, 1, 'energy accoun', time);
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