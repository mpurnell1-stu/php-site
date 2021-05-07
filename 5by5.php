<!--  I honor Parkland's core values by affirming that I have
followed all academic integrity guidelines for this work.
Matt Purnell
CSC 155-201F -->
<!DOCTYPE html>
<html lang='en-us'>
<head>
    <meta charset='UTF-8'>
    <title>Item 4</title>
    <?php
        session_start();
        require('lib/includes.php');
        confirm_login();
        $item_action = handle_item_submit('5by5');
    ?>
</head>
<body>
    <?php insert_header() ?>
    <p>
        This is a 5x5x5 Rubik's cube. It is the most complex version of the
        puzzle sold on this site. With almost 100 pieces and over 282
        trevigintillion (that's 282 followed by 72 zeros) possibilities,<br>
        this twisty puzzle is sure to keep you entertained for hours.
        <b>Price: $50.00</b>
    </p>
    <img src='images/5by5.jpg'>
    <p>
        <i><?php echo $item_action ?></i><br>
        5x5's currently in your <a href='cart.php'>cart</a>: <?php echo check_cart('5by5') ?>
    </p>
    <form method='POST'>
        <input type='submit' name='submit' value='Add 1 to cart'>
        <input type='submit' name='submit' value='Remove 1 from cart'>
        <input type='submit' name='submit' value='Remove all from cart'>
    </form>
    <?php insert_footer() ?>
</body>
</html>
