DROP DATABASE IF EXISTS expense_tracking;
CREATE DATABASE IF NOT EXISTS  expense_tracking;
USE expense_tracking;

DROP TABLE IF EXISTS vendor;
CREATE TABLE vendor (
    id INT NOT NULL AUTO_INCREMENT,
	name_ VARCHAR(255) NOT NULL UNIQUE,
    
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS location;
CREATE TABLE location (
    id INT NOT NULL AUTO_INCREMENT,
    vendor_id INT NOT NULL,
    address VARCHAR(255) NOT NULL,
	city VARCHAR(255) NOT NULL,
    address_notes VARCHAR(255),
    
    PRIMARY KEY (id),
    UNIQUE (vendor_id, address),
    FOREIGN KEY (vendor_id) REFERENCES vendor(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS customer;
CREATE TABLE customer (
    id INT NOT NULL AUTO_INCREMENT, 
	first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    gender ENUM('male', 'female') NOT NULL,
    
    PRIMARY KEY (id),
    UNIQUE (first_name, last_name)
);

DROP TABLE IF EXISTS category;
CREATE TABLE category (
	id INT NOT NULL AUTO_INCREMENT, 
    main_category VARCHAR(255) NOT NULL,
    sub_category VARCHAR(255) NOT NULL,
    
	PRIMARY KEY (id),
    UNIQUE (main_category, sub_category)
);

DROP TABLE IF EXISTS product;
CREATE TABLE product (
	id INT NOT NULL AUTO_INCREMENT,
    name_ VARCHAR(255) NOT NULL,
    trade_mark VARCHAR(255) NOT NULL,
    category_id INT NOT NULL,
    weight_liter FLOAT NOT NULL, #Kg VS L | Weight_Liter = 0 -> N/A (Not Applicable);
    
    PRIMARY KEY (id),
    UNIQUE (name_, trade_mark),
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

DROP TABLE IF EXISTS invoice_type;
CREATE TABLE invoice_type (
	id INT NOT NULL AUTO_INCREMENT,
    type_ VARCHAR(255) NOT NULL,

	PRIMARY KEY (id),
    UNIQUE (type_)
);

DROP TABLE IF EXISTS invoice;
CREATE TABLE invoice (
    id INT NOT NULL AUTO_INCREMENT,
    customer_id INT NOT NULL,
    vendor_id INT NOT NULL,
    location_id INT NOT NULL,
    invoice_type_id INT NOT NULL,
    payment_date DATE NOT NULL,
    payment_time Time NOT NULL,
    total_payment DOUBLE,
    payment_method ENUM('cash', 'electronic'),
    
    PRIMARY KEY (id),
    FOREIGN KEY (customer_id) REFERENCES customer(id) ON DELETE CASCADE,
    FOREIGN KEY (vendor_id) REFERENCES vendor(id) ON DELETE CASCADE,
    FOREIGN KEY (location_id) REFERENCES location(id) ON DELETE CASCADE,
    FOREIGN KEY (invoice_type_id) REFERENCES invoice_type(id) ON DELETE CASCADE
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


DROP TRIGGER IF EXISTS calculat_invoice_item_total_pay;
DELIMITER $$
CREATE TRIGGER calculat_invoice_item_total_pay
BEFORE INSERT ON invoice_item
FOR EACH ROW BEGIN
	SET NEW.total_pay = ( (NEW.price * NEW.quantity) - NEW.total_discount);
END$$
DELIMITER ;