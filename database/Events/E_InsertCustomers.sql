DROP EVENT IF EXISTS E_InsertCustomers;
CREATE EVENT E_InsertCustomers
ON SCHEDULE EVERY 1 MINUTE
DO
    INSERT INTO customer (firstname, lastname)
    VALUES('Test', 'TEST');