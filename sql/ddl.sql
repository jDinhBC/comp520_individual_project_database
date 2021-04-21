/*
* DDL - Data Definition Language
* DDL is the SQL commands for creating and modifying database objects such as tables, indices, and users.
*/

DROP DATABASE IF EXISTS brokerage;
CREATE DATABASE brokerage;
USE brokerage;

CREATE TABLE client (
    id int NOT NULL AUTO_INCREMENT,
    first_name varchar(255) NOT NULL,
    last_name varchar(255) NOT NULL,
    email_address varchar(255) NOT NULL UNIQUE,
    account_type varchar(255) NOT NULL,
    extra varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE stock (
    stock_id int NOT NULL AUTO_INCREMENT,
    client_id int,
    ticker char(5) NOT NULL,
    shares int NOT NULL,
    purchased_value int NOT NULL,
    purchased_date varchar(255) NOT NULL,
    PRIMARY KEY (stock_id),
    FOREIGN KEY (client_id) REFERENCES client(id)
);