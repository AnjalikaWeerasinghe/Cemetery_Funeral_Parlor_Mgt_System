<?php
include_once('main.php');

class Numbering extends MainController{

    public function generateUniqueNumber($colName, $tableName, $prefix) {
        
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $colName) || 
            !preg_match('/^[a-zA-Z0-9_]+$/', $tableName)) {
            throw new Exception("Invalid table or column name.");
        }

        $sql = "SELECT $colName FROM $tableName WHERE $colName LIKE '{$prefix}%' ORDER BY $colName DESC LIMIT 1;";

        $result = $this->conn->query($sql);
        
        if($result && $result->num_rows > 0){
            $rec = $result->fetch_assoc();
            $lastInsertedId = $rec[$colName];

            $numberPart = str_replace($prefix, '', $lastInsertedId);
            $newCode = (int)$numberPart + 1;

            // $lastCode = substr($lastInsertedId, -5);
            // $lastCode++;

            return $prefix.str_pad($newCode, 5, '0', STR_PAD_LEFT);

        }
        else{
           return $prefix.'00001'; 
        }
    }
}

?>