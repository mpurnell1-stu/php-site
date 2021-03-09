<!--  I honor Parkland's core values by affirming that I have
followed all academic integrity guidelines for this work.
Matt Purnell
CSC 155-201F -->
<!DOCTYPE html>
<html lang='en-us'>
<head>
    <meta charset='UTF-8'>
    <title>Goodbye</title>
    <?php
        session_start();
        require('lib/includes.php');
        session_unset();
        session_destroy();
        header('refresh:5;url=login.php');
    ?>
</head>
<body>
    <?php insert_header() ?>
    <p>In 5 seconds, you will be logged out and redirected to the login page...</p>
    <?php insert_footer() ?>
</body>
</html>
