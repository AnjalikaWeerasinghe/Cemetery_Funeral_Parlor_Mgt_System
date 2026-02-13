<?php
include_once('main.php');

class Numbering extends MainController{
    public function generateUniqueNumber($colName, $tableName, $prefix) {
        $sql = "SELECT $colName FROM $tableName ORDER BY $colName DESC LIMIT 1;";
        $result = $this->conn->query($sql);
        $nor = $result->num_rows;
        if($nor > 0){
            $rec = $result->fetch_assoc();
            $lastInsertedId = $rec[$colName];
            $lastCode = substr($lastInsertedId, -5);
            $lastCode++;
            $newCode = $prefix.str_pad($lastCode, 5, '0', STR_PAD_LEFT);
            return $newCode;

        }
        else{
           $newCode = $prefix.'00001'; 
           return $newCode;
        }
    }
}

?>