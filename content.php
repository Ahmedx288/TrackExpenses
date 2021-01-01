<?php

    if(isset($_GET['page'])){
        switch ($_GET['page']) {
            case 'invoice':
                include 'pages/invoices/invoice.php';
            break;

            case 'report':
                include 'pages/reports/report.php';
            break;
        } 
    } else { include "pages/main-content.php";}

?>