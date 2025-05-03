getclientdata();
function getclientdata() {
    var clientid = document.getElementById("clientid").value;
    var fd = new FormData();
    fd.append("clientid", clientid);
    $.ajax({
        url: "services/clientSoaListService.php",
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
