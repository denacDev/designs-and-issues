 
<nav>
    <a href='?page=designs'class="nav-link nav-link-active">Designs</a> 
    <a <?php echo ($sesJobTitle == 'senior') ? " class='nav-link' href='?page=add_design'" : "  class='disabled-link nav-link'    onclick='msg(\".container-site\", \"warning\", \"privilege\",\"Add a design\")'  href='#'   " ;  ?>       >Add</a>
</nav>

<div class="primary-component-container"> 

        <div class="design-component-container">
                <?php  
                    // require all designs from database
                    $design_template = $sys->show_designs('', false);
                    $count_designs = $sys->show_designs('', true);
                    // check if there are any designs in the database
                        if ($count_designs < 1){
                            echo "<div class='warning-fixed-msg'>No Designs in database</div>";  
                        }else{ 
                            $show_single_design = "no";
                            require_once('docs/components/design-view-component.php') ;
                        } 
                ?> 
        </div>

</div><!--end of design container -->

<?php

 

if(isset($_GET['open_design'])){

    //open the body of the selected/modified design
    echo   $sys->openBody("{$_GET['open_design']}", "design" ); 
}



?>