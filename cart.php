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

        if (isset($_POST['submit'])) {
            if (get_var('submit') == 'Checkout!') {
                if (intval(display_total()) != 0) {
                    $conn = get_conn();

                    $sql = "INSERT INTO orders (username, purchased, 2by2, 3by3, 4by4, 5by5, price) VALUES (?, NOW(), ?, ?, ?, ?, ?);";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('siiiii', $username, $twos, $threes, $fours, $fives, $price);

                    $username = $_SESSION['user'];
                    $twos = $_SESSION['cart']['2by2'];
                    $threes = $_SESSION['cart']['3by3'];
                    $fours = $_SESSION['cart']['4by4'];
                    $fives = $_SESSION['cart']['5by5'];
                    $price = intval(display_total());

                    $stmt->execute();

                    echo "Successfully checked out!";
                    $_SESSION['cart'] = array(
                        '2by2' => intval(0), '3by3' => intval(0),
                        '4by4' => intval(0), '5by5' => intval(0));
                }
                else {
                    echo "Cannot checkout with an empty cart.";
                }
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
    <table border=1>
        <tr>
            <th>Image</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        <?php echo print_cart_table() ?>
    </table>
    <form method='POST'>
        <input type='submit' name='submit' value='Checkout!'>
    </form>
    <?php insert_footer() ?>
</body>
</html>
