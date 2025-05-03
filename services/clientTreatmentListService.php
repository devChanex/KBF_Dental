<?php
require_once('databaseService.php');
$service = new ServiceClass();

$search = urldecode($_POST['search']);
$searchParam = '%' . $search . '%';
$page = isset($_POST['page']) ? (int) $_POST['page'] : 1;
$itemPerPage = isset($_POST['item']) ? (int) $_POST['item'] : 15;
$result = $service->processTreatment($searchParam, $page, $itemPerPage);

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
    public function processTreatment($search, $page, $itemPerPage)
    {

        $offset = ($page - 1) * $itemPerPage;  // Calculate the offset for pagination
        $searchFields = ['a.nickname', 'a.sex', 'a.mobilenumber', "CONCAT(a.lname, ', ', a.fname, ' ', a.mdname)", 'a.homeAddress', 'a.guardianName', 'refferedBy'];
        $dynamics = '';

        if (!empty($search)) {
            $orConditions = [];
            foreach ($searchFields as $field) {
                $orConditions[] = "$field LIKE :search";
            }
            $dynamics = 'WHERE (' . implode(' OR ', $orConditions) . ')';
        }

        $dynamics .= '  LIMIT :limit OFFSET :offset';


        $query = "select a.*,(select b.date from treatmentsoa b where b.clientid=a.clientid order by date desc limit 1) as 'latest' from clientProfile a $dynamics";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':search', $search);
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
                <td>' . $row["birthDate"] . '</td>
                <td>' . $row["mobileNumber"] . '</td>
                <td>' . $row["homeAddress"] . '</td>
                <td>' . $row["guardianName"] . '</td>
                <td>' . $row["latest"] . '</td>
               
                <td>';



                echo '
                <a href="addTreatmentHistory.php?clientid=' . $row["clientid"] . '&birthDate=' . $row["birthDate"] . '&clientname=' . $fullname . '&age=' . $age . '&address=' . $row["homeAddress"] . '"
                 class="btn btn-warning btn-circle" title="Add Treatment History - SOA"><i class="fas fa-plus"></i></a>
                <a class="btn btn-success btn-circle" href="soaList.php?clientid=' . $row["clientid"] . '&name=' . $fullname . '" title="View SOA"><i class="fas fa-eye"></i></a>
                
                
                </td>
            </tr>';
            }
        }
    }
}
