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
        function display_cart() {
            $ret = '';
            if (isset($_SESSION['cart'])) {
                $cart = $_SESSION['cart'];
                if ($cart['2by2'] == 1) {
                    $ret .= 'one 2x2, ';
                }
                else if ($cart['2by2'] >= 2) {
                    $ret .= $cart['2by2'] . " 2x2's, ";
                }
                if ($cart['3by3'] == 1) {
                     $ret .= 'one 3x3, ';
                }
                else if ($cart['3by3'] >= 2) {
                    $ret .= $cart['3by3'] . " 3x3's, ";
                }
                if ($cart['4by4'] == 1) {
                    $ret .= 'one 4x4, ';
                }
                else if ($cart['4by4'] >= 2) {
                    $ret .= $cart['4by4'] . " 4x4's, ";
                }
                if ($cart['5by5'] == 1) {
                    $ret .= 'one 5x5';
                }
                else if ($cart['5by5'] >= 2) {
                    $ret .= $cart['5by5'] . " 5x5's";
                }
            }
            if ($ret == false) {
                $ret = 'nothing';
            }
            else if (substr($ret, -2) == ', ') {
                $ret = substr($ret, 0, strlen($ret) - 2);
            }
            return $ret;
        }
        function display_total() {
            if (isset($_SESSION['cart'])) {
                $cart = $_SESSION['cart'];
                return ((5 * $cart['2by2']) + (15 * $cart['3by3'])
                        + (30 * $cart['4by4']) + (50 * $cart['5by5']));
            }
            else {
                return '0.00';
            }
        }
    ?>
</head>
<body>
    <?php insert_header() ?>
    <p>
        This is your shopping cart. While browsing this site you have added
        <?php echo display_cart() ?> to your cart. This will cost a total of
        $<?php echo display_total() ?>.
    </p>
    <?php insert_footer() ?>
</body>
</html>
