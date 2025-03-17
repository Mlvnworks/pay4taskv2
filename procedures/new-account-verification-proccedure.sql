DROP PROCEDURE IF EXISTS new_pending_account;


/*
	Response code:
    
    200: OKay
    199: failed to insert verification record
*/
-- Drop

DELIMITER //
CREATE PROCEDURE new_pending_account(email text, password text, name text, refferal_used bigint, submission_timestamp bigint, expiration bigint)
BEGIN 
	-- Declare variables for error handling and status
    DECLARE error_msg VARCHAR(255);
    DECLARE has_error BOOLEAN;
    DECLARE otp_code INT;
    DECLARE verification_id BIGINT;
    
    
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
    SET otp_code = FLOOR(RAND() * 9000) + 1000;
    SET verification_id = FLOOR(RAND() * 900000000) + 100000000;
    
	INSERT INTO pending_verification_accounts(verification_id, otp_code, email, password,user_name, submission, expired, referral_used)
    VALUES(verification_id, otp_code, email, password, name, submission_timestamp, expiration, refferal_used);
     IF ROW_COUNT() != 1 THEN 
		SET error_msg = "199";
		SET has_error = TRUE;
	END IF;
        
    -- ---------- -- ---------- -- ---------- 
    -- Rollback if there's an error, otherwise commit
    IF has_error THEN 
        SELECT  error_msg, has_error;
        ROLLBACK;
    ELSE 
        SELECT  verification_id, otp_code,expiration, 200 AS error_msg, FALSE as has_error;
        COMMIT;
    END IF;

END ; // DELIMITER ;