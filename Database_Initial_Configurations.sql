drop database if exists expense_tracking;
create database if not exists expense_tracking;
use expense_tracking;

DROP TABLE IF EXISTS vendor;
CREATE TABLE vendor (
    id INT, 
	name_ VARCHAR(255),
    
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS vendor_location; ##!!!!!!
CREATE TABLE vendor_location (
    vendor_id INT,
    address VARCHAR(255),
	city VARCHAR(255),
    
    PRIMARY KEY (vendor_id, address),
    FOREIGN KEY (vendor_id) REFERENCES vendor(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS customer;
CREATE TABLE customer (
    id INT, 
	name_ VARCHAR(255),
    
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS customer_phone;
CREATE TABLE customer_phone (
    customer_id INT, 
    phone_num CHAR(11) CHECK (phone_num LIKE '01\d{9}'),
    
    PRIMARY KEY (customer_id , phone_num),
    FOREIGN KEY (customer_id) REFERENCES customer(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS category;
CREATE TABLE category (
	id INT, 
    main_category VARCHAR(255),
    sub_category VARCHAR(255),
    
	PRIMARY KEY (id)
);

DROP TABLE IF EXISTS product;
CREATE TABLE product (
	id INT, 
    name_ VARCHAR(255),
    trade_mark VARCHAR(255),
    category_id INT,
    weight_liter DECIMAL, #Kg VS L
    
    PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE
);


DROP TABLE IF EXISTS customer_rating;
CREATE TABLE customer_rating ( 
	customer_id INT, 
    product_id INT,
    rate INT CHECK (rate >= 0),
    comments VARCHAR(255),
    
    PRIMARY KEY (customer_id , product_id),
    FOREIGN KEY (customer_id) REFERENCES customer(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS invoice;
CREATE TABLE invoice (
    id INT,
    customer_id INT,
    vendor_id INT,
    payment_date DATE,
    payment_time Time,
    #-----> total_payment DECIMAL,
    payment_method VARCHAR(255),
    
    PRIMARY KEY (id),
    FOREIGN KEY (customer_id) REFERENCES customer(id) ON DELETE CASCADE,
    FOREIGN KEY (vendor_id) REFERENCES vendor(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS invoice_item;
CREATE TABLE invoice_item ( 
	invoice_id INT, 
    product_id INT,
    price DOUBLE CHECK (price > 0),
    quantity INT CHECK (quantatiy > 0),
    discount DOUBLE CHECK (discount >= 0),
    
    PRIMARY KEY (invoice_id , product_id),
    FOREIGN KEY (invoice_id) REFERENCES invoice(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE
);
	


INSERT INTO vendor
VALUES
	(1, 'Khair-Zaman'),
    (2, 'Buffalo Burger'),
    (3, 'Ashraf Farghaly Juice');

INSERT INTO vendor_location
VALUES
	(1, 'Yousri Raghib', 'Assiut'),
    (1, 'Asmaa-allah alhosna', 'Assiut'),
    (2, 'Republic street', 'Assiut'),
    (3, 'Asmaa-allah alhosna', 'Assiut');

INSERT INTO customer
VALUES
	(1, 'Ahmed'),
    (2, 'Eslam'),
    (3, 'Hossam');

INSERT INTO customer_phone
VALUES
	(1, '01011111111'),
    (1, '01022222222'),
    (2, '01111111111'),
    (3, '01555555555');

INSERT INTO category
VALUES
	(1, 'Food', 'Dairy'),
    (2, 'Food', 'Snacks'),
    (3, 'Food', 'Fast Food'),
    (4, 'Food', 'Drinks'),
    (5, 'Health', 'Personal hygiene');

INSERT INTO product
VALUES
	(1, 'Trash Bags', 'Khair-Zman', 5, 25),
    (2, 'Juhayna milk', 'Khair-Zman', 1, 1),
    (3, 'Chocolate', 'Cadbury', 2, 0.090),
    (4, 'Burger offers', 'Buffalo Burger', 3, 1),
    (5, 'Mango Juice', 'Farghaly', 4, 0), #Weight_Liter = 0 -> N/A
    (6, 'Mango+Peache Juice', 'Farghaly', 4, 0),
    (7, 'Apple Juice', 'Farghaly', 4, 0);

INSERT INTO invoice
VALUES
	(1, 1, 1, DATE '2020-09-04', '07:54:35', 'Cash'),#AHMED, Buys from Khair-zman on invoice 1
    (2, 3, 2, DATE '2020-11-04', '10:45:17', 'Visa'),#Hossam, Buys from Buffalo on invoice 2
    (3, 2, 3, DATE '2020-09-07', '11:30:28', 'Cash');#Eslam, Buys from Farghaly on invoice 3
    
INSERT INTO invoice_item
VALUES
	(1, 1, 19.99, 1, 0), #invoice 1, item_1(Trash Bags), price, quantity, discount
    (1, 2, 26, 1, 0), #invoice 1, item_2(Juhayna milk), price, quantity, discount
    (1, 3, 15.99, 1, 0), #invoice 1, item_3(Choclate), price, quantity, discount
    
    (2, 4, 153.5, 1, 40), #invoice 2
    
    (3, 5, 13, 1, 0), #invoice 3
    (3, 6, 16, 1, 0), #invoice 3
    (3, 7, 14, 1, 0); #invoice 3

Select invoice.customer_id, invoice.id as 'invoice #', sum(price) As 'Total', invoice.payment_method 
from invoice JOIN invoice_item
ON invoice.id = invoice_item.invoice_id
group by invoice.id;