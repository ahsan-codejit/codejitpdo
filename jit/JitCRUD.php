<?php
/**
 * Database Driver
 * By:
 * Md. Ahsan Habib
 * Email: ahsan@codejit.com
 * Copyright@ Codejit Solutions (codejit.com)
 */
require_once 'JitDB.php';
class JitCRUD extends JitDB {
    protected $table;
    public function __construct($table='') {
        parent::__construct();
        if(!empty($table)) $this->table=$table;
    }
    public function fetch($cond=array(),$table=''){
        if(empty($this->table) && !empty($table)) $this->table=$table;
        $select = '*';
        $where = '1';
        try {
            if(!empty($cond['select'])) $select = $cond['select'];
            if(!empty($cond['condition']) && is_array($cond['condition'])){
                $where = '';
                $i = 0;
                foreach ($cond['condition'] as $index=>$value){
                    if($i++>0) $where .= ' AND ';
                    $where .= $index.'='.':'.$index;
                }
            }
            $this->query('SELECT '.$select.' FROM '.$this->table.' WHERE '.$where);
            if(!empty($cond['condition']) && is_array($cond['condition'])){
                foreach ($cond['condition'] as $index=>$value){
                    $this->bind(':'.$index, $value);
                }
            }
            return $this->single();
        } catch (PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
            return FALSE;
        }
    }
    public function fetchAll($cond=array()){
        $select = '*';
        $where = '1';
        $order = 'pc_id DESC';
        try {
            if(!empty($cond['select'])) $select = $cond['select'];
            if(!empty($cond['condition']) && is_array($cond['condition'])){
                $where = '';
                $i = 0;
                foreach ($cond['condition'] as $index=>$value){
                    if($i++>0) $where .= ' AND ';
                    $where .= $index.'='.':'.$index;
                }
            }
            
            $this->query('SELECT '.$select.' FROM '.$this->table.' WHERE '.$where.' ORDER BY '.$order);
            if(!empty($cond['condition']) && is_array($cond['condition'])){
                foreach ($cond['condition'] as $index=>$value){
                    $this->bind(':'.$index, $value);
                }
            }
            return $this->resultset();
        } catch (PDOException $e) {
            return "Error!: " . $e->getMessage() . "<br/>";
        }
    }
    public function isExists($cond){
        $r = $this->fetch(array('condition'=>$cond));
        if($r) return true;
        else return false;
    }

    public function insert($data, $table=''){
        if(empty($data) || !is_array($data)) return false;
        if(empty($this->table) && !empty($table)) $this->table=$table;
        $columns = '';
        $columnbinds = '';
        $i=0;
        try {
            foreach($data as $index=>$value){
                if($i++>0){
                    $columns .=', ';
                    $columnbinds .=', ';
                }
                $columns .= $index;
                $columnbinds .= ':'.$index;
            }
            $this->query('INSERT INTO '.$this->table.' ('.$columns.') VALUES ('.$columnbinds.')');
            foreach($data as $index=>$value){
                $this->bind(':'.$index, $value);
            }
            $this->execute();
            return $this->lastInsertId();
        } catch (PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
            return false;
        }
    }
    public function update(){
        
    }
    public function delete(){
        
    }
    public function debugQuery(){
        $r = $this->debugDumpParams();
        var_dump($r);
    }
    public function __destruct() {
        parent::__destruct();
    }
}
/**
 * Database Driver
 * By:
 * Md. Ahsan Habib
 * Email: ahsan@codejit.com
 * Copyright@ Codejit Solutions (codejit.com)
 */