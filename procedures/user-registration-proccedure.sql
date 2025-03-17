DROP PROCEDURE IF EXISTS new_user;

DELIMITER //

CREATE PROCEDURE new_user(verification_id_param BIGINT)
BEGIN 
    DECLARE error_msg VARCHAR(255);
    DECLARE has_error BOOLEAN DEFAULT FALSE;
    DECLARE email TEXT;
    DECLARE password TEXT;
    DECLARE user_id BIGINT;
    DECLARE registration_date BIGINT;
    DECLARE user_name TEXT;
    DECLARE referral_code TEXT;
    DECLARE referral_used BIGINT;
    DECLARE wallet_id BIGINT;
    DECLARE inviter_id BIGINT DEFAULT NULL;

    -- Declare exit handler for SQL errors
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SET has_error = TRUE;
        SELECT error_msg AS error_location, has_error;
    END;

    START TRANSACTION;

    -- Generate IDs
    SET user_id = FLOOR(RAND() * 900000000) + 100000000;
    SET referral_code = FLOOR(RAND() * 900000000) + 100000000;
    SET wallet_id = FLOOR(RAND() * 900000000) + 100000000;

    -- Get user details from pending_verification_accounts
    SET error_msg = "Error at fetching user details";
    SELECT a.email, a.password, a.submission, a.user_name, a.referral_used
    INTO email, password, registration_date, user_name, referral_used
    FROM pending_verification_accounts a
    WHERE a.verification_id = verification_id_param
    LIMIT 1;

    -- If no data found, rollback and exit
    IF email IS NULL THEN
        SET error_msg = "Error: No data found in pending_verification_accounts";
        SET has_error = TRUE;
        ROLLBACK;
        SELECT error_msg, has_error;
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = error_msg;
    END IF;

    -- Get inviter ID if referral was used
    SET error_msg = "Error at fetching inviter ID";
    IF referral_used != -1 THEN
        SELECT user_id INTO inviter_id  
        FROM users 
        WHERE referral_code = referral_used
        LIMIT 1;
    END IF;

    -- Check if account already exists
    SET error_msg = "Error: Duplicate email check";
    IF (SELECT COUNT(*) FROM users u WHERE u.email = email) > 0 THEN 
        SET error_msg = "199 - Email already exists";
        SET has_error = TRUE;
        ROLLBACK;
        SELECT error_msg, has_error;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = error_msg;
    END IF;

    -- Insert new user
    SET error_msg = "Error at inserting into users table";
    INSERT INTO users(user_id, name, email, referral_code, status, registration_date, password, referral_used, last_claim)
    VALUES(user_id, user_name, email, referral_code, 0, registration_date, password, referral_used, 0);

    -- Create wallet
    SET error_msg = "Error at inserting into wallet table";
    INSERT INTO wallet(wallet_id, user_id, earning, referral_commision, energy)
    VALUES(wallet_id, user_id, 0, 0, 0);

    -- Insert history
    SET error_msg = "Error at inserting into history table (account creation)";
    INSERT INTO history(history_id, text, user_id, status, category, datetime)
    VALUES(FLOOR(RAND() * 900000000) + 100000000, 'Successfully created an account!', user_id, 1, 'profile account', registration_date);

    -- Create history for inviter if referral is used
    IF referral_used != -1 AND inviter_id IS NOT NULL THEN 
        SET error_msg = "Error at inserting referral history";
        INSERT INTO history(history_id, text, user_id, status, category, datetime)
        VALUES(FLOOR(RAND() * 900000000) + 100000000, CONCAT(user_name, ' used your referral code.'), inviter_id, 1, 'referral', registration_date);
    END IF;

    -- Commit transaction if everything is successful
    COMMIT;
    SELECT user_id, 200 AS error_msg, FALSE AS has_error;
END //

DELIMITER ;
