[1mdiff --git a/lib/includes.php b/lib/includes.php[m
[1mindex f6e95b4..0550b00 100644[m
[1m--- a/lib/includes.php[m
[1m+++ b/lib/includes.php[m
[36m@@ -154,6 +154,9 @@[m [mCSC 155-201F -->[m
     function insert_header() {[m
         echo "<center><img src='images/header.jpg'>";[m
         echo "<h2>Matt Purnell</h2><h4>CSC 155-201F</h4>";[m
[32m+[m[32m        if (isset($_COOKIE['preferred_name'])) {[m
[32m+[m[32m            echo "<p>Hello, " . $_COOKIE['preferred_name'] . "! Enjoy the site.</p>";[m
[32m+[m[32m        }[m
         echo "<br><br>";[m
     }[m
 [m
[1mdiff --git a/welcome.php b/welcome.php[m
[1mindex cdce909..bf4fbfb 100644[m
[1m--- a/welcome.php[m
[1m+++ b/welcome.php[m
[36m@@ -16,17 +16,26 @@[m [mCSC 155-201F -->[m
                     '2by2' => intval(0), '3by3' => intval(0),[m
                     '4by4' => intval(0), '5by5' => intval(0));[m
         }[m
[32m+[m[32m        if (isset($_POST['submit'])) {[m
[32m+[m[32m            setcookie('preferred_name', $_POST['name']);[m
[32m+[m[32m            header('Location: welcome.php');[m
[32m+[m[32m        }[m
     ?>[m
 </head>[m
 <body>[m
     <?php insert_header() ?>[m
     <p>[m
[31m-        Welcome to the website!! Feel free to take a look around. This is a[m
[31m-        Rubik's cube shop, and we have four different items to choose from:[m
[32m+[m[32m        <form method='POST'>[m
[32m+[m[32m            Welcome to the website!!<br>[m
[32m+[m[32m            Enter your preferred name here:[m
[32m+[m[32m            <input type='text' name='name'>[m
[32m+[m[32m            <input type='submit' name='submit' value='Enter'>[m
[32m+[m[32m        </form>[m
[32m+[m[32m        Feel free to take a look around.<br>[m
[32m+[m[32m        This is a Rubik's cube shop, and we have four different items to choose from:[m
         <a href='2by2.php'>2x2's</a>, <a href='3by3.php'>3x3's</a>,[m
[31m-        <a href='4by4.php'>4x4's</a>, and <a href='5by5.php'>5x5's</a>. Once[m
[31m-        you've added some cubes to your cart, you can view it[m
[31m-        <a href='cart.php'>here</a>.[m
[32m+[m[32m        <a href='4by4.php'>4x4's</a>, and <a href='5by5.php'>5x5's</a>.<br>[m
[32m+[m[32m        Once you've added some cubes to your cart, you can view it <a href='cart.php'>here</a>.[m
     </p>[m
     <?php insert_footer() ?>[m
 </body>[m
