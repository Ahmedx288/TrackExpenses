## Track Expenses
This repository is for a course project which is a Web Application this is interacting with a database designed to track and create reports about personal expenses for the database users.
___
**Table of Contents**:
|  |Description|
|--|--|
|**Overview**|The idea itself and how it lead to the creation of the project.|
|**ERD**|The Entity Relationship Diagram of the Database, which is the core of the project.|
|**Logical Model**|The actual tables in the database in the thrid form of Normalization.|
|**Prototypes**|Freehand sketches for Desktop and Mobile views.|
___
## Overview
![The big picture of expenses and invoices](images/Screenshot_1.png)

This picture of many products that have been purchased at some time earlier contains very important data:
- Who have bought some product?
- When a product is purchased?
- How much did someone pay in a specific period of time.
- How much did someone pay at a specific type of product (Grocery? Fast Foods? Cleaning? other types?).
- Did someone pay to much for a useless product?

and many other useful questions that make the user aware of his expenses and where his money goes.
___
## ERD
![Conceptual Model](images/Conceptual%20Model_V3.png)
___
## Logical Model
Databas table reduced to the thrid form of normalization process
|#|Table|Attributes|
|--|--|--|
|1|vendor|(**id**, name_)|
|2|vendor_location|(**vendor_id, address**, city)|
|3|customer|(**id**, name_)|
|4|customer_phone|(**customer_id, phone_num**)|
|5|category|(**id**, main_category, sub_category)|
|6|product|(**id**, name_, trade_mark, **category_id**, weight_liter) |
|7|customer_rating|(**customer_id, product_id**, rate, comments)|
|8|invoice|(**id**, **customer_id, vendor_id**, payment_date, payment_time, total_pay, payment_method)|
|9|invoice_item|(**invoice_id, product_id**, price, quantity, discount)|
___
**Installations:**\
You only need a server to host the website files and database to connect to it.

One possible example is to use a program like AppServ or XAMPP.

**For AppServ:** paste the project inside the "www" folder inside the program directory.\
**For XAMPP:** paste the project inside the "htdocs" folder inside the program directory.

The database connection is established the same way in both programs by setting the username and password for the database during the installation process.
