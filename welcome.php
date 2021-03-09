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
        $_SESSION['cart'] = array(
                '2by2' => 0, '3by3' => 0,
                '4by4' => 0, '5by5' => 0);
    ?>
</head>
<body>
    <?php insert_header() ?>
    <p>Welcome to the website!! Feel free to take a look around.</p>
    <?php insert_footer() ?>
</body>
</html>
