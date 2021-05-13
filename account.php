<!--  I honor Parkland's core values by affirming that I have
followed all academic integrity guidelines for this work.
Matt Purnell
CSC 155-201F -->
<!DOCTYPE html>
<html lang='en-us'>
<head>
    <meta charset='UTF-8'>
    <title>User Account Page</title>
    <?php
        session_start();
        require('lib/includes.php');
        confirm_login();

        $action_message = '';
        $curr_pass_error = '';
        $new_pass_error = '';
        if (isset($_POST['submit'])) {
            if ($_POST['submit'] == 'Change Password') {
                if (!verify_password($_SESSION['user'], get_var('curr_pass'))) {
                    $curr_pass_error = "Sorry, that password doesn't match our records.<br>";
                }
                else if (empty(get_var('curr_pass'))) {
                    $curr_pass_error = "Current password cannot be empty.<br>";
                }
                else if (empty(get_var('new_pass')) or empty(get_var('new_pass2'))) {
                    $new_pass_error = "New password cannot be empty.<br>";
                }
                else if (get_var('new_pass') != get_var('new_pass2')) {
                    $new_pass_error = "Both new passwords must match.<br>";
                }
                else {
                    $conn = get_conn();
                    $sql = "UPDATE users SET encrypted_password=? WHERE username=?;";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $pass, $user);
                    $pass = password_hash(get_var('new_pass'), PASSWORD_DEFAULT);
                    $user = $_SESSION['user'];
                    $stmt->execute();
                    $action_message = "<i>Password updated</i><br>";
                }
            }
        }
    ?>
</head>
<body>
    <?php insert_header() ?>
    <h2>Account Page</h2>
    <p>
        Welcome to your account page. Personal information such as your past orders
        and account settings can be found here.
    </p>
    <h4>Past Orders</h4>
    <?php print_orders_for_user_as_table() ?>
    <h4>Change Your Password</h4>
    <?php echo $action_message ?>
    <br>
    <form method="POST">
        <?php echo $curr_pass_error ?>
        <label for="curr_pass">Current Password</label>
        <input type="password" name="curr_pass" id="curr_pass"><br>
        <?php echo $new_pass_error ?>
        <label for="new_pass">New Password</label>
        <input type="password" name="new_pass" id="new_pass"><br>
        <label for="new_pass2">New Password (Again)</label>
        <input type="password" name="new_pass2" id="new_pass2"><br>
        <input type="submit" name="submit" value="Change Password">
    </form>
    <?php insert_footer() ?>
</body>
</html>
