function addMedHistoryProfile(){
    var clientId=document.getElementById("clientId").value;
  console.log(clientId);
    var e = document.getElementById("q1");
    var q1 = e.value;
   
    var q2=document.getElementById("q2").value;
    var e = document.getElementById("q3");
    var q3 = e.value;
   var q4=document.getElementById("q4").value;
   var q5=document.getElementById("q5").value;

   var e = document.getElementById("q6");
   var q6 = e.value;
   var e = document.getElementById("q7");
   var q7 = e.value;
   var e = document.getElementById("q8");
   var q8 = e.value;
   var e = document.getElementById("q9");
   var q9 = e.value;
    var q10=document.getElementById("q10").value;

    var e = document.getElementById("q11");
   var q11 = e.value;
   var e = document.getElementById("q12");
   var q12 = e.value;
   var e = document.getElementById("q13");
   var q13 = e.value;
   var e = document.getElementById("q14");
   var q14 = e.value;
   var e = document.getElementById("q15");
   var q15 = e.value;
   var e = document.getElementById("q16");
   var q16 = e.value;
   var e = document.getElementById("q17");
   var q17 = e.value;
   var e = document.getElementById("q18");
   var q18 = e.value;
   var e = document.getElementById("q19");
   var q19 = e.value;
   var e = document.getElementById("q20");
   var q20 = e.value;
   var e = document.getElementById("q21");
   var q21 = e.value;
   var q22=document.getElementById("q22").value;
  
 
   submitform(clientId,q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,q11,q12,q13,q14,q15,q16,q17,q18,q19,q20,q21,q22);


   
}
function submitform(clientId,q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,q11,q12,q13,q14,q15,q16,q17,q18,q19,q20,q21,q22){
    var fd = new FormData();
    
    
    fd.append('clientId', clientId);
    fd.append('q1', q1);
    fd.append('q2', q2);
    fd.append('q3', q3);
    fd.append('q4', q4);
    fd.append('q5', q5);
    fd.append('q6', q6);
    fd.append('q7', q7);
    fd.append('q8', q8);
    fd.append('q9', q9);
    fd.append('q10', q10);
    fd.append('q11', q11);
    fd.append('q12', q12);
    fd.append('q13', q13);
    fd.append('q14', q14);
    fd.append('q15', q15);
    fd.append('q16', q16);
    fd.append('q17', q17);
    fd.append('q18', q18);
    fd.append('q19', q19);
    fd.append('q20', q20);
    fd.append('q21', q21);
    fd.append('q22', q22);
    
    $.ajax({
        url: "services/medHistoryRegService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result=result.trim();
            if (result == "success") {
                console.log("ok");
                document.getElementById("bodyResult").innerHTML ="<div class='row'><div class='col-lg-12' align='center'><a href='medHistory.php' class='btn btn-success btn-circle btn-lg'><i class='fas fa-check'></i></a><br><br><h3>CLIENT HISTORY PROFILE SUCCESSFULLY REGISTERED</h3><button class='btn btn-primary' onclick='reloadPage();'>Back to View Clients</button></div></div>";
             }else {
                console.log("not ok");
                document.getElementById("formResult").innerHTML = result;
            }
        }
    });
}
function reloadPage(){

window.location.href="clientProfileList.php";
}
