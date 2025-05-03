<?php
require_once('databaseService.php');
$service = new ServiceClass();
$clientid = urldecode($_POST['clientid']);
$result = $service->loadClientSoa($clientid);

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
    public function loadClientSoa($clientid)
    {



        $query = "select * from treatmentsoa where clientid=:a";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $clientid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '
                <tr>
                <td>' . $row["date"] . '</td>
         
                <td>' . $row["time"] . '</td>
                <td>' . $row["dentist"] . '</td>
                <td>' . $row["total"] . '</td>
                <td style="text-align:center;">';
                echo '<a class="btn btn-success btn-circle" href="soaViewing.php?soaid=' . $row["soaid"] . '" title="View SOA"><i class="fas fa-eye"></i></a>
               </td>
            </tr>';
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
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>




';
        }
    }
}
