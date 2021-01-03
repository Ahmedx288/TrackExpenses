Select invoice.customer_id, invoice.id as 'invoice #', sum(price) As 'Total', invoice.payment_method
FROM invoice JOIN invoice_item
ON invoice.id = invoice_item.invoice_id
GROUP BY invoice.id;

SELECT customer.first_name, product.name_, customer_rating.rate, customer_rating.comments
FROM customer_rating JOIN customer JOIN product
ON customer_rating.customer_id = customer.id AND customer_rating.product_id = product.id;

SELECT invoice.id AS 'invoice num #', customer.first_name AS 'buyer', vendor.name_ AS 'market', address, payment_method, type_
FROM customer JOIN vendor JOIN location JOIN invoice JOIN invoice_type
ON customer.id = invoice.customer_id AND location.id = invoice.location_id AND invoice.vendor_id = vendor.id AND invoice.invoice_type_id = invoice_type.id;

SELECT
invoice.id AS 'invoice num #', customer.first_name AS 'buyer', vendor.name_ AS 'market',
product.name_, payment_method
FROM customer JOIN vendor JOIN invoice JOIN invoice_item JOIN product
ON customer.id = invoice.customer_id AND invoice.vendor_id = vendor.id AND 
invoice_item.invoice_id = invoice.id AND product.id = invoice_item.product_id;