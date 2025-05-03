<?php
//Service for Registration

require_once('databaseService.php');
$dentist = urldecode($_POST['dentist']);
$date = urldecode($_POST['date']);
$time = urldecode($_POST['time']);
$clientid = urldecode($_POST['clientid']);
$total = urldecode($_POST['total']);
$service = new ServiceClass();
$result = $service->submitEsoa($dentist,$date,$time,$clientid,$total);
echo $result;
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
	public function submitEsoa($dentist,$date,$time,$clientid,$total)
	{
		try{
		$query = "Insert into treatmentsoa(date,time,clientid,dentist,total) values (:a,:b,:c,:d,:e)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':a', $date);
		$stmt->bindParam(':b', $time);
		$stmt->bindParam(':c', $clientid);
		$stmt->bindParam(':d', $dentist);
		$stmt->bindParam(':e', $total);
		$stmt->execute();
		
        session_start();
        
        $query = "SELECT status FROM notifconfig where name='sum-milestone-montly'";
		        $stmt = $this->conn->prepare($query);
		        $stmt->execute();
	        	if ($stmt->rowCount() > 0) {
		        	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$_SESSION["summonth"]=$row["status"];
			    
		        	    
		  }
	    }
	    $query = "SELECT status FROM notifconfig where name='max-milestone-montly'";
		        $stmt = $this->conn->prepare($query);
		        $stmt->execute();
	        	if ($stmt->rowCount() > 0) {
		        	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$_SESSION["maxmonth"]=$row["status"];
			    
		        	    
		  }
	    }
        $month= date("m",strtotime($date));
        $year= date("Y",strtotime($date));
        $totalthismonth=0;
        $query = "select sum(total) as lastsoaid from treatmentsoa where month(date)=:a and year(date)=:b";
		        $stmt = $this->conn->prepare($query);
		        $stmt->bindParam(':a', $month);
		        $stmt->bindParam(':b', $year);
		        $stmt->execute();
	        	if ($stmt->rowCount() > 0) {
		        	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$totalthismonth= $row["lastsoaid"];
			    }
	    }
        if($_SESSION["summonth"] <> $month){
            
            $query = "update notifconfig set status=:a where name='sum-milestone-montly'";
                
		        $stmt = $this->conn->prepare($query);
		        $stmt->bindParam(':a', $month);
		        $stmt->execute();
	        	
	        	 
            $totalprevmonth=0;
           
            if($month>1){
            $prevmonth=$month-1;
          
            
            	$query = "select sum(total) as lastsoaid from treatmentsoa where month(date)=:a and year(date)=:b";
		        $stmt = $this->conn->prepare($query);
		        $stmt->bindParam(':a', $prevmonth);
		        $stmt->bindParam(':b', $year);
		        $stmt->execute();
	        	if ($stmt->rowCount() > 0) {
		        	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$totalprevmonth= $row["lastsoaid"];
			    }
	        	}
			    
	        	
	        
			    
			    if($totalthismonth>$totalprevmonth){
			         $msg="<html>
            <body>
            <p>Dear Admins,</p>
                    <p>Congatulations for new milestone !</p>
            <strong>KBFDentalCare Official System is pleased to notify you that we earned more for ".date('F', mktime(0, 0, 0, $month, 10))." ".$year." compared to the previous month.</strong> As of".date("Y-m-d h:i:sa").", we earned ".$totalthismonth." Please continue to excert efforts for more income.
            </body>
            </html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	    $headers .= 'From: <ServiceBot@kbfdentalcare.com>' . "\r\n";
	    mail($_SESSION["notifemail"],"Congratulations - Milestone Achieved",$msg,$headers);
			    }     
			    
			     
	            
            
        }
	    }
	    
	    if($_SESSION["maxmonth"]<> $month){
	        	$currentmax=0;
	        	$currentmaxMonth=0;
	        	for($x=1; $x<$month; $x++){
	        	     $query = "select sum(total) as lastsoaid from treatmentsoa where month(date)=:a and year(date)=:b";
		                $stmt = $this->conn->prepare($query);
		                $stmt->bindParam(':a', $x);
		                $stmt->bindParam(':b', $year);
		                 $stmt->execute();
	        	        if ($stmt->rowCount() > 0) {
		                	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			                	if($currentmax < $row["lastsoaid"]){
			                	    $currentmax = $row["lastsoaid"];
			                	    $currentmaxMonth=$x;
			                	}
			             }
	        	        }
	        	        
	        	}
	        	
	        	  if($totalthismonth>$currentmax){
			         $msg="<html>
            <body>
            <p>Dear Admins,</p>
                    <p>Congatulations for new milestone !</p>
            <strong>KBFDentalCare Official System is pleased to notify you that we earned more for ".date('F', mktime(0, 0, 0, $month, 10))." ".$year." compared to ".date('F', mktime(0, 0, 0, $currentmaxMonth, 10))." ".$year."</strong> As of ".date("Y-m-d h:i:sa").", we earned ".$totalthismonth." Please continue to excert efforts for more income.
            </body>
            </html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	    $headers .= 'From: <ServiceBot@kbfdentalcare.com>' . "\r\n";
	    mail($_SESSION["notifemail"],"Congratulations - Milestone Achieved",$msg,$headers);
	    
	    $query = "update notifconfig set status=:a where name='max-milestone-montly'";
		        $stmt = $this->conn->prepare($query);
		        $stmt->bindParam(':a', $month);
		        $stmt->execute();
			    }  
			
			    
	    }
           
            
            
        
       
		
		
            
        




		$query = "select max(soaid) as lastsoaid from treatmentsoa";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row["lastsoaid"];
			}
		
		}
		

		

		
		}catch(Exception $e){
		return "Error:".$e->getMessage();
		}



	}
	//UNTIL THIS CODE

}
//UNTIL HERE COPY



?>