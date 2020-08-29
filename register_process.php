
<?php

    //this is for 'filtering' the input
    function process_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    echo "<title>Francis John Magallanes</title>";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //this will handle the processing of data

        $entries = array("lastname"=>process_input($_POST['lastname']), 
                    "firstname"=>process_input($_POST['firstname']),
                    "username"=>process_input($_POST['username']),
                    "email"=>process_input($_POST['emailinput']),
                    "password"=>process_input($_POST['password']),
                    "passwordconfirm"=>process_input($_POST['passwordconfirm']));

         //this will establish the connection to server and the database
         $sqlconnect = mysqli_connect('localhost', 'root', '');
         $selectdb = mysqli_select_db($sqlconnect,'db1');

         //this is for the situation that there is a match in the database
         $query = "SELECT * FROM Records WHERE Username IN ('$entries[username]');" ;
         $results_query = mysqli_query($sqlconnect, $query);
         $arr = mysqli_fetch_array($results_query);
        

         /*
            **VALUES AND MEANING FOR 'MISTAKE'**
            duplicate - the inputted username have a duplicate in the database
            email - the inputted email is not valid
            wrongpass- there is a mismatch between the password and the password confirmation part
         */

         if($arr != NULL){
             //this will go back to the register_form.php but with the inputted data
             //so that the user doesn't need to retype the entries
            header("Location: register_form.php?mistake='duplicate'&lastname=$entries[lastname]&firstname=$entries[firstname]&emailinput=$entries[email]");
            exit();
         }
         else if(!filter_var($entries['email'], FILTER_VALIDATE_EMAIL)){
            //this will go back to the register_form.php but with the inputted data
             //so that the user doesn't need to retype the entries
            header("Location: register_form.php?mistake='email'&lastname=$entries[lastname]&firstname=$entries[firstname]&username=$entries[username]");
            exit();

         }
         else if($entries['password'] != $entries['passwordconfirm']){
             //this will go back to the register_form.php but with the inputted data
             //so that the user doesn't need to retype the entries
            header("Location: register_form.php?mistake='wrongpass'&lastname=$entries[lastname]&firstname=$entries[firstname]&emailinput=$entries[email]&username=$entries[username]");
            exit();

         }
         else{
            //this will store the inputted information in the database once there is no more errors
            $query = "INSERT INTO Records(LastName,FirstName,Username,Password,Email) VALUES
                ('$entries[lastname]','$entries[firstname]','$entries[username]','$entries[password]','$entries[email]')";
            
            $results_query = mysqli_query($sqlconnect, $query);

            if($results_query){
                header("Location: successful_register.html");
                exit();
            }
            else{
                die("Failed to register due to {mysqli_error()}");
            }
         }
        
        

    }

?>