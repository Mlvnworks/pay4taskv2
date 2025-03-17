DROP PROCEDURE IF EXISTS check_admin_access;


/*
	Response code:
    
    404: admin not found
    400: admin found but not approved
    200: admin found
    199: Failed to request access
    399: Failed to generate review request
    388: Failed to update admin status
*/
-- Drop

DELIMITER //
CREATE PROCEDURE check_admin_access(device text, timestamp bigint)
BEGIN 
	-- Declare variables for error handling and status
    DECLARE error_msg VARCHAR(255) ;
    DECLARE has_error BOOLEAN;
    DECLARE admin_id BIGINT;
    DECLARE review_id BIGINT;
    
    
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
	
    
    if (SELECT COUNT(1) FROM admin a WHERE a.device = (device COLLATE utf8mb4_general_ci) and a.status = 1) > 0 THEN
		set error_msg = "200";
		set has_error = FALSE;
        
    ELSEIF (SELECT COUNT(1) FROM admin a WHERE a.device = (device COLLATE utf8mb4_general_ci) and a.status = 0) > 0 THEN 
		set error_msg = "400";
		set has_error = FALSE;

    ELSE 
		SET admin_id = FLOOR(RAND() * 900000000) + 100000000;
        SET review_id = FLOOR(RAND() * 900000000) + 100000000;
        
		set error_msg = "404";
        set has_error = FALSE;
        
		-- Create Pending status
        INSERT INTO admin(admin_id, name, device, date_added, status)
        VALUES(admin_id, "", device, timestamp, -1);
        
        IF ROW_COUNT() != 1 THEN 
			SET error_msg = "199";
			SET has_error = TRUE;
		END IF;
		
		-- GENERATE REVIEW
		INSERT INTO admin_review(request_id, admin_id, expiration_time, request_date)
		VALUES(review_id, admin_id, timestamp + (20 * 60), timestamp);
		IF ROW_COUNT() != 1 THEN 
			SET error_msg = "399";
			SET has_error = TRUE;
		END IF;
        
        -- UPDATE ADMIN STATUS
        UPDATE admin a set a.status = 0 WHERE a.admin_id = admin_id;
		IF ROW_COUNT() != 1 THEN 
			SET error_msg = "388";
			SET has_error = TRUE;
		END IF;
    END IF;
    
    -- ---------- -- ---------- -- ---------- 
    -- Rollback if there's an error, otherwise commit
    IF has_error THEN 
        SELECT error_msg, has_error;
        ROLLBACK;
    ELSE 
        SELECT review_id, error_msg, FALSE as has_error;
        COMMIT;
    END IF;

END ; // DELIMITER ;