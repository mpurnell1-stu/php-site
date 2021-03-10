<!--  I honor Parkland's core values by affirming that I have
followed all academic integrity guidelines for this work.
Matt Purnell
CSC 155-201F -->
<!DOCTYPE html>
<html lang='en-us'>
<head>
    <meta charset='UTF-8'>
    <title>Shopping Cart</title>
    <?php
        session_start();
        require('lib/includes.php');
        confirm_login();
    ?>
</head>
<body>
    <?php insert_header() ?>
    <p>
        This is your shopping cart. While browsing this site you have added
        <?php echo display_cart() ?> to your cart. This will cost a total of
        $<?php echo display_total() ?>.
    </p>
    <center>
    <table border=1>
        <tr>
            <th>Size</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        <?php echo print_cart_table() ?>
    </table>
    </center>
    <?php insert_footer() ?>
</body>
</html>
