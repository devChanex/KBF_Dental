<?php
require_once('databaseService.php');
$service = new ServiceClass();

$search = urldecode($_POST['search']);
$searchParam = '%' . $search . '%';
$page = isset($_POST['page']) ? (int) $_POST['page'] : 1;
$itemPerPage = isset($_POST['item']) ? (int) $_POST['item'] : 15;
$result = $service->process($searchParam, $page, $itemPerPage);

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
    public function process($search, $page, $itemPerPage)
    {

        $offset = ($page - 1) * $itemPerPage;  // Calculate the offset for pagination
        $searchFields = ['nickname', 'sex', 'mobilenumber', "CONCAT(lname, ', ', fname, ' ', mdname)", 'homeAddress', 'guardianName', 'refferedBy'];
        $dynamics = '';

        if (!empty($search)) {
            $orConditions = [];
            foreach ($searchFields as $field) {
                $orConditions[] = "$field LIKE :search";
            }
            $dynamics = 'WHERE (' . implode(' OR ', $orConditions) . ')';
        }

        $dynamics .= '  LIMIT :limit OFFSET :offset';

        $query = "select * from clientProfile $dynamics";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $itemPerPage, PDO::PARAM_INT);  // Ensure itemPerPage is treated as an integer
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);  // Ensure offset is treated as an integer
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $fullname = $row["lname"] . ', ' . $row["fname"] . ' ' . $row["mdname"];
                $birthDate = new DateTime($row['birthDate']);
                $today = new DateTime();
                $age = $birthDate->diff($today)->y;
                echo '
<tr>
                <td>' . $row["clientid"] . '</td>
                <td>' . $fullname . '</td>
                <td>' . $row["nickname"] . '</td>
                <td>' . $age . '</td>
                <td>' . $row["sex"] . '</td>
                <td>' . $row["occupation"] . '</td>
                <td>' . $row["birthDate"] . '</td>
                <td>' . $row["mobileNumber"] . '</td>
                <td>' . $row["homeAddress"] . '</td>
                <td>' . $row["guardianName"] . '</td>
                <td>' . $row["gOccupation"] . '</td>
                <td>' . $row["refferedBy"] . '</td>
               
                <td>';

                //medhistory checker

                $query2 = "select * from medhistory where clientid=:a";
                $stmt2 = $this->conn->prepare($query2);
                $stmt2->bindParam(':a', $row["clientid"]);
                $stmt2->execute();
                if ($stmt2->rowCount() > 0) {

                    echo '
                       <a href="medHistoryView.php?clientid=' . $row["clientid"] . '&clientname=' . $fullname . '" title="View Medical History"  class="btn btn-primary  btn-circle"><i class="fas fa-history"></i></a>
                       ';

                } else {
                    echo ' <a href="medHistory.php?clientid=' . $row["clientid"] . '&clientname=' . $fullname . '" title="Add Medical History" class="btn btn-success btn-circle"><i class="fas fa-history"></i></a>
                    ';

                }

                echo '
                <a href="updateClient.php?clientid=' . $row["clientid"] . '&lname=' . $row["lname"] . '&fname=' . $row["fname"] . '
                &mname=' . $row["mdname"] . '&nick=' . $row["nickname"] . '&age=' . $age . '&sex=' . $row["sex"] . '&occupation=' . $row["occupation"] . '
                &birthDate=' . $row["birthDate"] . '&mobileNumber=' . $row["mobileNumber"] . '&homeAddress=' . $row["homeAddress"] . '
                &guardianName=' . $row["guardianName"] . '&gOccupation=' . $row["gOccupation"] . '&refferedBy=' . $row["refferedBy"] . '
                " class="btn btn-warning btn-circle" title="Update Client Profile"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-danger btn-circle" onclick="deleteClient(\'' . $row["clientid"] . '\')" title="Delete Client Profile"><i class="fas fa-trash"></i></a>
                
                
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
                <td>-</td>
                <td>-</td>
            </tr>




';

        }
    }

}







?>