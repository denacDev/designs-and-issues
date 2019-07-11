<?php
 
require_once ('docs/classes/system.php');
class User extends System{ 
      

// USER DETAILS
        
        /** * get user details
         * get_user_details($column, $condition, $value)
         * 
         * * get all user details
            
         *  ( ' * ', '', '' ); 
         
         *  SELECT {$column},  'design_engineers' as table_name  FROM [[designer table]]
         * ----------------------------------------------
         * 
         * * get specific user details
         
         *  ( ' userid, name, etc ', '', '' ); 
         
         *  SELECT {$column},  'design_engineers' as table_name  FROM [[designer table]]
         * ----------------------------------------------
         *  
         * * get specific user details based on a conditional column and value
         
         *  ( ' userid, name, etc ', 'id', '1001' ); 
         
         *  SELECT {$column},  'design_engineers' as table_name  FROM [[designer table]] where {$condition} = '{$value}' 
         * ----------------------------------------------
         *  
         * * return a single value from database and make it associative array
         
         *   $fullName = $user->get_user_details('name', 'userid', $sesUserName, 'echo');
         
         *   echo $fullName['name']; 
         
         * ----------------------------------------------
         *
         * @param  mixed $column :: example -> [ id, userid, name, etc.]
         * @param  mixed $condition :: example -> select data from table where $condition [id, userid, name, etc]
         * @param  mixed $value :: example -> where condition = $value(from other source) [id, userid, name, etc]
         * @param  mixed $print :: if is set to ECHO it returns assoc_array and not mysqli object[ useful when just printing a value from a table]
         *
         * @return void
         */
        public function get_user_details($column, $condition, $value, $print){
    
            if(empty($condition)){
                    
                $sql = "SELECT {$column},'design_engineers' as table_name FROM design_engineers 
                        UNION 
                        SELECT {$column},'design_senior_engineers' as table_name FROM design_senior_engineers
                        ";
    
            }else{
                
                $sql = "SELECT {$column},'design_engineers' as table_name FROM design_engineers where {$condition} = '{$value}' 
                        UNION 
                        SELECT {$column},'design_senior_engineers' as table_name FROM design_senior_engineers where {$condition} = '{$value}'
                        ";
    
            }
           
          
            $result = parent::conn()->query($sql);  
             $count = $result->num_rows;
             if ($count < 1){ echo "nothing found!, try again <br>{$sql}";}
             else{ 
                 
                
                if($print == 'count'){ 
                    return $count;
          }else if($print == 'echo'){
                        return $result->fetch_array();       
                }else{
                        return $result;
    
                 } // end if print
            } //end if count
    
          
        }
        
        
        /**
         * get_user_job_title
         * 
         *  sets a fake column called 'table_name' and its value is set manually
         *  which determines the job of the user and it returns it
         *
         * @param  mixed $userId  
         *
         * @return $job
         */
        public function get_user_job_title($userId){
                //select all engineers
                $job = '';
                // GET SPECIFIC DATA :: from all engineers
               $sql = "SELECT userid,'design_engineers' as table_name FROM design_engineers where userid = '{$userId}' 
                       UNION 
                       SELECT userid,'design_senior_engineers' as table_name FROM design_senior_engineers where userid = '{$userId}'
                       ";
    
    
                $result = parent::conn()->query($sql);  
                while(  $j = $result->fetch_assoc()){ 
                    $table =   $j['table_name'];  
                    if ($table == "design_engineers"){$job = "junior";}  else{$job = "senior"; } 
                }
                
                  return $job;
       }

        
    


// CONTROL THE DESIGNS
     
        //add design
        public function addDesign($stayOrGo, $customer, $location, $contractor, $design_title, $design_type_id, $special_project, $permanent_works, $depth, $length, $width){
     
    
                $sql = "INSERT INTO `designs`(`id`, `customer_id`,`location_id`,`contractor_id`,`title`,`special_project`,`permanent_works`,`depth`,`length`,`width`,`design_type_id`)
                        VALUES( NULL,'$customer','$location','$contractor','$design_title','$special_project', '$permanent_works','$depth','$length','$width', '$design_type_id')";
    
                parent::conn()->query($sql); 
                if ( parent::conn()->error) { 
                    $error = "MySQL error ".parent::conn()->error.": \n<br>When executing:<br>\n$sql\n<br>"; 
                    parent::newMsg('.container-site', 'error', 'add-fail', 'Design');
                    die($error);
    
                }else{ 
                    if($stayOrGo == 'go'){
                        parent::redirectMsg('.container-site', 'success', 'add-design', 'designs','', '' );
                    }else{
                        parent::newMsg('.container-site', 'success', 'add-ok', 'Design');
                        
                    }
    
                }    
    
        } 
    
    
        // edit design
        public function editDesign($idToUpdate, $customer, $location, $contractor, $design_title, $design_type_id, $special_project, $permanent_works, $depth, $length, $width){
            
    
                $sql = "UPDATE `designs` SET `customer_id` = '$customer',
                                                `location_id` = '$location',
                                                `contractor_id` = '$contractor',
                                                `title` = '$design_title',
                                                `special_project` = $special_project,
                                                `permanent_works` = $permanent_works,
                                                `depth` = '$depth',
                                                `length` = '$length',
                                                `width` = '$width',
                                                `design_type_id` = '$design_type_id' 
                        WHERE `id` = $idToUpdate "; 
                        
    
                parent::conn()->query($sql); 
                if ( parent::conn()->error) { 
                $error = "MySQL error::  ".parent::conn()->error.": \n<br>When executing:<br>\n$sql\n<br>"; 
                    parent::newMsg('.container-site', 'error', 'edit-fail', 'Design');
                die($error); 
                }else{   
                    parent::redirectMsg('.container-site', 'success', 'edit-design', 'issues',"{$idToUpdate}", '' );
                }    
    
        } 
    
