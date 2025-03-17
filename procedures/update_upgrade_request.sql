DROP PROCEDURE IF EXISTS update_upgrade_request;


/*
	Response code:
    200: OKAY
    199: FAILED TO UPDATE REQUEST STATUS
    198: FAILED TO UPDATE INVITER EARNING
    197: FAILED TO INSERT INVITER HISTORY
	196: FAILED TO ICREASE USER'S ENERGY
    195: FAILED TO INSERT USERS ENERGY HISTORY
    194: FAILED TO UPDATE USERS'S ACCOUNT STATUS
*/

DELIMITER //
CREATE PROCEDURE update_upgrade_request(request_id BIGINT, action INT, time BIGINT)
BEGIN 
	-- Declare variables for error handling and status
    DECLARE error_msg VARCHAR(255);
    DECLARE has_error BOOLEAN;
	DECLARE inviter_id BIGINT;
    DECLARE user_id BIGINT;
    DECLARE referral_used BIGINT;
    
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
    SELECT ar.user_id,
		u.referral_used,
		(SELECT uu.user_id FROM users uu WHERE uu.referral_code = u.referral_used)
    INTO user_id,
		referral_used,
		inviter_id
    FROM activation_requests ar 
    JOIN users u ON ar.user_id = u.user_id
    WHERE ar.request_id = request_id;
    
   -- CHANGE THE STATUS OF THE REQUEST 
   UPDATE activation_requests ar SET ar.status = action WHERE ar.request_id = request_id;
   IF ROW_COUNT() != 1 THEN 
		SET error_msg = "199";
		SET has_error = TRUE;
	END IF;
    
	IF action = 1 THEN
		-- REWARD THE INVITER
		IF referral_used != -1 THEN 
			IF inviter_id IS NOT NULL THEN  
				-- ADD REWARD TO THE INVITER
                UPDATE wallet w SET w.earning = (w.earning + 50) WHERE w.user_id = inviter_id;
                 IF ROW_COUNT() != 1 THEN 
					SET error_msg = "198";
					SET has_error = TRUE;
				END IF;

				-- INSERT HISTORY
				INSERT INTO history(history_id, text, user_id, status, category, datetime)
				VALUES(FLOOR(RAND() * 900000000) + 100000000, "Referral reward + P50 earning", inviter_id, 1, 'account earning', time);
				IF ROW_COUNT() != 1 THEN 
					SET error_msg = "197";
					SET has_error = TRUE;
				END IF;
			END IF;
        END IF;
		
        -- UPDATE USERS'S STATUS 
        UPDATE users u SET u.status = 1 WHERE u.user_id = user_id;
		 IF ROW_COUNT() != 1 THEN
			SET error_msg = "194";
			SET has_error = TRUE;
		END IF;
        
        -- INCREMENT THE USER'S ENERGY
        UPDATE wallet w SET w.energy = (w.energy + 10) WHERE w.user_id = user_id;
		 IF ROW_COUNT() != 1 THEN
			SET error_msg = "196";
			SET has_error = TRUE;
		END IF;
        
        -- INSERT HISTORY
		INSERT INTO history(history_id, text, user_id, status, category, datetime)
		VALUES(FLOOR(RAND() * 900000000) + 100000000, "Account successfully upgraded! +10 energy", user_id, 1, 'energy account', time);
		IF ROW_COUNT() != 1 THEN 
			SET error_msg = "195";
			SET has_error = TRUE;
		END IF;
	
    ELSEIF action = -1 THEN 
		 -- INSERT HISTORY
		INSERT INTO history(history_id, text, user_id, status, category, datetime)
		VALUES(FLOOR(RAND() * 900000000) + 100000000, "Upgrade request was declined!", user_id, 1, 'account', time);
		IF ROW_COUNT() != 1 THEN 
			SET error_msg = "195";
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