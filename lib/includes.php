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

    function get_conn() {
        $username = 'mpurnell1';
        $conn = mysqli_connect('localhost', $username, $username, $username);
        return $conn;
    }

    function get_user_row($conn, $username) {
        $sql = "SELECT * FROM users WHERE username=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return 0;
        }
        else if ($result->num_rows > 1) {
            echo "<script>alert('Multiple users returned');</script>";
            header("Location: goodbye.php");
        }
        else {
            return $result->fetch_assoc();
        }
    }

    function confirm_login() {
        $logged_in = true;
        if (!isset($_SESSION['user'])) {
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
            if (strrpos($ret, ",") != 0) {
                $ret = substr($ret, 0, strrpos($ret, ",") + 1) . " and " . substr($ret, strrpos($ret, ",") + 1);
            }
        }
        return $ret;
    }

    function print_cart_table() {
        // Bonus: Make images and item names links
        $twos = check_cart('2by2');
        $threes = check_cart('3by3');
        $fours = check_cart('4by4');
        $fives = check_cart('5by5');
        $total_items = $twos + $threes + $fours + $fives;
        $table = '';
        if ($twos > 0) {
            $table .= '<tr><td><img src="images/2by2_tiny.jpg"></td>';
            $table .= '<td align="center">2x2</td><td align="center">';
            $table .= $twos . ' @ $5 ea. </td><td>$' . number_format(5 * $twos, 2);
            $table .= '</td></tr>';
        }
        if ($threes > 0) {
            $table .= '<tr><td><img src="images/3by3_tiny.jpg"></td>';
            $table .= '<td align="center">3x3</td><td align="center">';
            $table .= $threes . ' @ $15 ea. </td><td>$' . number_format(15 * $threes, 2);
            $table .= '</td></tr>';
        }
        if ($fours > 0) {
            $table .= '<tr><td><img src="images/4by4_tiny.jpg"></td>';
            $table .= '<td align="center">4x4</td><td align="center">';
            $table .= $fours . ' @ $30 ea. </td><td>$' . number_format(30 * $fours, 2);
            $table .= '</td></tr>';
        }
        if ($fives > 0) {
            $table .= '<tr><td><img src="images/5by5_tiny.jpg"></td>';
            $table .= '<td align="center">5x5</td><td align="center">';
            $table .= $fives . ' @ $50 ea. </td><td>$' . number_format(50 * $fives, 2);
            $table .= '</td></tr>';
        }
        if ($total_items == 0) {
            $table .= '<tr><td align="center">No</td>';
            $table .= '<td align="center">items</td>';
            $table .= '<td align="center">added</td>';
            $table .= '<td align="center">yet</td>';
        }
        $table .= '<tr><td align="center"><b>Total</b></td><td></td>';
        $table .= '<td align="center">' . $total_items;
        $table .= '</td><td>$' . display_total();
        return $table;
    }

    function display_total() {
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            return number_format((5 * $cart['2by2']) + (15 * $cart['3by3'])
                    + (30 * $cart['4by4']) + (50 * $cart['5by5']), 2);
        }
    }

    function insert_header() {
        echo "<center><img src='images/header.jpg'>";
        echo "<h2>Matt Purnell</h2><h4>CSC 155-201F</h4>";
        if (isset($_COOKIE['preferred_name'])) {
            echo "Hello, " . $_COOKIE['preferred_name'] . "! Enjoy the site.";
        }
        echo "<br><br>";
    }

    function insert_footer() {
        echo "<br><br>";
        if (isset($_SESSION['group']) and $_SESSION['group'] == 'admin')
            echo "<b>User Links</b><br>";
        echo "<a href='login.php'>Login</a>&nbsp;|&nbsp;";
        echo "<a href='goodbye.php'>Logout</a>&nbsp;|&nbsp;";
        echo "<a href='welcome.php'>Home</a>&nbsp;|&nbsp;";
        echo "<a href='cart.php'>Cart</a>&nbsp;|&nbsp;";
        echo "<a href='2by2.php'>Item 1</a>&nbsp;|&nbsp;";
        echo "<a href='3by3.php'>Item 2</a>&nbsp;|&nbsp;";
        echo "<a href='4by4.php'>Item 3</a>&nbsp;|&nbsp;";
        echo "<a href='5by5.php'>Item 4</a>";
        if (isset($_SESSION['group']) and $_SESSION['group'] == 'admin') {
            // Bonus: Add create user link here
            echo "<br><b>Admin Links</b><br>";
            echo "<a href='users.php'>View All Users</a>&nbsp;|&nbsp;";
            echo "<a href='orders.php'>View All Orders</a>";
        }
        echo "<br><img src='images/footer.jpg'>";
        echo "</center>";
    }
?>