        //delete design
        public function deleteDesign($idToDelete){

            $sql = "DELETE FROM `designs` WHERE `id` = $idToDelete"; 

            parent::conn()->query($sql); 
            if ( parent::conn()->error) { 
            $error = "MySQL error::  ".parent::conn()->error.": \n<br>When executing:<br>\n$sql\n<br>"; 
                parent::newMsg('.container-site', 'error', 'delete-fail', 'Design');
            die($error);
    
            }else{  
                parent::redirectMsg('.secondary-component-container', 'success', 'delete-design', 'designs', "{$idToDelete}",'' );
            }    
    
            
        } 
    
        
    

    


// CONTROL THE ISSUES 

        //add issue
        public function addIssue($stayOrGo, $design_id, $category_id, $description, $date_in, $date_out, $designer_id,  $status_id, $drawing_req){
            
            $sql =" INSERT INTO `design_issues`( `id`, `design_id`, `category_id`, `description`, `date_in`, `date_out`, `designer_id`, `checker_id`, `status_id`, `drawing_req` )
                                        VALUES ( NULL, '$design_id', '$category_id', '$description', '$date_in', '$date_out', '$designer_id', NULL, '$status_id', '$drawing_req'); ";

            parent::conn()->query($sql);     
            if (parent::conn()->error) { 
            echo "<div class='control-tab'>";
                $error = "<br>MySQL error ".parent::conn()->error.": \n<br>When executing:<br>\n$sql\n<br>"; 
                    parent::newMsg('.container-site', 'error', 'add-fail', 'Issue');
                die($error);
                echo "</div>";
            }else{
                
                if($stayOrGo == "go"){
                    parent::redirectMsg('.container-site', 'success', 'add-issue', 'issues',"{$design_id}", '' );
                }else{
                   parent::newMsg('.container-site', 'success', 'add-ok', 'Issue');
                    
                }

            }    

        } 


        //edit issue
        public function editIssue($design_id, $idToUpdate,  $category_id, $description, $date_in, $date_out, $designer_id,  $status_id, $drawing_req){
            $sql =" UPDATE design_issues SET   
                                            `category_id` = '$category_id',
                                            `description` = '$description',
                                            `date_in` = '$date_in',
                                            `date_out` = '$date_out',
                                            `designer_id` = '$designer_id',
                                            `checker_id` = NULL,
                                            `status_id` = '$status_id',
                                            `drawing_req` = '$drawing_req'
                    WHERE `id` = $idToUpdate "; 
                                        

            parent::conn()->query($sql); 
            if ( parent::conn()->error) { 
                $error = "MySQL error::  ".parent::conn()->error.": \n<br>When executing:<br>\n$sql\n<br>"; 
                parent::newMsg('.container-site', 'error', 'edit-fail', 'Issue');
                die($error); 
            }else{  
              
                 parent::redirectMsg('.container-site', 'success', 'edit-issue', 'edit_issue',"{$design_id}", "{$idToUpdate}" );
            } 
            
            
        } 
        

        // deleteIssue
        public function deleteIssue($idToDelete, $design_id){
        

            $sql = "DELETE FROM design_issues  WHERE  id  = $idToDelete";
            
            parent::conn()->query($sql); 
            if ( parent::conn()->error) { 
                $error = "MySQL error::  ".parent::conn()->error. ": \n<br>When executing:<br> $sql <br>"; 
                    parent::newMsg('.container-site', 'error', 'delete-fail', 'Issue');
                die($error);

            }else{  
               parent::redirectMsg('.secondary-component-container', 'success', 'delete-issue', 'issues',"{$design_id}", "{$idToDelete}" );
            }    
             

        } 
        
        // check issue
        public function checkIssue($senior_id, $idToCheck, $design_id){

            $sql = "UPDATE design_issues SET checker_id = $senior_id WHERE id = $idToCheck";
           
            parent::conn()->query($sql); 
            if ( parent::conn()->error) { 
            $error = "MySQL error::  ".parent::conn()->error.": \n<br>When executing:<br>\n$sql\n<br>"; 
                parent::newMsg('.container-site', 'error', 'check-fail', "{$idToCheck}");
            die($error);

            }else{  
            
                parent::redirectMsg('.container-site', 'success', 'check-issue', 'edit_issue',"{$design_id}","{$idToCheck}");
                
            }    
        

        } 

}  

$user = new User();

 

 
?>