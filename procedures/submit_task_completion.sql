DROP PROCEDURE IF EXISTS submit_task_completion;


/*
	Response code:
    200: OKAY
	199: FAILED TO INSERT PROOF
    198: FAILED TO record history
    197: FAILED TO UPDATE USER'S ENERGY
    196: INSUFFICIENT ENERGY
*/

DELIMITER //
CREATE PROCEDURE submit_task_completion(uid BIGINT, uploaded_file_id TEXT, time BIGINT, task_id BIGINT)
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
    -- CHECK IF ENERGY IS SUFFICIENT
    IF (SELECT wallet.energy FROM wallet WHERE wallet.user_id = uid) <= 0 THEN 
		SET error_msg = "196";
		SET has_error = TRUE;
    END IF;
    
	INSERT INTO task_submission(submission_id, user_id, task_id,proof_file_id, date_submitted, status)
    VALUES(FLOOR(RAND() * 900000000) + 100000000, uid,task_id, uploaded_file_id, time, 0);
	IF ROW_COUNT() != 1 THEN 
		SET error_msg = "199";
		SET has_error = TRUE;
	END IF;
	
	-- UPDATE USER'S ENERGY
    UPDATE wallet SET wallet.energy = ( wallet.energy - 1) WHERE user_id = uid;
    IF ROW_COUNT() != 1 THEN 
		SET error_msg = "197";
		SET has_error = TRUE;
	END IF;
    
    
	  -- INSERT INTO HISTORY
    INSERT INTO history(history_id, text, user_id, status, category, datetime)
	VALUES(FLOOR(RAND() * 900000000) + 100000000, concat("Proof successfully submitted task id: ",task_id), uid, 1, 'task completion', time);
	IF ROW_COUNT() != 1 THEN 
		SET error_msg = "198";
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