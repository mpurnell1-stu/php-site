<!--  I honor Parkland's core values by affirming that I have
followed all academic integrity guidelines for this work.
Matt Purnell
CSC 155-201F -->
<!DOCTYPE html>
<html lang='en-us'>
<head>
    <meta charset='UTF-8'>
    <title>Item 1</title>
    <?php
        session_start();
        require('lib/includes.php');
        confirm_login();
        $item_action =  handle_item_submit('2by2');
    ?>
</head>
<body>
    <?php insert_header() ?>
    <p>
        This is a 2x2x2 Rubik's cube. It is the simplest version of the puzzle,
        containing only 8 pieces. <b>Price: $5.00</b>
    </p>
    <img src='images/2by2.jpg'>
    <p>
        <i><?php echo $item_action ?></i><br>
        2x2's currently in your <a href='cart.php'>cart</a>: <?php echo check_cart('2by2') ?>
    </p>
    <form method='POST'>
        <input type='submit' name='submit' value='Add 1 to cart'>
        <input type='submit' name='submit' value='Remove 1 from cart'>
        <input type='submit' name='submit' value='Remove all from cart'>
    </form>
    <?php insert_footer() ?>
</body>
</html>
