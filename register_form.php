<html>
<body>

    <link rel="stylesheet" href="login_register_page.css">
   
    <style>
        /**this will overwrite the some of the properties of p.error from the external link */
        p.error{
        text-align: center;
        left: 350px;
        top: 500px;
        }
    </style>
   <title>Francis John Magallanes</title>

    <?php
        
        /**
         * This part of code is for setting up the form. It will also put values in the field
         * if the user previously inputted but there is a mistake in the input.
         * Note: This page is dependent to register_process.php file
         */

        echo '<div class="page">';
        echo '<h1>REGISTRATION</h1>';
        echo '<form action="register_process.php" method="POST">';
        echo "<table>";

        echo "<tr>";
        echo "<td>Lastname:</td>";
        if(isset($_GET['lastname'])){
            echo '<td><input type="text" name="lastname" value="'.$_GET['lastname'].'"/></td>';
        }
        else{
            echo '<td><input type="text" name="lastname" required/></td>';
        }
        echo "</tr>";

        echo "<tr>";
        echo "<td>Firstname:</td>";
        if(isset($_GET['firstname'])){
            echo '<td><input type="text" name="firstname" value="'.$_GET['firstname'].'" required/></td>';
        }
        else{
            echo '<td><input type="text" name="firstname" required/></td>';
        }
        echo "</tr>";

        echo "<tr>";
        echo "<td>Email:</td>";
        if(isset($_GET['emailinput'])){
            echo '<td><input type="text" name="emailinput" value="'.$_GET['emailinput'].'" required/></td>';
        }
        else{
            echo '<td><input type="text" name="emailinput" required/></td>';
        }
        echo "</tr>";


        echo "<tr>";
        echo "<td>Username:</td>";
        if(isset($_GET['username'])){
            echo '<td><input type="text" name="username" value="'.$_GET['username'].'" required/></td>';
        }
        else{
            echo '<td><input type="text" name="username" required/></td>';
        }
        echo "</tr>";

        echo '<tr>';
        echo  '<td>Password:</td>';
        echo '<td><input type="password" name="password" required></td>';
        echo '</tr>';

        echo '<tr>';
        echo  '<td>Re-type Password:</td>';
        echo '<td><input type="password" name="passwordconfirm" required></td>';
        echo '</tr>';
        
        echo "</table>";
        echo '<input type="submit" value="Register">';
        echo "</form>";
        echo '<form action="login_page.php">';
        echo '<input type="submit" value="Cancel">';
        echo "</form>";
        echo "</div>";
        
        /**
         * This is for the display of the error message
         */

         if(isset($_GET['mistake'])){
            
            $mistake = $_GET['mistake'];
            if($mistake == "'duplicate'"){
                echo "<p class='error'> The inputted username is already taken. Please choose another username.</p>";
            }
            else if($mistake == "'email'"){
                echo "<p class='error'> The inputted email is not valid. Please input a valid email.<p>";
            }
            else if($mistake == "'wrongpass'"){
                echo "<p class='error'>The inputted password is not same with the re-typed password.<br>Please try again.</p>";
            }

         }

    ?>

</body>
</html>