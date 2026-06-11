<?php
session_start();
include_once('main.php');

class DeceasedController extends MainController{

    public function view_Deceased_Data(){

        $sql = "SELECT d.deceased_photo, d.title, d.full_name AS deceased_name, d.nic, d.gender, doc.date_of_death, fs.service_type, d.religion
                FROM funeral_service_table fs
                JOIN deceased_table d ON fs.deceased_table_deceased_id = d.deceased_id
                JOIN document_table doc ON fs.document_table_document_set_id = doc.document_id
                ORDER BY fs.booking_created_at DESC";

        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {

            while($rec = $result->fetch_assoc()) {

                echo "<tr>";
                echo "<td>" . "<img src='../uploads/default_user_image.png' class='rounded-circle' width='55' height='55'>" . "</td>"; // Placeholder for photo
                echo "<td>" . $rec['title'] . " " . $rec['deceased_name'] . "</td>";
                echo "<td>" . $rec['nic'] . "</td>";
                echo "<td>" . $rec['gender'] . "</td>";
                echo "<td>" . $rec['date_of_death'] . "</td>";
                echo "<td>" . $rec['service_type'] . "</td>";
                echo "<td>" . $rec['religion'] . "</td>";

                echo "<td>" . "Pending" . "</td>"; // Placeholder for status

                echo "<td>
                        <button class='btn btn-sm btn-outline-primary'>
                            <i class='fa-solid fa-eye'></i>
                        </button>

                        <button class='btn btn-sm btn-outline-warning'>
                            <i class='fa-solid fa-pen'></i>
                        </button>

                        <button class='btn btn-sm btn-outline-danger'>
                            <i class='fa-solid fa-trash'></i>
                        </button>
                      </td>";
                echo "</tr>";
            }

        } else {
            echo "<tr><td colspan='8' class='text-center'>No deceased records found.</td></tr>";
        }
        
    }
}

?>