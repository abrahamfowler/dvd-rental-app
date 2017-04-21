INSERT INTO stars (id, first_name, last_name) 
VALUES
(NULL, 'Roberto', 'Orci'),
(NULL, 'Brad', 'Pitt'),
(NULL, 'Anthony', 'Hopkins'),
(NULL, 'Christian', 'Bale'),
(NULL, 'Bruce', 'Willis'),
(NULL, 'Ben', 'Affleck');

INSERT INTO movies (ean, title, artist_id, genre, year, price) 
VALUES
('00562056', 'Transformers', 1, 'Action', 2013,17.99 ),
('50264967', 'Spiderman', 1, 'Action', 2014, 15.99 ),
('00748396', 'Batman', 1, 'Action', 2015, 10.99 ),
('00495739', 'Captain America Winter Soldier', 1, 'Action', 2013, 12.99 ),
('00738432', 'Lala Land', 2, 'Action', 2015, 7.99 ),
('50847583', 'Luke Cage', 2, 'Action', 2012, 12.99 ),
('30748743', 'Kill Zone 2', 3, 'Action', 2011, 23.99 ),
('50856384', 'Louder Than Bombs', 5, 'Action', 2011, 10.99 ),
('50264972', 'The Invitation', 5, 'Action', 2011, 8.99 ),
('00649573', 'Hush', 6, 'Action', 2010, 19.99 ),
('00625485', 'Embrace The Serpent', 4, 'Action', 2005, 14.99 );

INSERT INTO customer (id, first_name, last_name, email_address, address_1, address_2, postcode)
VALUES
(NULL, 'Bob', 'Smith', 'bsmith@gmail.com', '63 bang street', 'London', 'DA8 45D'),
(NULL, 'John', 'Upson', 'john@gmail.com', '4 barrington road', 'Newham', 'B345 TR3'),
(NULL, 'Lucas', 'Hedge', 'lucas@gmail.com', '9 dummy lane', 'Arkham Asylum', 'NG11 0HG'),
(NULL, 'Jim', 'Jones', 'jimjones@gmail.com', '88  jamaica road', 'London', 'MR44 9HW'),
(NULL, 'Kyle', 'Clark', 'kyle@gmail.com', '34  strange street', 'Los Vegas', '4R44 9TR'),
(NULL, 'Benjamin', 'Phillips', 'bphillips@gmail.com', '99 Townsville', 'Miami', '67T4 95R');
INSERT INTO transaction (id, customer_id, delivery_method, dt_date)
VALUES
(NULL, 1, 2, '2017-03-8 14:34:58'),
(NULL, 1, 2, '2017-06-7 11:22:35'),
(NULL, 3, 1, '2017-04-14 19:47:03'),
(NULL, 2, 1, '2017-05-11 22:01:19');

INSERT INTO orderline (id, transaction_id, record_ean, quantity)
VALUES
(NULL, 1, '00562056', 1),
(NULL, 1, '00495739', 1),
(NULL, 2, '00649573', 2),
(NULL, 2, '00495739', 1),
(NULL, 3, '00738432', 2),
(NULL, 3, '00562056', 1),
(NULL, 3, '00625485', 1),
(NULL, 4, '00562056', 2);

INSERT INTO movietitle(id, movietitle, releasedate, playingtime)
VALUES
(NULL, 'Batman', 2013, 90),
(NULL, 'Superman', 2013, 120),
(NULL, 'Luke Cage', 2013, 90),
(NULL, 'Daredevil', 2013, 120),
(NULL, 'Hulk', 2013, 90);



INSERT INTO inventory (stock, record_ean) 
VALUES
(25, '00562056'),
(18, '50264967'),
(15, '00748396'),
(20, '00495739'),
(10, '00738432'),
(7, '50847583'),
(3, '30748743'),
(34, '50856384'),
(22, '50264972'),
(15, '00649573'),
(12, '00625485');

INSERT INTO producer (id, title, first_name, last_name,year) 
VALUES
(NULL,'Mr', 'Jeremy', 'Smith',2015),
(NULL,'Mr', 'Jason', 'Clark',2011),
(NULL,'Ms', 'Manny', 'Phillipe',2012),
(NULL, 'Mr','Barry', 'Stevens',2013),
(NULL, 'Mr','Tomi', 'Dirk',2014),
(NULL, 'Mr','Julius', 'Riggles',2015);

INSERT INTO Customers (Customer_ID,Title, First_Name, Last_Name)
	VALUES (NULL,'Mr','abraham','fowler'),
		   (NULL,'Mr','phil','harris');

INSERT INTO Customer_Card_Details(Customer_EAN,Customer_ID,Card_Number,Card_Expiry_Date,Card_Security_No,Date_Of_Birth,Address_Line_1,Address_Line_2,City, PostCode)
	VALUES('00562056',1,3214576542318798,09/04/2019,312444,01/04/1971,'123 ABC Road',Null,'London','W168G6'),
    	  ('50264967',2,985427658768743,09/08/2019,312444,01/04/1971,'456 DEF Road',Null,'London','R168G6');
    	  
INSERT INTO Orders (Order_ID,Customer_ID,Order_Date,Quantity,Ship_Date,Price,Description)
	VALUES(NULL,1,'05-04-2015','1','07/04/2015','3.40',NULL),
		  (NULL,2,'26-06-2015','3','28/04/2015','12.19',NULL),
		  (NULL,1,'12-04-2015','7','14/04/2015','23.30',NULL);


INSERT INTO Products (Product_ID,Category,Product_Name,Product_Description,Price,Expiry_Date,Discount_Percentage,No_Of_Products)
	VALUES(NULL,'CD AND DVD','marvel cd','action','1.75','12-12-2015',NULL,'30'),
	(NULL,'CD AND DVD','marvel cd','action','2.55','22-06-2015',NULL,'20'),
	(NULL,'CD AND DVD','DC cd','action','2.75','11-11-2015',NULL,'30'),
	(NULL,'CD AND DVD','DC cd','action','0.75','05-05-2015',NULL,'20'),
	(NULL,'CD AND DVD','marvel cd','action','3.75','11-11-2015',NULL,'10'),
	(NULL,'CD AND DVD','marvel cd','action','0.45','01-02-2015',NULL,'20'),
	(NULL,'CD AND DVD','marvel cd','action','1.65','11-03-2015',NULL,'20'),
	(NULL,'Headphones & phones','beats','best sound quality','0.50',Null,NULL,'20'),
	(NULL,'Headphones & phones','skullcandy','best sound quality','0.50',Null,NULL,'20'),
	(NULL,'Headphones & phones','apple','best sound quality','0.50',Null,NULL,'20');


INSERT INTO Order_Confirmation(Order_Confirmed_ID,Customer_ID,Order_ID,Product_ID,Date_Confirmed)
	VALUES(NULL,1,1,1,07-04-2015),
	(NULL,2,2,1,28-04-2015),
	(NULL,2,2,1,28-04-2015),
	(NULL,2,2,1,28-04-2015),
	(NULL,1,3,1,14-04-2015),
	(NULL,1,3,1,14-04-2015),
	(NULL,1,3,1,14-04-2015),
	(NULL,1,3,1,14-04-2015),
	(NULL,1,3,1,14-04-2015),
	(NULL,1,3,1,14-04-2015),
	(NULL,1,3,1,14-04-2015);
--
INSERT INTO members VALUES (1, 'john', '1234');