SELECT id, first_name, last_name FROM stars;
SELECT title FROM record 
WHERE year = 2011
AND genre = "Action";
SELECT id, first_name, last_name, email_address, address_1, address_2, postcode FROM customer;
SELECT id, customer_id, delivery_method, dt_date FROM transaction;
SELECT id, transaction_id, record_ean, quantity FROM orderline;
SELECT id, movietitle, releasedate, playingtime FROM movietitle;
SELECT  stock, record_ean FROM inventory;
SELECT id, title,first_name, last_name, year FROM producer;
SELECT First_Name, Last_Name FROM Customers;
SELECT Product_Name, Product_Description FROM Products WHERE Category ="Drink";