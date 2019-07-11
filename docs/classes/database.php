<?php

class Database{
    private $_connection;
     
    /** * connect to db
     * __construct
     *
     * @return void
     */
    function __construct() { 
    
        $this->_connection =  new mysqli('localhost', 'root', '', 'exercises');
        // Error handling 
        if ($this->_connection->connect_error)
        {
            trigger_error("Connection Error: " . $this->_connection->connect_error(), E_USER_ERROR);
        }
    }
    
     
    /** * Magic method clone is empty to prevent duplication of connection
     * __clone
     *
     * @return void
     */
    private function __clone() { }
    
    
     
    /** * Get mysqli connection
     * conn
     *
     * @return void
     */
    public function conn() {
        return $this->_connection;
    } 
}
 
?>