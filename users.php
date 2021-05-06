<!--  I honor Parkland's core values by affirming that I have
followed all academic integrity guidelines for this work.
Matt Purnell
CSC 155-201F -->
<!DOCTYPE html>
<html lang='en-us'>
<head>
    <meta charset='UTF-8'>
    <title>All Users</title>
    <?php
        session_start();
        require('lib/includes.php');
        confirm_admin()
    ?>
</head>
<body>
    <?php insert_header() ?>
    <h3>Admin Menu: All Users</h3>
    <?php print_users_as_table() ?>
    <?php insert_footer() ?>
</body>
</html>
