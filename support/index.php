<!DOCTYPE html>
<html>
<head>
<title>KBFDentalCare - Support</title>
<!-- *Note: You must have internet connection on your laptop or pc other wise below code is not working -->
<!-- CSS for full calender -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
<!-- JS for jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- JS for full calender -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
<!-- bootstrap css and js -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-lg-12">


			  <!-- Begin Page Content -->
			  <div class="container-fluid " id="content-table" style="padding-left:10%;padding-right:10%;">
				
				<div class="card shadow mb-12">
					<div class="card-header py-6">
					   <strong>KBFDentalCare Support</strong>
					  
					</div>
					<div class="card-body  bg-white" id="formAction" align="center">
					<?php
//Service for Registration

require_once('databaseService.php');

$action = $_GET["action"];
$ref = $_GET["ref"];
$refname = $_GET["refname"];
$ticketid = $_GET["ticketid"];
$table = $_GET["tablename"];
$column = $_GET["column"];
$currentvalue = urldecode($_GET["currentvalue"]);
$newvalue = urldecode($_GET["newvalue"]);
$service = new ServiceClass();
$result = $service->processTicket($action,$ticketid,$table,$column,$currentvalue,$newvalue,$refname,$ref);
//USE THIS AS YOUR BASIS
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
	public function processTicket($action,$ticketid,$table,$column,$currentvalue,$newvalue,$refname,$ref)
	{
	    //checkstatus
	    $status="Pending";
	    $date =date("Y-m-d h:i:sa");
        $query = "select status from tickets where ticketid=:a";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $ticketid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $status=$row["status"];
            }
        }
        
        if($status=="Pending"){
            
            if($action==2){
                $status="Declined";
                $query = "update tickets set status=:b,dateupdated=:c where ticketid=:a";
                $stmt = $this->conn->prepare($query);
                 $stmt->bindParam(':a', $ticketid);
                $stmt->bindParam(':b', $status);
                $stmt->bindParam(':c', $date);
                 $stmt->execute();
                 echo"Ticket #".$ticketid." has been declined";
            }else{
                $query = "update ".$table." set ".$column."=:b where ".$refname."=:a and ".$column."=:c";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':a', $ref);
                $stmt->bindParam(':b', $newvalue);
                $stmt->bindParam(':c', $currentvalue);
                $stmt->execute();
                
                $status="Processed";
                $query = "update tickets set status=:b,dateupdated=:c where ticketid=:a";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':a', $ticketid);
                $stmt->bindParam(':b', $status);
                $stmt->bindParam(':c', $date);
                $stmt->execute();
                echo"Ticket #".$ticketid." has been approved";
                
            }
            
            
        }else{
            echo"Ticket #".$ticketid." is already processed.";
        }
	    
	    
	   


	}
	//UNTIL THIS CODE

}
//UNTIL HERE COPY



?>
					
					
						
						
					</div>
				</div>
				<!-- Page Heading -->
				

			</div>
			
			<!-- /.container-fluid -->
		</div>
	</div>
</div>


<br>

</body>
</html> 