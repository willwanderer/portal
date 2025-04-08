CREATE DEFINER=`root`@`localhost` PROCEDURE `validasilogin`(IN emailbpk VARCHAR(255), IN pass VARCHAR(255))
BEGIN
    DECLARE stored_pass VARCHAR(255);
    	
    SELECT PEG_PASS INTO stored_pass
    FROM vpegawai
    WHERE PEG_EMAIL_BPK = emailbpk and PEG_STATUS='Aktif';

    IF stored_pass IS NULL OR stored_pass = '' THEN
        SET stored_pass = SUBSTRING_INDEX(emailbpk, '.', 1);
    END IF;

    IF stored_pass = pass THEN
        SELECT * 
        FROM vpegawai 
        WHERE PEG_EMAIL_BPK = emailbpk;
    ELSE
        SELECT 'Invalid credentials' AS message;
    END IF;
END