getclientdata();
function getclientdata() {
    //  document.getElementById("content-table").style.zoom = "70%";
    var search = document.getElementById("tableSearch").value;
    var page = document.getElementById("currentPage").value;
    var fd = new FormData();
    fd.append("search", search);
    fd.append("page", page);
    $.ajax({
        url: "services/clientProfileListService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("resultResponseBody").innerHTML = result;
            getclientdataPagination();
        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}


function setPage(page) {
    document.getElementById("currentPage").value = page;
    getclientdata();

}


function getclientdataPagination() {

    var search = document.getElementById("tableSearch").value;
    var page = document.getElementById("currentPage").value;
    var fd = new FormData();
    fd.append("search", search);
    fd.append("page", page);
    $.ajax({
        url: "services/clientProfileListPaginationService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            // $('#sortableTable').DataTable().destroy();
            // $('#sortableTable').find('tbody').append(result);
            // $('#sortableTable').DataTable().draw();
            document.getElementById("pagination").innerHTML = result;

        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}