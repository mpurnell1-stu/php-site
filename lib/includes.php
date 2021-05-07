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

    function confirm_admin() {
        confirm_login();
        $admin = true;
        if ($_SESSION['group'] != 'admin') {
            $admin = false;
        }

        if ($admin == false) {
            header("Location: welcome.php");
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
        if (empty($ret)) {
            $ret = 'nothing';
        }
        else if (substr($ret, -2) == ', ') { // if there is a ", " at the end of the return string
            $ret = substr($ret, 0, strlen($ret) - 2); // then concatenate it off
        }
        if (strrpos($ret, ",") != 0) { // then if there is still a comma
                $offset = strpos($ret, ",") != strrpos($ret, ","); // offset will remove comma if there's only one left
                $ret = substr($ret, 0, strrpos($ret, ",") + $offset) . " and " . substr($ret, strrpos($ret, ",") + 1);
        }
        return $ret;
    }

    function print_cart_table() {
        $twos = check_cart('2by2');
        $threes = check_cart('3by3');
        $fours = check_cart('4by4');
        $fives = check_cart('5by5');
        $total_items = $twos + $threes + $fours + $fives;
        $table = '';
        if ($twos > 0) {
            $table .= '<tr><td><a href="2by2.php"><img src="images/2by2_tiny.jpg"></a></td>';
            $table .= '<td align="center"><a href="2by2.php">2x2</a></td><td align="center">';
            $table .= $twos . ' @ $5 ea. </td><td>$' . number_format(5 * $twos, 2);
            $table .= '</td></tr>';
        }
        if ($threes > 0) {
            $table .= '<tr><td><a href="3by3.php"><img src="images/3by3_tiny.jpg"></a></td>';
            $table .= '<td align="center"><a href="3by3.php">3x3</a></td><td align="center">';
            $table .= $threes . ' @ $15 ea. </td><td>$' . number_format(15 * $threes, 2);
            $table .= '</td></tr>';
        }
        if ($fours > 0) {
            $table .= '<tr><td><a href="4by4.php"><img src="images/4by4_tiny.jpg"></a></td>';
            $table .= '<td align="center"><a href="4by4.php">4x4</a></td><td align="center">';
            $table .= $fours . ' @ $30 ea. </td><td>$' . number_format(30 * $fours, 2);
            $table .= '</td></tr>';
        }
        if ($fives > 0) {
            $table .= '<tr><td><a href="5by5.php"><img src="images/5by5_tiny.jpg"></a></td>';
            $table .= '<td align="center"><a href="5by5.php">5x5</a></td><td align="center">';
            $table .= $fives . ' @ $50 ea. </td><td>$' . number_format(50 * $fives, 2);
            $table .= '</td></tr>';
        }
        if ($total_items == 0) {
            $table .= '<tr><td align="center">No</td>';
            $table .= '<td align="center">items</td>';
            $table .= '<td align="center">added</td>';
            $table .= '<td align="center">yet</td></tr>';
        }
        $table .= '<tr><td align="center"><b>Total</b></td><td></td>';
        $table .= '<td align="center">' . $total_items;
        $table .= '</td><td>$' . display_total() . '</tr>';
        return $table;
    }

    function display_total() {
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            return number_format((5 * $cart['2by2']) + (15 * $cart['3by3'])
                    + (30 * $cart['4by4']) + (50 * $cart['5by5']), 2);
        }
    }

    function print_users_as_table() {
        $conn = get_conn();
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        echo "<table cellspacing=0 border=1>";
        echo "<tr><th>Username</th><th>Encrypted Password</th>";
        echo "<th>Email</th><th>Usergroup</th></tr>";
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            if ($count % 2 == 0)
                echo "<tr bgcolor='antiquewhite'>";
            else
                echo "<tr bgcolor='lightgrey'>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['encrypted_password'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['usergroup'] . "</td>";
            $count++;
        }
        echo "</table>";
    }

    function print_orders_as_table() {
        $conn = get_conn();
        $sql = "SELECT * FROM orders;";
        $result = $conn->query($sql);
        echo "<table cellspacing=0 border=1>";
        echo "<tr><th>Username</th><th>Purchase Date/Time</th>";
        echo "<th># of 2x2's</th><th># of 3x3's</th>";
        echo "<th># of 4x4's</th><th># of 5x5's</th>";
        echo "<th>Total Price</th></tr>";
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            if ($count % 2 == 0)
                echo "<tr bgcolor='antiquewhite'>";
            else
                echo "<tr bgcolor='lightgrey'>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['purchased'] . "</td>";
            echo "<td>" . $row['2by2'] . "</td>";
            echo "<td>" . $row['3by3'] . "</td>";
            echo "<td>" . $row['4by4'] . "</td>";
            echo "<td>" . $row['5by5'] . "</td>";
            echo "<td>" . $row['price'] . "</td></tr>";
            $count++;
        }
        echo "</table>";
    }

    function insert_header() {
        echo "<center><img src='images/header.jpg'>";
        echo "<h2>Matt Purnell</h2><h4>CSC 155-201F</h4>";
        if (isset($_COOKIE['preferred_name'])) {
            echo "Hello, " . $_COOKIE['preferred_name'] . "! Enjoy the site.";
        }
        echo "<br><hr>";
    }

    function insert_footer() {
        echo "<hr><br>";
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
            echo "<br><b>Admin Links</b><br>";
            echo "<a href='users.php'>View All Users</a>&nbsp;|&nbsp;";
            echo "<a href='orders.php'>View All Orders</a>&nbsp;|&nbsp;";
            echo "<a href='create_user.php'>Create a New User</a>";
        }
        echo "<br><img src='images/footer.jpg'>";
        echo "</center>";
    }
?>
