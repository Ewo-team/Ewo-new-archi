<?php

class Database_model extends CI_Model{
    
    private $base_list = array();
    const INSTALL_JSON      = 'application/install/database.json';
    const INSTALL_FOLDER    = 'application/install/';
    const DB_CONFIG         = 'application/config/database.php';
    
    public function create_table($table_name){
        if (is_string($table_name) AND !empty($table_name) AND file_exists(self::INSTALL_FOLDER.$table_name.'.sql')) {
            $rq = $this->load->file(self::INSTALL_FOLDER.$table_name.'.sql', true);
            $this->db->exec($rq);
        }
    }
    
    public function get_tables_list(){
        if($this->decode($this->load->file(self::INSTALL_JSON, true))){
            $ret = array();
            foreach($this->base_list as $table){
                $ret[$table] = $this->db->table_exists($table);
            }
            return $ret;
        }
        return false;
    }
    
    public function setConfig($host, $user, $password, $base){
        $fileArray = file(self::DB_CONFIG);
        $file = '';
        foreach ($fileArray as $line)
            $file .= $line;
        $vars_to_change = array(
            'hostname'  => $host,
            'username'  => $user,
            'password'  => $password,
            'database'  => $base
        );
        foreach($vars_to_change as $key => $value){
            $regex = '#\$db\[\''.ENVIRONMENT.'\'\]\[\''.$key.'\'\] = \'(.*)\';#i';
            $file = preg_replace($regex, '$db[\''.ENVIRONMENT.'\'][\''.$key.'\'] = \''.$value.'\';', $file);
        }
        //Write file
        $fp = fopen(self::DB_CONFIG, 'w');
        fwrite($fp, $file);
        fclose($fp);
    }

    /**
     * decode Json file
     * @param type $file
     * @return type 
     */
    private function decode($file) {
        $config = json_decode($file);
        foreach($config->tables as $table){
            $this->base_list[] = $table;
        }
        return true;
    }
}