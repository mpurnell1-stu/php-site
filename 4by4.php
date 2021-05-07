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
        confirm_login();
        $item_action = handle_item_submit('4by4');
    ?>
</head>
<body>
    <?php insert_header() ?>
    <p>
        This is a 4x4x4 Rubik's cube. It is one of the more difficult versions
        of the puzzle. One thing that adds a challenge is that there are no
        predefined centers, which can lead to problems later.
        <b>Price: $30.00</b>
    </p>
    <img src='images/4by4.jpg'>
    <p>
        <i><?php echo $item_action ?></i><br>
        4x4's currently in your <a href='cart.php'>cart</a>: <?php echo check_cart('4by4') ?>
    </p>
    <form method='POST'>
        <input type='submit' name='submit' value='Add 1 to cart'>
        <input type='submit' name='submit' value='Remove 1 from cart'>
        <input type='submit' name='submit' value='Remove all from cart'>
    </form>
    <?php insert_footer() ?>
</body>
</html>
