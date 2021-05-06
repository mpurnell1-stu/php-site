<!--  I honor Parkland's core values by affirming that I have
followed all academic integrity guidelines for this work.
Matt Purnell
CSC 155-201F -->
<!DOCTYPE html>
<html lang='en-us'>
<head>
    <meta charset='UTF-8'>
    <title>Class Site Login</title>
    <?php
        session_start();
        require('lib/includes.php');

        $username_error = "";
        $password_error = "";

        if (isset($_SESSION['user'])) {header('Location: welcome.php');}
        if (isset($_POST['submit'])) {
            if (get_var('submit') == 'Login') {
                $conn = get_conn();
                $row = get_user_row($conn, get_var('user'));

                if ($row) {
                    if (password_verify(get_var('pass'), $row['encrypted_password'])) {
                        $_SESSION['user'] = $row['username'];
                        $_SESSION['group'] = $row['usergroup'];
                        header('Location: welcome.php');
                    }
                    else {
                        $password_error = "Sorry, that password was incorrect. Please try again<br>";
                    }
                }
                else {
                    $username_error = "No users found for that username. Please try again<br>";
                }
            }
            else if (get_var('submit') == 'Create New User') {
                header("Location: create_user.php");
            }
            else if (get_var('submit') == 'Hint') {
                echo "There is still a built-in user. Try 'csc155user' and 'csc155pass'.<br>";
                echo "To test admin functions, use 'csc155admin' and 'csc155pass'.";
            }
        }
    ?>
</head>
<body>
    <center>
    <h1>This is a class site! Do not use a real password!</h1>
    <?php echo $username_error ?>
    <?php echo $password_error ?>
    <form method='POST'>
        <table>
            <tr>
                <td><label for='name'>Username: </label></td>
                <td><input type='text' name='user' id='user'></td>
            </tr>
            <tr>
                <td><label for='pass'>Password: <b>(Not your real one!)</b></label></td>
                <td><input type='password' name='pass' id='pass'></td>
            </tr>
            <tr>
                <td colspan=2 align='center'>
                    <input type='submit' name='submit' value='Login'>
                    <input type='submit' name='submit' value='Create New User'>
                    <input type='submit' name='submit' value='Hint'>
                </td>
            </tr>
        </table>
    </form>
    </center>
</body>
</html>
