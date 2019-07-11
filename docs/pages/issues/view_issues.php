<?php 

 // check if the id has been set
 if(isset($_GET['design_id'])){  $urlDesignId =$_GET['design_id'];  }else{ $urlDesignId=null;} 

?>
<nav>
  <?php echo "<a href='?page=designs&open_design={$urlDesignId}' class='nav-link'>&lt; Designs</a>"; ?> 

    <a href='?page=add_issue&design_id=<?php echo $urlDesignId; ?>'class="nav-link">Add issue</a>
</nav>

<div class="primary-component-container"> 

    <div class="design-component-container">
        
        <?php 
        // GET DESIGN BASED IN THE url id
        $design_template = $sys->show_designs($urlDesignId, false);
        $show_single_design = "yes";
        
        require_once('docs/components/design-view-component.php') ;
        ?> 

    </div>

    <div class="issue-component-container">

        <?php 

            //require all issues from database for the specifi url design id  
            $issue_template = $sys->show_issues('design_id', $urlDesignId, false);
            //count all issues for that design id
            $count = $sys->show_issues('design_id', $urlDesignId, true);
           
            // check if the selected design has any issues stored 
            if ($count < 1){
                echo "<div class='warning-fixed-msg'>No issue found for Design: <span class='info-msg'>".$urlDesignId. "</span></div>";  
            }else{
                require_once('docs/components/issue-view-component.php') ;
            }    
 
        ?> 
    </div>

</div><!--end of design container -->
<?php

//open the body of the selected design
echo   $sys->openBody("{$urlDesignId}", "design" ); 

if(isset($_GET['open_issue'])){

    //open the body of the selected/modified isue
    echo   $sys->openBody("{$_GET['open_issue']}", "issue" ); 
}



?>