<?php
//Service for Registration

require_once('databaseService.php');

$clientId = urldecode($_POST['clientId']);
//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->loadMedHistory($clientId);
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
	public function loadMedHistory($clientId)
	{
		//:a,:b parameter
		try{
            $query = "select * from medhistory where clientId=:clientid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':clientid', $clientId);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo'
                    <label for="q1">Are you in Good HealthSSs?</label>
                    <select id="q1" name="q1" size="1" class="form-control">
                    ';

                    if($row['q1'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                                   
                    echo'
                    <label for="q2">Are you under any medical treatment right now? If so, what is the condition treated?(Specify)</label>
                                    <input type="Text" name="q2" id="q2" value="'.$row["q2"].'" class="form-control">

                    <label for="q3">Have you ever had any serious illness or undergone any surgical procedure?</label>
                    <select id="q3" name="q3" size="1" class="form-control">
                    ';

                    if($row['q3'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                                   
                    echo'
                    <label for="q4">Have you ever been hospitalized in the past 5 years? If yes, please specify.</label>
                                    <input type="Text" name="q4" id="q4" value="'.$row["q4"].'" class="form-control">                
                    <label for="q5">Are you taking prescription / Non-prescription drug? If yes, please specify.</label>
                                    <input type="Text" name="q5" id="q5" value="'.$row["q5"].'" class="form-control"> <br />
                    <label for="ql" >Are You Allergic to any of the following?</label> <br />
                    <label for="q6">Local anesthetics</label>
                    <select id="q6" name="q6" size="1" class="form-control">
                    ';

                    if($row['q6'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                                   
                    echo'
                    <label for="q7">Pain Killer</label>
                    <select id="q7" name="q7" size="1" class="form-control">
                    ';

                    if($row['q7'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                                   
                    echo'
                    <label for="q8">Penicillin / Antibiotics</label>
                    <select id="q8" name="q8" size="1" class="form-control">
                    ';

                    if($row['q8'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                                   
                    echo'
                    <label for="q9">Aspirin</label>
                    <select id="q9" name="q9" size="1" class="form-control">
                    ';

                    if($row['q9'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                                   
                    echo'
                    <label for="q10">Others:(Specify)</label>
                                    <input type="Text" name="q10" id="q10" value="'.$row["q10"].'" class="form-control"> <br />

                                    <label for="ql2" >Do you have/ have you ever had any of the following?</label> <br />
                    <label for="q11">Highblood</label>
                    <select id="q11" name="q11" size="1" class="form-control">
                    ';

                    if($row['q11'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                    echo'
                    <label for="q12">Lowblood</label>
                    <select id="q12" name="q12" size="1" class="form-control">
                    ';

                    if($row['q12'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                    echo'
                    <label for="q13">Rheumatism</label>
                    <select id="q13" name="q13" size="1" class="form-control">
                    ';

                    if($row['q13'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                    echo'
                    <label for="q14">Cancer</label>
                    <select id="q14" name="q14" size="1" class="form-control">
                    ';

                    if($row['q14'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                    echo'
                    <label for="q15">Radiation</label>
                    <select id="q15" name="q15" size="1" class="form-control">
                    ';

                    if($row['q15'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                    echo'
                    <label for="q16">Epilepsy</label>
                    <select id="q16" name="q16" size="1" class="form-control">
                    ';

                    if($row['q16'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                    echo'
                    <label for="q17">Blood Disease</label>
                    <select id="q17" name="q17" size="1" class="form-control">
                    ';

                    if($row['q17'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                    echo'
                    <label for="q18">Heart Disease</label>
                    <select id="q18" name="q18" size="1" class="form-control">
                    ';

                    if($row['q18'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                    echo'
                    <label for="q19">Tuberculosis</label>
                    <select id="q19" name="q19" size="1" class="form-control">
                    ';

                    if($row['q19'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                    echo'
                    <label for="q20">Kidney Disease</label>
                    <select id="q20" name="q20" size="1" class="form-control">
                    ';

                    if($row['q20'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                    echo'
                    <label for="q21">Diabetes</label>
                    <select id="q21" name="q21" size="1" class="form-control">
                    ';

                    if($row['q21'] =="NO"){
                            echo'
                            <option value="NO">NO</option>
                            <option value="YES">YES</option></select>
                           ';

                    }else{
                            echo'
                            <option value="YES">YES</option>
                            <option value="NO">NO</option></select>
                            ';

                    }
                    echo'
                    <label for="q22">Others:(Specify)</label>
                                    <input type="Text" name="q22" id="q22" value="'.$row["q22"].'" class="form-control"> 
                                    <div id="formResult"></div>
                                    <button class="btn btn-success" onclick="updateMedHistoryProfile()">Update</button>
                    ';
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