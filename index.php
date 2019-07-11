<?php
// Start the session
session_start();
 
unset($_SESSION['loginName']);
unset($_SESSION['jobTitle']);

  
require_once ('docs/classes/user.php');
require_once ('docs/classes/system.php');
// echo "<pre>";
// print_r($_SESSION);    
// echo "</pre>";

//get all users {engineers}:: to be displayed on page 
$allUsers = $user->get_user_details("userid, name", '', '','');
?>    


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>denacDev Project - desings-and-issues :: CRUD </title>
    <link rel="stylesheet" href="docs/assets/css/style.css">
    <link rel="stylesheet" href="docs/assets/css/fonts.css"> 
    <link rel="stylesheet" href="docs/assets/css/index.css">
    <link rel="stylesheet" href="docs/assets/css/messages.css">
</head>
<body>

<section class="container-landing-page">
    
    <div class='container-landing'>
            <!-- logo container -->
            <div class="logo-container">
                    <a href="https://denac.info"><img width='300px' src="docs/assets/img/logo-denac-dev.svg" alt="denac logo" class="logo-image"></a>
            </div>


          
            <!-- select user form  contaienr-->
            <div class="login-container">
                
                    <hr style='border:none;'> <!-- helps with the position of the error msg -->

                        <form method='post'> 
                    


                            <!-- select your name options -->
                            <select name="loginName" class="login-name">
                            <option value='label'class='placeholder-option'>Your Name</option>
                            <?php
                                // generate all users
                                while($j = $allUsers->fetch_assoc()){     
                                    echo ("<option value='".$j['userid']."'>".$j['name']."</option>");                
                                } 
                        
                            ?> 
                    

                            </select>
                            
                        
                            <!-- hidden submit button -->
                            <input id='submit_login' type="submit" value="" style='display:none;'>
                        

                        </form>

                        <!-- submit button label -->
                        <label for="submit_login" class="form-btn login-button">Go!</label> 

                    


                    <!-- submit conditions -->
                <?php 
                            // if the post has been submitted
                            if( isset($_POST['loginName'])){
                                
                                

                                // show error if no option is selected
                                if ( $_POST['loginName'] == 'label'){ 
                                        $sys->newMsg('.login-container', 'error', 'fail', "Please select an option");
                                // continue to the run 
                                }else{
                                    // set session variables 
                                        //session userid
                                        $_SESSION["loginName"] = $_POST['loginName'];   
                                        //session jobTitle 
                                        $_SESSION['jobTitle'] =  $user->get_user_job_title($_POST['loginName']);
                        
        
                                    //redirect to index_two.php
                                    header("Location: index_two?page=designs");
                                }
                                $sys->freeMemory($allUsers);
                            } // end if isset($_POST['loginName']
                    ?>







            </div> <!-- end login container -->
            
    </div><!-- end container-landing -->




      
    
</section>



</body>
</html>



 