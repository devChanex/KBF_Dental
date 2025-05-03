<?php
require_once('databaseService.php');
$service = new ServiceClass();
$result = $service->loadTicketList();

class ServiceClass
{

    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    //DO NOT INCLUDE THIS CODE
    public function loadTicketList()
    {


$dateToday=date("Y-m-d");
   
        $query = "SELECT * FROM tickets";

        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             
                echo '
                <tr>
                <td>' . $row["ticketid"] . '</td>
                <td>' . $row["ref"] . '</td>
                <td>' . $row["columnname"] . '</td>
                <td>' . $row["curval"] . '</td>
                <td>' . $row["newval"] . '</td>
                 <td>' . $row["status"] . '</td>
                  <td>' . $row["daterequested"] . '</td>
                   <td>' . $row["dateupdated"] . '</td>';




                
                
            }
        } else {
            echo '
<tr>
<td>-</td>

                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                
            </tr>




';
        }
    }
}
