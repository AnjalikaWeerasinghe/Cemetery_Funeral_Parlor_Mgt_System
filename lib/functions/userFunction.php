<?php
session_start();
include_once('main.php');
include_once('numbreGneration.php');

class UserController extends MainController{

    public function insert_user($email,$password,$select){
        $numbre = new Numbering();
        $userId = $numbre->generateUniqueNumber("user_id", "user_tbl", "usr");
        $sql = "INSERT INTO user_tbl (user_id,email, pwd, selectnew) VALUES ('$userId','$email', '$password', $select);";
        $result = $this->conn->query($sql);
        if($result > 0){
            echo("success");
        }else{
            echo("error");
        }
        
    }

    public function viewEmpData(){
        $sqlView = "SELECT * FROM user_table ORDER BY id DESC;";
        $resultView = $this->conn->query($sqlView);
        $nor = $resultView->num_rows;
        if($nor > 0){
            while($rec = $resultView->fetch_assoc()){
                echo ("<tr>");
                echo ("<td>".$rec['id']."</td>");
                echo ("<td>".$rec['email']."</td>");
                echo ("<td><button class='btn btn-warning edit' id=".$rec['id'].">Edit</button></td>");
                echo ("<td><button class='btn btn-danger delete' id=".$rec['id'].">Trash</button></td>");
                echo("</tr>");
            }
        }
        else{
            echo "No data found";
        }
    }

    public function searchUser($search){
        $sqlSearch = "SELECT * FROM user_table WHERE email LIKE '%$search%' ORDER BY id DESC;";
        $resultSearch = $this->conn->query($sqlSearch);
        $nor = $resultSearch->num_rows;
        if($nor > 0){
            while($rec = $resultSearch->fetch_assoc()){
                echo ("<tr>");
                echo ("<td>".$rec['user_id']."</td>");
                echo ("<td>".$rec['email']."</td>");
                echo("</tr>");
            }
        }
        else{
            echo "No data found";
        }
    }

    public function deleteUser($id){
        $sqlDel = "UPDATE user_tbl SET user_status = 0 WHERE user_id = '$id';";
        $resultDel = $this->conn->query($sqlDel);
        if($resultDel > 0){
            echo("success");
        } else{
            echo("error");
        }
    }
    //get data to edit user from database using user id
    public function getDatatoEdit($id){
        $sqlEdit = "SELECT * FROM user_tbl WHERE user_id = '$id';";
        $resultEdit = $this->conn->query($sqlEdit);
        $nor = $resultEdit->num_rows;
        if($nor > 0){
            $rec = $resultEdit->fetch_assoc();
            echo json_encode($rec);
        }
        else{
            echo "No data found";
        }
    }

   public function editUser($id,$email){
    $sqlUpdate = "UPDATE user_tbl SET email = '$email' WHERE user_id = '$id';";
    $resultUpdate = $this->conn->query($sqlUpdate);
    if($resultUpdate > 0){
        echo("success");
    } else{
        echo("error");
   }
}
}

?>