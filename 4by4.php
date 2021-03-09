<!--  I honor Parkland's core values by affirming that I have
followed all academic integrity guidelines for this work.
Matt Purnell
CSC 155-201F -->
<!DOCTYPE html>
<html lang='en-us'>
<head>
    <meta charset='UTF-8'>
    <title>Item 3</title>
    <?php
        session_start();
        require('lib/includes.php');
        if (isset($_POST['submit'])) {
            if ($_POST['submit'] == 'Add 1 to cart') {
                $_SESSION['cart']['4by4'] += 1;
                echo "One 4x4 added to cart.";
            }
            else if ($_POST['submit'] == 'Remove 1 from cart') {
                if ($_SESSION['cart']['4by4'] >= 1) {
                    $_SESSION['cart']['4by4'] -= 1;
                    echo "One 4x4 removed from cart.";
                }
                else {
                    echo "None in your cart to remove.";
                }
            }
            else if ($_POST['submit'] == 'Remove all from cart') {
                $_SESSION['cart']['4by4'] = 0;
                echo "All 4x4's removed from cart.";
            }
        }
    ?>
</head>
<body>
    <?php insert_header() ?>
    <center>
    <img src='images/4by4.jpg'>
    <p>
        This is a 4x4x4 Rubik's cube. It is one of the more difficult versions
        of the puzzle. One thing that adds a challenge is that there are no
        predefined centers, which can lead to problems later. <b>Price: $30.00</b>
    </p>
    <form method='POST'>
        <input type='submit' name='submit' value='Add 1 to cart'>
        <input type='submit' name='submit' value='Remove 1 from cart'>
        <input type='submit' name='submit' value='Remove all from cart'>
    </form>
    <p>4x4's currently in your cart: <?php echo check_cart('4by4') ?></p>
    </center>
    <?php insert_footer() ?>
</body>
</html>
