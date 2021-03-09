<!--  I honor Parkland's core values by affirming that I have
followed all academic integrity guidelines for this work.
Matt Purnell
CSC 155-201F -->
<!DOCTYPE html>
<html lang='en-us'>
<head>
    <meta charset='UTF-8'>
    <title>Item 2</title>
    <?php
        session_start();
        require('lib/includes.php');
        if (isset($_POST['submit'])) {
            if ($_POST['submit'] == 'Add 1 to cart') {
                $_SESSION['cart']['3by3'] += 1;
                echo "One 3x3 added to cart.";
            }
            else if ($_POST['submit'] == 'Remove 1 from cart') {
                if ($_SESSION['cart']['3by3'] >= 1) {
                    $_SESSION['cart']['3by3'] -= 1;
                    echo "One 3x3 removed from cart.";
                }
                else {
                    echo "None in your cart to remove.";
                }
            }
            else if ($_POST['submit'] == 'Remove all from cart') {
                $_SESSION['cart']['3by3'] = 0;
                echo "All 3x3's removed from cart.";
            }
        }
    ?>
</head>
<body>
    <?php insert_header() ?>
    <center>
    <img src='images/3by3.jpg'>
    <p>
        This is a 3x3x3 Rubik's cube. It is the most well-known version of the puzzle,
        containing 27 pieces. It has over 43 quintillion possibilities and has existed
        since 1974. <b>Price: $15.00</b>
    </p>
    <form method='POST'>
        <input type='submit' name='submit' value='Add 1 to cart'>
        <input type='submit' name='submit' value='Remove 1 from cart'>
        <input type='submit' name='submit' value='Remove all from cart'>
    </form>
    <p>3x3's currently in your cart: <?php echo check_cart('3by3') ?></p>
    </center>
    <?php insert_footer() ?>
</body>
</html>
