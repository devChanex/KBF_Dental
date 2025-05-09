<?php
//Service for Registration

require_once('databaseService.php');
$lastName = urldecode($_POST['lastName']);
$firstName = urldecode($_POST['firstName']);
$middleName = urldecode($_POST['middleName']);
$nickName = urldecode($_POST['nickName']);
$gender = urldecode($_POST['gender']);
$age = urldecode($_POST['age']);
$birthday = urldecode($_POST['birthday']);
$homeAddress = urldecode($_POST['homeAddress']);
$occupation = urldecode($_POST['occupation']);
$contactNumber = urldecode($_POST['contactNumber']);
$guardianName = urldecode($_POST['guardianName']);
$guardianOccupation = urldecode($_POST['guardianOccupation']);
$referredBy = urldecode($_POST['referredBy']);
//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->addPatientProfile($lastName,$firstName,$middleName,$nickName,$age,$gender,$birthday,$homeAddress,$occupation,$contactNumber,$guardianName,$guardianOccupation,$referredBy);
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
	public function addPatientProfile($lastName,$firstName,$middleName,$nickName,$age,$gender,$birthday,$homeAddress,$occupation,$contactNumber,$guardianName,$guardianOccupation,$referredBy)
	{
		//:a,:b parameter
		try{

		$query = "Insert into clientProfile (lname,fname,mdname,nickname,age,sex,occupation,birthDate,mobileNumber,homeAddress,guardianName,gOccupation,refferedBy) values (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m)";
		//$query = "Insert into clientProfile (lname,fname,mdname,nickname,age,sex,occupation,mobileNumber,homeAddress,guardianName,gOccupation,refferedBy) values (:a,:b,:c,:d,:e,:f,:g,:i,:j,:k,:l,:m)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':a', $lastName);
		$stmt->bindParam(':b', $firstName);
		$stmt->bindParam(':c', $middleName);
		$stmt->bindParam(':d', $nickName);
		$stmt->bindParam(':e', $age);
		$stmt->bindParam(':f', $gender);
		$stmt->bindParam(':g', $occupation);
		$stmt->bindParam(':h', $birthday);
		$stmt->bindParam(':i', $contactNumber);
		$stmt->bindParam(':j', $homeAddress);
		$stmt->bindParam(':k', $guardianName);
		$stmt->bindParam(':l', $guardianOccupation);
		$stmt->bindParam(':m', $referredBy);
		$stmt->execute();
		return "success";
		}catch(Exception $e){
		return "Error:".$e->getMessage();
		}



	}
	//UNTIL THIS CODE

}
//UNTIL HERE COPY



?>