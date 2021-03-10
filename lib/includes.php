<!--  I honor Parkland's core values by affirming that I have
followed all academic integrity guidelines for this work.
Matt Purnell
CSC 155-201F -->
<?php
    function get_var($var_name) {
       if (isset($_POST[$var_name])) {
            return htmlspecialchars($_POST[$var_name]);
        }
        else {
            return '';
        }
    }

    function confirm_login() {
        $logged_in = true;
        if (isset($_SESSION['user']) == false) {
            $logged_in = false;
        }
        else if ($_SESSION['user'] != 'csc155user') {
            $logged_in = false;
        }

        if ($logged_in == false) {
            header('Location: login.php');
        }
    }

    function handle_item_submit($item) {
        if (isset($_POST['submit'])) {
            if (isset($_SESSION['cart'][$item])) {
                if ($_POST['submit'] == 'Add 1 to cart') {
                    $_SESSION['cart'][$item]++;
                    return "One $item[0]x$item[3] added to cart.";
                }
                else if ($_POST['submit'] == 'Remove 1 from cart') {
                    if ($_SESSION['cart'][$item] >= 1) {
                        $_SESSION['cart'][$item]--;
                        return "One $item[0]x$item[3] removed from cart.";
                    }
                    else {
                        return "No $item[0]x$item[3]'s to remove.";
                    }
                }
                else if ($_POST['submit'] == 'Remove all from cart') {
                    $_SESSION['cart'][$item] = 0;
                    return "All $item[0]x$item[3]'s removed from cart.";
                }
            }
            else {
                return "Unknown item in cart: " . $item;
            }
        }
    }

    function check_cart($cart_var) {
        if (isset($_SESSION['cart'][$cart_var])) {
            return intval($_SESSION['cart'][$cart_var]);
        }
        else {
            return 0;
        }
    }

    function insert_header() {
        echo "<center><img src='images/header.jpg'>";
        echo "<h2>Matt Purnell</h2><h4>CSC 155-201F</h4></center>";
        echo "<br><br>";
    }

    function insert_footer() {
        echo "<br><br>";
        echo "<center>";
        echo "<a href='login.php'>Login</a>&nbsp;|&nbsp;";
        echo "<a href='welcome.php'>Welcome</a>&nbsp;|&nbsp;";
        echo "<a href='goodbye.php'>Goodbye</a>&nbsp;|&nbsp;";
        echo "<a href='cart.php'>Cart</a>&nbsp;|&nbsp;";
        echo "<a href='2by2.php'>Item 1</a>&nbsp;|&nbsp;";
        echo "<a href='3by3.php'>Item 2</a>&nbsp;|&nbsp;";
        echo "<a href='4by4.php'>Item 3</a>&nbsp;|&nbsp;";
        echo "<a href='5by5.php'>Item 4</a>&nbsp;|&nbsp;";
        echo "</center>";
    }
?>
