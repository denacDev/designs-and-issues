<?php

require_once ('docs/classes/database.php');
class System extends Database{ 
      
  // MSG
             
            //show - hide

            /** * Show a msg on the DOM using javascript
             * * newMsg
             
             
             * @param  mixed $container - in which container the msg will appear
             * @param  mixed $type - type of msg [info, warning, success, error]
             * @param  mixed $action - (predefined msg) [add-ok / add-fail]  [edit-ok / edit-fail]  [delete-ok / delete-fail] [check-ok /check-fail]  [privilege] [login-fail]
             * @param  mixed $value - custom msg.
             *
             * @return void
             */
            public function newMsg($container, $type, $action, $value){  
                
                $jsFunction = "msg('{$container}'  ,    '{$type}',   '{$action}',   '{$value}')"; 
                
                
                /* 
                    * the script is already included in index_two.php 
                    * because of the way the navigation system is done, 
                    * each other page cannot see it so it has to be included every time a msg is displayed.
                */
                
                echo "<script src=\"docs/assets/js/messages.js\"></script>"; 
                echo "<script>  ".$jsFunction." </script>";
                
            }  

            //show - hide - redirect
           
            /** * Show a msg on the DOM using javascript and redirect the page
             * redirectMsg
             * 
             *   @param  mixed $container  in which container the msg will appear  
             *   @param  mixed $type  type of msg 
             * * [info, warning, success, error] 
             *   @param  mixed $action (predefined msg) 
             * * [add-design] [delete-design][edit-design]
             * * [add-issue] [delete-issue][edit-issue][check-issue]
             * * [user-not-logged] 
             *   @param  mixed $page (predefined links)
             * * [login-page] - index.php
             * * [designs] -    index_two.php?page=designs
             * * [issues]  -    index_two?page=issues&design_id=${design_id}
             * * [edit_issue] - index_two?page=issues&design_id=${design_id}&open_issue=${issue_id}
             *   @param  mixed $design_id - self explanatory
             *   @param  mixed $issue_id -  - self explanatory
             *
             *   @return void
             */
            public function redirectMsg($container, $type, $action, $page,$design_id, $issue_id ){  
                
                $jsFunction = "redirect('{$container}'  ,    '{$type}',   '{$action}',   '{$page}', '{$design_id}', '{$issue_id}'  )"; 
                

                /* 
                    * the script is already included in index_two.php 
                    * because of the way the navigation system is done, 
                    * each other page cannot see it so it has to be included every time a msg is displayed.
                */
                echo "<script src=\"docs/assets/js/messages.js\"></script>"; 
                echo "<script>  ".$jsFunction." </script>";
                
            }  







 // CLEAN
     
        /**  * cleans users input data
         * sanitizeData
         * 
        
         *
         * @param  mixed $entry
         *
         * @return $data
         */
        public function sanitizeData($entry){
            $data = parent::conn()->real_escape_string($entry); 
            return $data; 
        }
 
        
        /** * Release results from memory after use
         * freeMemory
         
         *
         * @param  mixed $objects 
         *
         * @return void
         */
        public function freeMemory($objects){
            $count = 0;
            
            //var_dump($objects);
            foreach($objects as $obj){
                
                $count++;
                if(is_object($obj)){ $obj->free_result();   }       
            }

            // if ($count == 1){echo "done, {$count} object freed";}
            // else{   echo "done, {$count} objects freed";    } 

        }
    

        
// MISC ACTIONS        

    /** *  opens the body of an desing/ issue based on their id.
     * openBody 
     * @param  mixed $singleId
     * @param  mixed $for
     *
     * @return void
     */
    public function openBody($singleId, $for){ 
        
            if ($for == "issue"){
                
                //used in javascript
                $panelId  = "'issue-panel-".$singleId."'";
                $buttonId = "'issue-button-".$singleId."'"; 
                
            }
    
        
            if ($for == "design"){
                
                //used in javascript
                $panelId  = "'design-panel-".$singleId."'";
                $buttonId = "'design-button-".$singleId."'";
                
            }
    
            $ids = $panelId.",".$buttonId;
            $jsFunction = "openBody({$ids})"; 
            
    
            // insert the script again because the TARGET page does not about it on index_two.php
            echo "<script src=\"docs/assets/js/panels.js\"></script>"; 
            echo "<script>  ".$jsFunction." </script>";
    
    }
  
    
    
    /** * modifies the date comming from DB because it comes with time( i need only the date)
     * dateMod
     * @param  mixed $dateTime
     *
     * @return void
     */
    public function dateMod($dateTime){ 
        // get only the date
        $onlydate = explode(' ', $dateTime); 
        // change the order date 
        return $onlydate[0];
    }




    
    /** * show all designs in database
     * show_designs
     *
     * @param  mixed $limit is the WHERE selector in the query
     * @param  mixed $total if a count is needed [true/false]
     *
     * @return void
     */
    public function show_designs($limit, $total){ 

        if(!empty($limit)){
             // GET DATA BASED ON foreign ID :: ALL FIELDS 
            $sql = "SELECT * FROM designs WHERE id = '{$limit}' ORDER BY id DESC";  
        }else{
            // GET DATA :: ALL FIELDS 
             $sql = "SELECT * FROM designs ORDER BY id DESC"; 
        }

        $result = parent::conn()->query($sql); 
        $count = $result->num_rows;

         // count all entries in a table
         if($total === true){
            return $count;
        }else{
            return $result;  
        }
           
    }

    
    /** * show all issues in the database based on design id
     * show_issues
     *
     * @param  mixed $condition
     * @param  mixed $value
     * @param  mixed $total
     *
     * @return void
     */
    public function show_issues($condition, $value, $total){
        if(!empty($condition) && !empty($value)){

            $sql = "SELECT * FROM design_issues WHERE {$condition} = '{$value}' ORDER BY id DESC"; 
             
        }else{
            die( "Something is wrong in function show_issues($condition, $value, $total)");
        } 

        $result = parent::conn()->query($sql); 
        $count = $result->num_rows;

         // count all entries in a table
         if($total == true){
            return $count;
        }else{
            return $result;  
        }

    }


    
    /** * get one value from one table based on options
     * getTable
     *
     * @param  mixed $column
     * @param  mixed $tbl
     * @param  mixed $otherColumn
     * @param  mixed $value
     *
     * @return void
     */
    public function getTable($column, $tbl, $otherColumn, $value){

        if(empty($otherColumn) && empty($value)){
            // GET SPECIFIC DATA :: ALL ENTRIES 
            $sql = "SELECT {$column} FROM {$tbl} ORDER BY id DESC";  
        }else{
            //select column based on DIFFERENT column of the table  
            $sql = "SELECT {$column} FROM {$tbl} WHERE {$otherColumn} = '{$value}' ";
        }

        $result = parent::conn()->query($sql); 


        if(empty($otherColumn) && empty($value)){
            return $result;  
        }else{
            return $result->fetch_array();   
        }

         
    }

    




}
$sys = new System();

?>