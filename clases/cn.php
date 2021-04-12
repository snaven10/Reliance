<?php
class cn {
    public $pdo;
    public function __Construct(){
        try{
        $this->pdo = new PDO('mysql:host=localhost;dbname=heavy_parts_nuevo', 'snaven','SNAVEN10');
        $this->pdo->exec('SET CHARACTER SET utf8');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }catch(PDOException $e){
            echo 'Error!: '.$e->getMessage();
            die();
        }
    }
}
