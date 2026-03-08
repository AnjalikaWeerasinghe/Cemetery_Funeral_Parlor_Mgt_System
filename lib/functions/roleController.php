<?php 
session_start();
include_once('main.php');

class RoleController extends MainController{

    public function insert_role($data){
        $query = "INSERT INTO roles (name, description, permission) VALUES (?, ?, ?)";

        $result = $this->conn->prepare($query);

        $result->bind_param("sss", 
            $data['name'], $data['description'], $data['permission']
        );

        if ($result->execute()) {
            return "success";
        } else {
            return "error";
        }

        $sql->close();
    }

    public function view_Role_Data() {

    $sqlView = "SELECT * FROM roles ORDER BY role_id DESC;";
    $resultView = $this->conn->query($sqlView);

        if($resultView && $resultView->num_rows > 0){

            while($rec = $resultView->fetch_assoc()){

                echo "<tr>";
                echo "<td>".$rec['name']."</td>";
                echo "<td>".$rec['description']."</td>";
                echo "<td>".$rec['permission']."</td>";

                echo "<td class=\"align-items-center\">
                        <button class='btn btn-warning btn-sm edit' id='".$rec['role_id']."'>
                                <i class=\"fa-solid fa-file-pen\"></i>
                        </button>
                        <button class='btn btn-danger btn-sm delete' id='".$rec['role_id']."'>
                                <i class=\"fa-solid fa-trash\"></i>
                        </button>
                    </td>";

                echo "</tr>";
            }

        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        
    }
}


?>