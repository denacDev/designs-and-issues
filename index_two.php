<?php
// Start the session
session_start();
 
 
require_once ('docs/classes/user.php');
require_once ('docs/classes/system.php');
// echo "<pre>"; print_r($_SESSION);  echo "</pre>"; 

 
   
    if (!isset($_SESSION['loginName']) && !isset($_SESSION['jobTitle'])){ 
        
        header("Location: index.php");
    
    }else{ 
        // set all global variables
        $sesUserName = $_SESSION['loginName'];
        $sesJobTitle = $_SESSION['jobTitle']; 

      //get the current page if isset, if not set is as default to desings
     if(isset($_GET['page'])){  $page =$_GET['page'];  }else{ $page='designs';}
        
        // check if the id of the design has been set [ IF NOT, SET IT]
        if(isset($_GET['design_id'])){  $urlDesignId =$_GET['design_id'];  }else{ $urlDesignId=null;} 
        if(isset($_GET['issue_id'])){  $urlIssueId =$_GET['issue_id'];  }else{ $urlIssueId=null;} 

    }
// get full name of the logged user based on session userid
$fullName = $user->get_user_details('name', 'userid', $sesUserName, 'echo');
 

    
?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>denac installation design :: CRUD </title>
    <!-- general -->
    <link rel="stylesheet" href="docs/assets/css/style.css">
    <link rel="stylesheet" href="docs/assets/css/fonts.css">
    <link rel="stylesheet" href="docs/assets/css/messages.css">
    <link rel="stylesheet" href="docs/assets/css/index_two.css">

    <!-- designs -->
    <link rel="stylesheet" href="docs/assets/css/designs/add_designs.css">
    <link rel="stylesheet" href="docs/assets/css/designs/delete_design.css">
    <link rel="stylesheet" href="docs/assets/css/designs/edit_design.css">
    <link rel="stylesheet" href="docs/assets/css/designs/view-designs.css">

    <!-- issues -->
    <link rel="stylesheet" href="docs/assets/css/issues/view-issues.css">
</head>
<body>

<header class="login-container">
    <span class="login-caption">Logged as: </span>
    <span class="login-name"><?php echo $fullName['name']; ?> </span>
    <span class="login-caption"><?php  echo  "( ".ucfirst($sesJobTitle)." engineer )";   ?></span>
    <a style='display:inline-block;' href="index.php" class="site-link">Log Out</a>
</header>


<section class="container-site">
<?php


  

switch($page){
    // designs options
    case 'add_design'  : require_once('docs/pages/designs/add_design.php'); break;
    case 'delete_design'       : require_once('docs/pages/designs/delete_design.php'); break;
    case 'edit_design'         : require_once('docs/pages/designs/edit_design.php'); break;
    case 'designs'      : require_once('docs/pages/designs/view_designs.php');  break;

    // issues
    case 'add_issue'    : require_once('docs/pages/issues/add_issue.php'); break;
    case 'delete_issue' : require_once('docs/pages/issues/delete_issue.php'); break;
    case 'edit_issue'   : require_once('docs/pages/issues/edit_issue.php'); break;
    case 'issues'       : require_once('docs/pages/issues/view_issues.php'); break;
}
?>
</section>

</body>

    <script src="docs/assets/js/panels.js"></script>
    <script src="docs/assets/js/messages.js"></script>
    
</html>


