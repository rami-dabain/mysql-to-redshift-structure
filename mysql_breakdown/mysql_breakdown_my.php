<?php
require_once dirname(__FILE__).'/mysql_breakdown_table.php';
/**
 * Description of mysql_breakdown
 *
 * @author Rami Dabain
 * email : brains@okitoo.net
 * skype : ronan_dejhero
 */
class mysql_breakdown_my {
    private $tables = array();
    
    private $my_connected = false;
    
    private $mydb = '';                         // store db handler
    ////
    private $process_local_tables = array();    //Which table to process , empty for all
    private $db_options = array();              //Which table to process , empty for all
    //
    //put your code here
    public function __construct($host = 'localhost', $port = 3306, 
                                $user = '', $pass = '', $db = '') {
        $this->db_options["host"] = $host;
        $this->db_options["port"] = $port;
        $this->db_options["user"] = $user;
        $this->db_options["pass"] = $pass;
        $this->db_options["db"] = $db;
    }
    
    /**
     * setTables
     * 
     * Select which tables to create/modify, if no tables were set
     * all tables in the DB will be processed
     * 
     * @param: array $tables;
     * @return bool
     */
    
    public function setTables($tables = array()){
        if (!is_array($tables)){return false;}
        $this->process_local_tables = $tables;
        return true;
    }
    
    public function breakdown(){
        $this->connect_db();
        // if no tables specified , clone all the database structure
        if (count($this->process_local_tables) == 0){
            $this->loadDbTables();
        }
        
        // generate tables
        empty($this->tables);
        foreach ($this->process_local_tables as $table_name){
            $table = $this->parseTable($table_name);
            $this->tables[] = $table;
        }
        
        return $this->tables;
    }
    
    private function connect_db(){  // use only on public functions
        if ($this->my_connected == true){return;}
        if ($this->my_connected == false){
            $this->mydb = mysql_connect($this->db_options["host"], 
                                    $this->db_options["user"], 
                                    $this->db_options["pass"]);
            mysql_select_db($this->db_options["db"], $this->mydb);
            $this->my_connected = true;
        }
    }
    
    /**
     * loads database tables into the array
     */
    private function loadDbTables(){
        $query = mysql_query('SHOW TABLES',$this->mydb);
        empty($this->process_local_tables);
        while ($table = mysql_fetch_array($query)){
            $this->process_local_tables[] = $table[0];
        }
    }
    
    /**
     * Creates a table structure object
     * @param string $table_name
     */
    private function parseTable($table_name){
        $query = mysql_query('DESC '.$table_name,$this->mydb);
        $fields = array();
        while ($fds = mysql_fetch_object($query)){
            $fields[] = $fds;
        }
        $tblObject = new mysql_breakdown_table($table_name, $fields);
        return $tblObject;
    }
}
