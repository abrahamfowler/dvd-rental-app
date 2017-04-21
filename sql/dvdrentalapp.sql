DROP TABLE IF EXISTS producer, inventory, orderline, transaction, customer, movies, stars, movietitle, Order_Confirmation, Products, Orders,Customer_Card_Details, Customers, members;

CREATE TABLE stars (
	id INT AUTO_INCREMENT,
	first_name VARCHAR(50),
	last_name VARCHAR(50),
	PRIMARY KEY(id)
) ENGINE=InnoDB;


CREATE TABLE movies (
	ean VARCHAR(8) NOT NULL,
	title VARCHAR(50) NOT NULL,
	artist_id INT,
	genre VARCHAR(50),
	year YEAR(4),
	price DECIMAL(10, 2) unsigned NOT NULL,
	PRIMARY KEY (ean),
  FOREIGN KEY (artist_id)
		REFERENCES artist (id)
	ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE customer (
	id INT AUTO_INCREMENT,
	first_name VARCHAR(50) NOT NULL,
	last_name VARCHAR(50) NOT NULL,
	email_address VARCHAR(50) NOT NULL,
	address_1 VARCHAR(50) NOT NULL,
	address_2 VARCHAR(50),
	postcode VARCHAR(10) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE TABLE transaction (
	id INT AUTO_INCREMENT,
	customer_id INT NOT NULL,
	delivery_method INT,
	dt_date DATETIME,
	PRIMARY KEY (id),
FOREIGN KEY (customer_id)
		REFERENCES customer(id)
) ENGINE=InnoDB;


CREATE TABLE orderline (
	id INT AUTO_INCREMENT,
	transaction_id INT,
	record_ean CHAR(8),
	quantity INT NOT NULL,
	PRIMARY KEY (id),
FOREIGN KEY (transaction_id)
		REFERENCES transaction(id),
	FOREIGN KEY (record_ean)
		REFERENCES record(ean)
	ON UPDATE CASCADE
	ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE movietitle(
id INT AUTO_INCREMENT,
movietitle VARCHAR(50),
releasedate INT,
playingtime INT,
PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE inventory (
	stock INT DEFAULT 0,
	record_ean CHAR(8),
	PRIMARY KEY (stock, record_ean),
	FOREIGN KEY (record_ean)
		REFERENCES record (ean)
) ENGINE=InnoDB;

CREATE TABLE producer(
	id INT AUTO_INCREMENT,
	title VARCHAR(70),
	first_name VARCHAR(50),
    last_name VARCHAR(50),
    year INT,
    PRIMARY KEY(id)
) ENGINE=InnoDB;
 
CREATE TABLE Customers(
Customer_ID INT AUTO_INCREMENT,
Title VARCHAR(20),
First_Name TINYTEXT,
Last_Name TINYTEXT,
PRIMARY KEY(Customer_ID)
)ENGINE=InnoDB;

CREATE TABLE Customer_Card_Details(
Customer_EAN CHAR(8) NOT NULL,
Customer_ID INT,
Card_Number VARCHAR(20),
Card_Expiry_Date DATE,
Card_Security_No VARCHAR(6),
Date_Of_Birth DATE,
Address_Line_1 TINYTEXT,
Address_Line_2 TINYTEXT,
City VARCHAR(50),
Postcode CHAR(8),
PRIMARY KEY(Customer_EAN,Customer_ID),
FOREIGN KEY(Customer_ID) REFERENCES Customers(Customer_ID)
)ENGINE=InnoDB;

CREATE TABLE Orders(
Order_ID INT AUTO_INCREMENT,
Customer_ID INT,
Order_Date DATE,
Quantity INT,
Ship_Date DATE,
Price DECIMAL(5,2) unsigned,
Description TINYTEXT,
PRIMARY KEY(Order_ID),
FOREIGN KEY(Customer_ID) REFERENCES Customers(Customer_ID)
)ENGINE=InnoDB;

CREATE TABLE Products(
Product_ID INT AUTO_INCREMENT,
Category VARCHAR(60),
Product_Name VARCHAR(50) NOT NULL,
Product_Description TINYTEXT,
Price DECIMAL(5,2) unsigned,
Expiry_Date DATE,
Discount_Percentage INT,
No_of_Products INT,
PRIMARY KEY(Product_ID)
) ENGINE=InnoDB;

CREATE TABLE Order_Confirmation(
Order_Confirmed_ID INT AUTO_INCREMENT,
Customer_ID INT,
Order_ID INT,
Product_ID INT,
Date_Confirmed DATE,
PRIMARY KEY(Order_Confirmed_ID),
FOREIGN KEY(Customer_ID) REFERENCES Customers(Customer_ID),
FOREIGN KEY(Order_ID) REFERENCES Orders(Order_ID),
FOREIGN KEY(Product_ID) REFERENCES Products(Product_ID)
) ENGINE=InnoDB;

CREATE TABLE members (
id int(4) NOT NULL auto_increment,
username varchar(65) NOT NULL default '',
password varchar(65) NOT NULL default '',
PRIMARY KEY (`id`)
) ENGINE=InnoDB;


