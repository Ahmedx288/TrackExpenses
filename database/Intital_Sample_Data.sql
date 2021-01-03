INSERT INTO vendor (name_)
VALUES
	('Khair-Zaman'),
    ('Buffalo Burger'),
    ('Ashraf Farghaly Juice');

INSERT INTO location (vendor_id, address, city, address_notes)
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

INSERT INTO invoice_type (type_)
VALUES
	('Grocery'),
    ('Fast Food'),
    ('Snacks');
    
INSERT INTO invoice (customer_id, vendor_id, location_id, invoice_type_id, payment_date, payment_time, payment_method)
VALUES
	(1, 1, 1, 1, DATE '2020-09-04', '07:54:35', 'cash'),			#AHMED, Buys from Khair-zman(loc_id: 1) on invoice 1 (grocery)
    (3, 2, 3, 2, DATE '2020-11-04', '10:45:17', 'electronic'),		#Hossam, Buys from Buffalo(loc_id: 3) on invoice 2	  (fast food)
    (2, 3, 4, 3, DATE '2020-09-07', '11:30:28', 'Cash');			#Eslam, Buys from Farghaly(loc_id: 4) on invoice 3	  (snacks)
 

INSERT INTO invoice_item (invoice_id, product_id, price, quantity, total_discount)
VALUES
	(1, 1, 19.99, 1, 0), 	#invoice 1, item_1(Trash Bags), price, quantity, discount
    (1, 2, 26, 1, 0), 		#invoice 1, item_2(Juhayna milk), price, quantity, discount
    (1, 3, 15.99, 1, 0), 	#invoice 1, item_3(Choclate), price, quantity, discount
    
    (2, 4, 153.5, 1, 40), 	#invoice 2calculat_invoice_item_total_pay
    
    (3, 5, 13, 1, 0), 		#invoice 3
    (3, 6, 16, 1, 0), 		#invoice 3
    (3, 7, 14, 1, 0); 		#invoice 3