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


        $dateToday = date("Y-m-d");
        $offset = ($page - 1) * $itemPerPage;  // Calculate the offset for pagination
        $searchFields = ['dentist', 'treatment', "CONCAT(lname, ', ', fname, ' ', mdname)", 'date'];
        $dynamics = '';

        if (!empty($search)) {
            $orConditions = [];
            foreach ($searchFields as $field) {
                $orConditions[] = "$field LIKE :search";
            }
            $dynamics = 'WHERE (' . implode(' OR ', $orConditions) . ')';
        }

        $dynamics .= '  LIMIT :limit OFFSET :offset';

        $query = "SELECT tsoa.soaid, cp.clientid, cp.lname, cp.fname, cp.mdname, tsoa.dentist, tsub.treatment, tsub.price, tsoa.date FROM clientProfile cp INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid $dynamics";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $itemPerPage, PDO::PARAM_INT);  // Ensure itemPerPage is treated as an integer
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);  // Ensure offset is treated as an integer
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $fullname = $row["lname"] . ', ' . $row["fname"] . ' ' . $row["mdname"];
                echo '
                <tr>
                <td>' . $row["soaid"] . '</td>

                <td>' . $fullname . '</td>
                <td>' . $row["dentist"] . '</td>
                <td>' . $row["treatment"] . '</td>
                <td>' . $row["price"] . '</td>
                <td>' . $row["date"] . '</td>
                <td>';



                echo '
                
                <a class="btn btn-success btn-circle" href="soaViewing.php?soaid=' . $row["soaid"] . '&name=' . $fullname . '" title="View SOA"><i class="fas fa-eye"></i></a>
              
                
                
                </td>
            </tr>';
            }
        }
    }
}
