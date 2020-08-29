<!DOCTYPE html>
<html>
<body>

    <title>Francis John Magallanes</title>
    
    <link rel="stylesheet" href="login_register_page.css">
    
    <div class="page">
        <h1>Login Page</h1>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" class= "inputfield">

            <table>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" required></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" id ="passwordID" required></td>
                    <td class="showpass"><input type="checkbox" onclick="toggle()"> Show Password</td>
                </tr>

            </table>
            <input type="submit" name="submit" value="Submit">
        </form>

        <form>
            <!--
                this will redirect the user to the register page.
            -->
            <button type="submit" formaction="register_form.php" formtarget="_self" class="inputfield">Register</button>
        </form>
    </div>
        
    
    <script>
        
        function toggle(){

             /*
            this part of code is from
            https://www.geeksforgeeks.org/show-hide-password-using-javascript/ 
            for the showing of the password.
            */

            var pwfield = document.getElementById("passwordID");
    
            if(pwfield.type === "password"){
                pwfield.type = "text";
            }
            else{
                pwfield.type = "password";
            }
        }
        
    </script>

    <?php

        //this is for 'filtering' the input
        function process_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function head(){
            //this will establish the connection to server and the database
            $sqlconnect = mysqli_connect('localhost', 'root', '');
            $selectdb = mysqli_select_db($sqlconnect,'db1');

             //this will get the password of the inputted user
            $query = "SELECT Password FROM Records WHERE Username IN ('$_REQUEST[username]') " ;

            $results_query = mysqli_query($sqlconnect, $query);

            //this will retrive the password in the database
            $password = mysqli_fetch_array($results_query);

            if($password == NULL){
                //this is for the invalid no username recorded in the database
                echo "<p class='error'> Wrong Username or Password! </p>";
                exit();
            }
            else{
                                    
                 $inputtedpassword = process_input($_POST['password']);

                 if($password['Password'] == $inputtedpassword){
                     
                     //this will open the greeting file
                     header("Location: greeting.html");
                     exit();

                 }
                 else{
                     //this is for the wrong password entered
                     echo "<p class='error'> Wrong Username or Password! </p>";
                     exit();
                 }

            }  
            
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            head();
        }
       
    ?>

</body>
</html>