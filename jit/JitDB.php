<?php
/**
 * Database Driver
 * By:
 * Md. Ahsan Habib
 * Email: ahsan@codejit.com
 * Copyright@ Codejit Solutions (codejit.com)
 */
class JitDB {
    protected $db;
    private $host;
    private $dbname;
    private $user;
    private $password;
    protected $stmt;
    public function __construct() {
        //;
        $this->configConnection();
        $this->openConnection();
       
    }
    public function query($sql){
        $this->stmt = $this->db->prepare($sql);
    }
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    public function execute() {
        return $this->stmt->execute();
    }
    public function resultset() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function rowCount() {
        return $this->stmt->rowCount();
    }
    public function lastInsertId() {
        return $this->db->lastInsertId();
    }
    public function beginTransaction() {
        return $this->db->beginTransaction();
    }
    public function endTransaction(){
        return $this->db->commit();
    }
    public function cancelTransaction() {
        return $this->db->rollBack();
    }
    public function debugDumpParams() {
        return $this->stmt->debugDumpParams();
    }
    public function openConnection() {
        //;
        try {            
            $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->user, $this->password);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }
    public function configConnection(){
        require 'config.php';
        $this->host = $config['host'];
        $this->dbname = $config['dbname'];
        $this->user = $config['user'];
        $this->password = $config['password'];
    }
    public function closeConnection(){
        if(!empty($this->db)) $this->db = null;
    }

    public function __destruct() {
        $this->closeConnection();
    }
}
/**
 * Database Driver
 * By:
 * Md. Ahsan Habib
 * Email: ahsan@codejit.com
 * Copyright@ Codejit Solutions (codejit.com)
 */