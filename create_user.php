<!--  I honor Parkland's core values by affirming that I have
followed all academic integrity guidelines for this work.
Matt Purnell
CSC 155-201F -->
<!DOCTYPE html>
<html lang='en-us'>
<head>
    <meta charset='UTF-8'>
    <title></title>
    <?php
        require('lib/includes.php');

        $username_error = "";
        $password_error = "";
        $email_error = "";
        $usergroup_error = "";
        if (isset($_POST['submit'])) {
            if (get_var('submit') == 'Cancel') {
                header('Location: login.php');
            }
            else if (get_var('submit') == 'Create') {
                if (empty(get_var('user'))) {
                    $username_error = "Username cannot be empty<br>";
                }
                else if (get_user_row(get_conn(), get_var('user'))) {
                    $username_error = "User with that username already exists<br>";
                }
                else if (empty(get_var('pass')) or empty(get_var('pass2'))) {
                    $password_error = "Password cannot be empty<br>";
                }
                else if (get_var('pass') != get_var('pass2')) {
                    $password_error = "Passwords must match<br>";
                }
                else if (strpos(get_var('email'), '@') === false or strpos(get_var('email'), '.') === false) {
                    $email_error = "Emails must be of the form 'a@b.com'.<br>";
                }
                else if (get_var('usergroup') != "user" and get_var('usergroup') != "admin") {
                    $usergroup_error = "Usergroup must be either 'user' or 'admin'.<br>";
                }
                else {
                    $conn = get_conn();

                    $sql = "INSERT INTO users (username, encrypted_password, usergroup, email) VALUES (?, ?, ?, ?);";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssss", $username, $encrypted_password, $usergroup, $email);

                    $username = get_var('user');
                    $encrypted_password = password_hash(get_var('pass'), PASSWORD_DEFAULT);
                    $usergroup = get_var('group');
                    $email = get_var('email');

                    $stmt->execute();
                    header("Location: login.php");
                }
            }
        }
    ?>
</head>
<body>
    <center>
        Now creating a new user:
        <form method='POST'>
            <?php echo $username_error ?>
            <label for='user'>Username</label>
            <input type='text' name='user' id='user' value='<?php echo get_var('user') ?>'><br>
            <?php echo $password_error ?>
            <label for='pass'>Password</label>
            <input type='password' name='pass' id='pass' value='<?php echo get_var('pass') ?>'><br>
            <label for='pass2'>Password (again)</label>
            <input type='password' name='pass2' id='pass2' value='<?php echo get_var('pass2') ?>'><br>
            <?php echo $email_error ?>
            <label for='email'>Email</label>
            <input type='text' name='email' id='email' value='<?php echo get_var('email') ?>'><br>
            <?php echo $usergroup_error ?>
            <label for='group'>Usergroup (user or admin)</label>
            <input type='text' name='group' id='group' value='<?php echo get_var('group') ?>'><br>
            <input type='submit' name='submit' value='Cancel'>
            <input type='submit' name='submit' value='Create'>
</body>
</html>
