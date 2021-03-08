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
        require('lib/includes.php');

        if (get_var('submit')) {
            if (get_var('submit') == 'Login') {
                if (get_var('user') == 'csc155user'
                        and get_var('pass') == 'csc155pass') {
                    header('Location: welcome.php');
                }
                else {
                    echo "Invalid username or password";
                }
            }
            else if (get_var('submit') == 'Hint') {
                echo "Try username: 'csc155user'
                        and password: 'csc155pass'";
            }
        }
    ?>
</head>
<body>
    <center>
    <h1>This is a class site! Do not use a real password!</h1>
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
                    <input type='submit' name='submit' value='Hint'>
                </td>
            </tr>
        </table>
    </form>
    </center>
</body>
</html>
