DROP DATABASE IF EXISTS expense_tracking;
CREATE DATABASE IF NOT EXISTS  expense_tracking;
USE expense_tracking;

DROP TABLE IF EXISTS vendor;
CREATE TABLE vendor (
    id INT NOT NULL AUTO_INCREMENT,
	name_ VARCHAR(255) NOT NULL,
    
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS vendor_location; ##!!!!!!
CREATE TABLE vendor_location (
    vendor_id INT NOT NULL,
    address VARCHAR(255) NOT NULL,
	city VARCHAR(255) NOT NULL,
    address_notes VARCHAR(255),
    
    PRIMARY KEY (vendor_id, address),
    FOREIGN KEY (vendor_id) REFERENCES vendor(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS customer;
CREATE TABLE customer (
    id INT NOT NULL AUTO_INCREMENT, 
	first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    gender ENUM('male', 'female') NOT NULL,
    
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS customer_phone;
CREATE TABLE customer_phone (
    customer_id INT, 
    phone_num CHAR(11),
    
    PRIMARY KEY (customer_id , phone_num),
    FOREIGN KEY (customer_id) REFERENCES customer(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS category;
CREATE TABLE category (
	id INT NOT NULL AUTO_INCREMENT, 
    main_category VARCHAR(255) NOT NULL,
    sub_category VARCHAR(255) NOT NULL,
    
	PRIMARY KEY (id)
);

DROP TABLE IF EXISTS product;
CREATE TABLE product (
	id INT NOT NULL AUTO_INCREMENT,
    name_ VARCHAR(255) NOT NULL,
    trade_mark VARCHAR(255) NOT NULL,
    category_id INT NOT NULL,
    weight_liter FLOAT NOT NULL, #Kg VS L | Weight_Liter = 0 -> N/A (Not Applicable);
    
    PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE
); #this table is used only to describe the product characteristics itself, not the price or anything else.


DROP TABLE IF EXISTS customer_rating;
CREATE TABLE customer_rating ( 
	customer_id INT NOT NULL, 
    product_id INT NOT NULL,
    rate TINYINT UNSIGNED NOT NULL,
    comments VARCHAR(255),
    
    PRIMARY KEY (customer_id , product_id),
    FOREIGN KEY (customer_id) REFERENCES customer(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS invoice;
CREATE TABLE invoice (
    id INT NOT NULL AUTO_INCREMENT,
    customer_id INT NOT NULL,
    vendor_id INT NOT NULL,
    payment_date DATE NOT NULL,
    payment_time Time NOT NULL,
    total_payment DOUBLE, #Trigger (sum(invoice items))
    payment_method ENUM('cash', 'electronic'),
    
    PRIMARY KEY (id),
    FOREIGN KEY (customer_id) REFERENCES customer(id) ON DELETE CASCADE,
    FOREIGN KEY (vendor_id) REFERENCES vendor(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS invoice_item;
CREATE TABLE invoice_item ( 
	invoice_id INT, 
    product_id INT,
    price DOUBLE UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    total_discount DOUBLE UNSIGNED, 
    total_pay DOUBLE UNSIGNED, #Trigger [(price * quantity) - total_discount];
    
    PRIMARY KEY (invoice_id , product_id),
    FOREIGN KEY (invoice_id) REFERENCES invoice(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE
);
	


INSERT INTO vendor (name_)
VALUES
	('Khair-Zaman'),
    ('Buffalo Burger'),
    ('Ashraf Farghaly Juice');

INSERT INTO vendor_location
VALUES
	(1, 'Yousri Raghib', 'Assiut', ''),
    (1, 'Asmaa-allah alhosna', 'Assiut', ''),
    (2, 'Republic street', 'Assiut', ''),
    (3, 'Asmaa-allah alhosna', 'Assiut', '');

INSERT INTO customer (first_name, last_name, age, gender)
VALUES
		('Ahmed', 'Mostafa', 22, 'male'),
        ('Hossam', 'Ahmed', 22, 'male'),
        ('Eslam', 'Taha', 22, 'male'),
        ('Maryam', 'Mostafa', 20, 'female');


INSERT INTO customer_phone
VALUES
	(1, '01011111111'),
    (1, '01022222222'),
    (2, '01111111111'),
    (3, '01555555555');

INSERT INTO category (main_category, sub_category)
VALUES
	('Food', 'Dairy'),
    ('Food', 'Snacks'),
    ('Food', 'Fast Food'),
    ('Food', 'Drinks'),
    ('Health', 'Personal hygiene');

INSERT INTO product (name_ , trade_mark, category_id, weight_liter)
VALUES
	('Trash Bags', 'Khair-Zman', 5, 25),
    ('Juhayna milk', 'Khair-Zman', 1, 1),
    ('Chocolate', 'Cadbury', 2, 0.090),
    ('Burger offers', 'Buffalo Burger', 3, 1),
    ('Mango Juice', 'Farghaly', 4, 0), #Weight_Liter = 0 -> N/A
    ('Mango+Peache Juice', 'Farghaly', 4, 0),
    ('Apple Juice', 'Farghaly', 4, 0);

INSERT INTO customer_rating
VALUES
	   (1 , 2, 5, 'A'), 	#Ahmed, about Juhayna milk, rate 5
	   (2 , 2, 2, 'F'),		#Eslam, about Juhayna milk, rate 2
       (3 , 2, 3, 'C');		#Hosam, about Juhayna milk, rate 3

INSERT INTO invoice (customer_id, vendor_id, payment_date, payment_time, payment_method)
VALUES
	(1, 1, DATE '2020-09-04', '07:54:35', 'cash'),			#AHMED, Buys from Khair-zman on invoice 1
    (3, 2, DATE '2020-11-04', '10:45:17', 'electronic'),	#Hossam, Buys from Buffalo on invoice 2
    (2, 3, DATE '2020-09-07', '11:30:28', 'Cash');			#Eslam, Buys from Farghaly on invoice 3
    
INSERT INTO invoice_item
VALUES
	(1, 1, 19.99, 1, 0), 	#invoice 1, item_1(Trash Bags), price, quantity, discount
    (1, 2, 26, 1, 0), 		#invoice 1, item_2(Juhayna milk), price, quantity, discount
    (1, 3, 15.99, 1, 0), 	#invoice 1, item_3(Choclate), price, quantity, discount
    
    (2, 4, 153.5, 1, 40), 	#invoice 2
    
    (3, 5, 13, 1, 0), 		#invoice 3
    (3, 6, 16, 1, 0), 		#invoice 3
    (3, 7, 14, 1, 0); 		#invoice 3

Select invoice.customer_id, invoice.id as 'invoice #', sum(price) As 'Total', invoice.payment_method 
FROM invoice JOIN invoice_item
ON invoice.id = invoice_item.invoice_id
GROUP BY invoice.id;

SELECT customer.first_name, product.name_, customer_rating.rate, customer_rating.comments
FROM customer_rating JOIN customer JOIN product
ON customer_rating.customer_id = customer.id AND customer_rating.product_id = product.id;

SELECT invoice.id AS 'invoice num #', customer.first_name AS 'buyer', vendor.name_ AS 'market', payment_method
FROM customer JOIN vendor JOIN invoice
ON customer.id = invoice.customer_id AND invoice.vendor_id = vendor.id;

SELECT
invoice.id AS 'invoice num #', customer.first_name AS 'buyer', vendor.name_ AS 'market',
product.name_, payment_method
FROM customer JOIN vendor JOIN invoice JOIN invoice_item JOIN product
ON customer.id = invoice.customer_id AND invoice.vendor_id = vendor.id AND 
invoice_item.invoice_id = invoice.id AND product.id = invoice_item.product_id;