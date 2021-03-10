<!--  I honor Parkland's core values by affirming that I have
followed all academic integrity guidelines for this work.
Matt Purnell
CSC 155-201F -->
<!DOCTYPE html>
<html lang='en-us'>
<head>
    <meta charset='UTF-8'>
    <title>Welcome Page</title>
    <?php
        session_start();
        require('lib/includes.php');
        confirm_login();
        if (isset($_SESSION['cart']) == false) {
            $_SESSION['cart'] = array(
                    '2by2' => intval(0), '3by3' => intval(0),
                    '4by4' => intval(0), '5by5' => intval(0));
        }
    ?>
</head>
<body>
    <?php insert_header() ?>
    <p>
        Welcome to the website!! Feel free to take a look around. This is a
        Rubik's cube shop, and we have four different items to choose from:
        <a href='2by2.php'>2x2's</a>, <a href='3by3.php'>3x3's</a>,
        <a href='4by4.php'>4x4's</a>, and <a href='5by5.php'>5x5's</a>. Once
        you've added some cubes to your cart, you can view it
        <a href='cart.php'>here</a>.
    </p>
    <?php insert_footer() ?>
</body>
</html>
