DELIMITER //
DROP PROCEDURE IF EXISTS SP_ArchiveCustomersInsert //
CREATE PROCEDURE SP_ArchiveCustomersInsert()
BEGIN

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;

    START TRANSACTION;

        CREATE TABLE IF NOT EXISTS archive_customer
        (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
        ) ENGINE = InnoDB;

        INSERT INTO archive_customer
        SELECT * FROM customer;

        DELETE
        FROM customer;

    COMMIT;

END //