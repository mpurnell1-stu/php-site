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
    <p>Welcome to the website!! Feel free to take a look around.</p>
    <?php insert_footer() ?>
</body>
</html>
