#-----------------------------------------------------
DROP TRIGGER IF EXISTS calculat_invoice_item_total_pay;
DELIMITER |
CREATE TRIGGER calculat_invoice_item_total_pay
BEFORE INSERT ON invoice_item
FOR EACH ROW BEGIN
	SET NEW.total_pay = ( (NEW.price * NEW.quantity) - NEW.total_discount);
END|
DELIMITER ;

#-----------------------------------------------------
DROP PROCEDURE IF EXISTS calculateInvoiceTotalPayment;
DELIMITER |
CREATE PROCEDURE calculateInvoiceTotalPayment(id INT)
BEGIN
	UPDATE invoice
    SET total_payment = 
						(SELECT SUM(total_pay)
						 FROM invoice_item
						 WHERE invoice_item.invoice_id = id
						 GROUP BY invoice_id)
	WHERE invoice.id = id;
END |
DELIMITER ;

call calculateInvoiceTotalPayment(1);

#-----------------------------------------------------
DROP PROCEDURE IF EXISTS create_invoices_overview;
DELIMITER |
CREATE PROCEDURE create_invoices_overview(customerID INT, vendorID INT)
BEGIN
	SELECT invoice.id AS "ID", customer.first_name AS "BuyerF", customer.last_name AS "BuyerL",
	   vendor.name_ AS "Store", invoice_type.type_ AS "Type",
       invoice.payment_date AS "DATE", invoice.payment_time AS "TIME"
	FROM invoice JOIN invoice_type JOIN customer JOIN vendor
	ON invoice.customer_id = customer.id AND invoice.invoice_type_id = invoice_type.id AND invoice.vendor_id = vendor.id;
END |
DELIMITER ;

call create_invoices_overview(0,0);