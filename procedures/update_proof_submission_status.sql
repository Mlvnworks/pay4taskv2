DROP PROCEDURE IF EXISTS update_proof_status;


/*
	Response code:
    200: OKAY
    199: FAILED TO UPDATE SUBMISSION STATUS
	198: FAILED TO ADJUST USER'S EARNING
    197: FAILED TO RECORD ON HISTORY
    196: FAILED TO UPDATE OVERALL SPENT
*/

DELIMITER //
CREATE PROCEDURE update_proof_status(proof_id BIGINT, status INT, time BIGINT)
BEGIN 
	-- Declare variables for error handling and status
    DECLARE error_msg VARCHAR(255);
    DECLARE has_error BOOLEAN;
   DECLARE task_reward DECIMAL(50,2);
   DECLARE user_id BIGINT;
   DECLARE task_id BIGINT;
   
   
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
    -- get task_id and user_id
    SELECT ts.task_id, 
			ts.user_id 
    INTO task_id, 
		user_id 
    FROM task_submission ts
    WHERE ts.submission_id = proof_id;
    
    IF (SELECT COUNT(*) FROM task t WHERE t.task_id = task_id) > 0 THEN 
		-- get task_reward
		SELECT t.task_reward
		INTO task_reward
		FROM task t
		WHERE t.task_id = task_id;
		
		
		-- UPDATE STATUS
		UPDATE task_submission ts 
		SET ts.status = status 
		WHERE ts.submission_id = proof_id;
		IF ROW_COUNT() != 1 THEN 
			SET error_msg = "199";
			SET has_error = TRUE;
		END IF;
		
		
		iF status = 1 THEN
			-- ADD REWARD
			UPDATE wallet w 
			SET w.earning = w.earning + task_reward
			WHERE w.user_id = user_id;
			IF ROW_COUNT() != 1 THEN 
				SET error_msg = "198";
				SET has_error = TRUE;
			END IF;
			
			-- UPDATE TASK OVERALL SPENT
            UPDATE task t 
            SET t.overall_spent = (t.overall_spent + t.task_reward)
            WHERE t.task_id = task_id;
            IF ROW_COUNT() != 1 THEN 
				SET error_msg = "196";
				SET has_error = TRUE;
			END IF;
            
			-- ADD HISTORY 
			-- INSERT INTO HISTORY
			INSERT INTO history(history_id, text, user_id, status, category, datetime)
			VALUES(FLOOR(RAND() * 900000000) + 100000000, concat("Task completion approved! task id: ", task_id), user_id, 1, 'wallet earning energy', time);
			IF ROW_COUNT() != 1 THEN 
				SET error_msg = "197";
				SET has_error = TRUE;
			END IF;
			
		ELSEIF status = -1 THEN 
			-- ADD HISTORY 
			-- INSERT INTO HISTORY
			INSERT INTO history(history_id, text, user_id, status, category, datetime)
			VALUES(FLOOR(RAND() * 900000000) + 100000000, concat("Task completion declined! task id: ", task_id), user_id, 1, 'task', time);
			IF ROW_COUNT() != 1 THEN 
				SET error_msg = "197";
				SET has_error = TRUE;
			END IF;
		END IF;
        
	ELSE 
		UPDATE task_submission ts 
		SET ts.status = -1
		WHERE ts.submission_id = proof_id;
        
		IF ROW_COUNT() != 1 THEN 
			SET error_msg = "199";
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