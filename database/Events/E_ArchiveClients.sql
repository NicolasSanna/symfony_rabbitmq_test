DROP EVENT IF EXISTS E_ArchiveCustomers;
CREATE EVENT E_ArchiveCustomers
ON SCHEDULE EVERY 5 MINUTE
DO
    CALL SP_ArchiveCustomersInsert();