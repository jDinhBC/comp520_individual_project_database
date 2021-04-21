/*
* DML - Data Modification Language
* DML is used for adding (inserting), deleting, and modifying (updating) data in a database
*/

INSERT INTO client(first_name, last_name, email_address, account_type, extra)
VALUES
('Jon', 'Snow', 'jsnow@testmail.com', 'margin', 'I am Jon Snow.'),
('Harry', 'Potter', 'hpotter@testmail.com', 'cash', 'Im a wizard.'),
('Cathie', 'Wood', 'CathieWood@testmail.com', 'cash', 'Buy the dip.'),
('test', 'guy', 'testguy@testmail.com', 'cash', 'please dont break');

INSERT INTO stock (client_id, ticker, shares, purchased_value, purchased_date)
VALUES
(1, 'AMZN', 100, 100, '05/10/2005'),
(1, 'GOOGL', 50, 200, '06/29/2009'),
(2, 'MGIC', 1337, 15, '03/24/2021'),
(2, 'T', 7331, 20, '06/14/2003'),
(3, 'ONV', 674454, 10, '03/10/2021'),
(3, 'CERS', 29572265, 6, '03/10/2021'),
(3, 'PSTG', 41161248, 19, '03/10/2021'),
(4, 'test', 1337, 1337, '10/10/1010'),
(4, 'boo', 9999, 1, '10/10/6010'),
(4, 'blah', 2, 10, '2/10/2010'),
(4, 'reee', 65, 56, '10/10/8010');