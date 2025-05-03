function updatePatientPersonalInfo(){
 
    var lastName=document.getElementById("lastName").value;
    var firstName=document.getElementById("firstName").value;
    var middleName=document.getElementById("middleName").value;
    var nickName=document.getElementById("nickName").value;
    var age=document.getElementById("age").value; //age
    var e = document.getElementById("gender");
    var gender = e.value;
    var birthday=document.getElementById("birthday").value;
    var occupation=document.getElementById("occupation").value;
    var homeAddress=document.getElementById("homeAddress").value;
    var contactNumber=document.getElementById("contactNumber").value;
    var guardianName=document.getElementById("guardianName").value;
    var guardianOccupation=document.getElementById("guardianOccupation").value;
    var referredBy=document.getElementById("referredBy").value;
    var clientId=document.getElementById("clientid").value;
    
    document.getElementById("formResult").innerHTML = "";
    if (lastName == "") {
        document.getElementById("formResult").innerHTML = "Last Name is required";
    }
    else if (firstName == "") {
        document.getElementById("formResult").innerHTML = "First Name is required";
    }
    else if (nickName == "") {
        document.getElementById("formResult").innerHTML = "Nickname is required";
    }
    else if (age <=1) {
        document.getElementById("formResult").innerHTML = "Please review Birth date";
    }
    else if (birthday == null) {
        document.getElementById("formResult").innerHTML = "Birthday is required";
    }
    else if (occupation == "") {
        document.getElementById("formResult").innerHTML = "Occupation is required";
    }
    else if (homeAddress == "") {
        document.getElementById("formResult").innerHTML = "Home Address is required";
    }
    else if (contactNumber == "") {
        document.getElementById("formResult").innerHTML = "Contact Number is required";
    }
    else if(age<18){
        if (guardianName == "") {
            document.getElementById("formResult").innerHTML = "Guardian Name is required";
        }
        else if (guardianOccupation == "") {
            document.getElementById("formResult").innerHTML = "Guardian Occupation is required";
        }else{
            var confirmation = confirm("Are you sure you want to update this client profile?");
            if(confirmation){
            submitform(clientId,lastName,firstName,middleName,nickName,gender,age,birthday,occupation,homeAddress,contactNumber,guardianName,guardianOccupation,referredBy);
            }
        }
        
    }
    else{
        var confirmation = confirm("Are you sure you want to update this client profile?");
        if(confirmation){
        submitform(clientId,lastName,firstName,middleName,nickName,gender,age,birthday,occupation,homeAddress,contactNumber,guardianName,guardianOccupation,referredBy);
        }   
    
    }


   
   


}

function computeAge(){

    var birthday = document.getElementById("birthday").value;  
    var dob = new Date(birthday); 
 
    if(birthday==null || birthday=='') {  
       document.getElementById("message").innerHTML = "**Choose a date please!";    
       return false;   
     } else {  
       
     //calculate month difference from current date in time  
     var month_diff = Date.now() - dob.getTime();  
       
     //convert the calculated difference in date format  
     var age_dt = new Date(month_diff);   
       
     //extract year from date      
     var year = age_dt.getUTCFullYear();  
       
     //now calculate the age of the user  
     var age = Math.abs(year - 1970);  
       
     //display the calculated age  
    document.getElementById("age").value=age;           
             }  
}
function submitform(clientId,lastName,firstName,middleName,nickName,gender,age,birthday,occupation,homeAddress,contactNumber,guardianName,guardianOccupation,referredBy){
    var fd = new FormData();
    fd.append('clientId',clientId);
    fd.append('lastName', lastName);
    fd.append('firstName', firstName);
    fd.append('middleName', middleName);
    fd.append('nickName', nickName);
    fd.append('gender', gender);
    fd.append('age', age);
    fd.append('birthday', birthday);
    fd.append('occupation', occupation);
    fd.append('homeAddress', homeAddress);
    fd.append('contactNumber', contactNumber);
    fd.append('guardianName', guardianName);
    fd.append('guardianOccupation', guardianOccupation);
    fd.append('referredBy', referredBy);
    
    $.ajax({
        url: "services/clientProfileUpdateService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result=result.trim();
            if (result == "success") {
                document.getElementById("bodyResult").innerHTML ="<div class='row'><div class='col-lg-12' align='center'><a href='#' class='btn btn-success btn-circle btn-lg'><i class='fas fa-check'></i></a><br><br><h3>CLIENT PROFILE SUCCESSFULLY UPDATED</h3><button class='btn btn-primary' onclick='reloadPage();'>ADD NEW RECORD</button></div></div>";
             }else {
                document.getElementById("formResult").innerHTML = result;
            }
        }
    });
}
function reloadPage(){
location.reload();
}
