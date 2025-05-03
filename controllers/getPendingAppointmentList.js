getclientdata();
function getclientdata(){
  //  document.getElementById("content-table").style.zoom = "70%";
    var fd = new FormData();
    $.ajax({
        url: "services/pendingAppointmentListService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            $('#dataTable').DataTable().destroy();
            $('#dataTable').find('tbody').append(result);
            $('#dataTable').DataTable().draw();
            
        }

        
    });
    document.getElementById("content-table").style.zoom = "60%";

    
}
function approve(clientid,email,fname){
    var approveDate = prompt("Please enter Date (YYYY-MM-DD)");
    if (approveDate.length != 10){
        alert("Invalid Date Format");

    }else{
        var fd = new FormData();
        fd.append('clientid', clientid);
        fd.append('date', approveDate);
        $.ajax({
            
            url: "services/pendingApproveDateUpdateService.php",
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (result) {
               sendMail(email,"Appointment Status - Approved","Dear "+ fname,"Hello! This email confirms your upcoming appointment with KBF Dental Care on "+ approveDate +" has been approved. If you need to reschedule, please call us at least 48 hours before the appointment.");
               location.reload();
                
            }
    
            
        });
    }


    
    
    
}


function decline(clientid,email,fname){
    var x = confirm("Do you want to decline this Appointment?");
    if(x){
        var fd = new FormData();
        fd.append('clientid', clientid);
        
        $.ajax({
            
            url: "services/pendingDeclineDateUpdateService.php",
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (result) {
                sendMail(email,"Appointment Status - Declined","Dear "+ fname,"Sorry, this email confirms that your upcoming appointment with KBF Dental Care has been declined. If you need to reschedule an appointment, please call us.");
            
               location.reload();
                
            }
    
            
        });
    }


}
    
    

