<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KBFDentalCare</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include_once('bars/sidebar.php'); ?>


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?php include_once('bars/topbar.php'); ?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="card shadow mb-12">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Client Medical History -   <?php echo ucwords($_GET['clientname']); ?> </h6>
                        </div>
                        <div class="card-body" id="bodyResult" style="padding-right:20%;padding-left:20%">

                            <input type="text" value="<?php echo $_GET['clientid']; ?>" id="clientId" hidden>
                            <!-- USE THIS SPACE FOR YOUR ADDITIONAL CODE SNIPPET -->   
                            <label for="q1">Are you in Good Health?</label>
                            <select id="q1" name="q1" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO">NO </option></select>

                            <label for="q2">Are you under any medical treatment right now? If so, what is the condition treated?(Specify)</label>
                                            <input type="Text" name="q2" id="q2" value="NO" class="form-control">

                            <label for="q3">Have you ever had any serious illness or undergone any surgical procedure?</label>
                            <select id="q3" name="q3" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO" selected >NO </option></select>
                            <label for="q4">Have you ever been hospitalized in the past 5 years? If yes, please specify.</label>
                                            <input type="Text" name="q4" id="q4" value="NO" class="form-control">                
                            <label for="q5">Are you taking prescription / Non-prescription drug? If yes, please specify.</label>
                                            <input type="Text" name="q5" id="q5" value="NO" class="form-control"> <br />
                            <label for="ql" >Are You Allergic to any of the following?</label> <br />
                            <label for="q6">Local anesthetics</label>
                            <select id="q6" name="q6" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO" selected>NO </option></select>
                            <label for="q7">Pain Killer</label>
                            <select id="q7" name="q7" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO" selected>NO </option></select>
                            <label for="q8">Penicillin / Antibiotics</label>
                            <select id="q8" name="q8" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO" selected>NO </option></select>
                            <label for="q9">Aspirin</label>
                            <select id="q9" name="q9" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO" selected>NO </option></select>
                            <label for="q10">Others:(Specify)</label>
                                            <input type="Text" name="q10" id="q10" value="NONE" class="form-control"> <br />

                                            <label for="ql2" >Do you have/ have you ever had any of the following?</label> <br />
                            <label for="q11">Highblood</label>
                            <select id="q11" name="q11" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO" selected>NO </option></select>
                            <label for="q12">Lowblood</label>
                            <select id="q12" name="q12" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO" selected>NO </option></select>
                            <label for="q13">Rheumatism</label>
                            <select id="q13" name="q13" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO" selected>NO </option></select>
                            <label for="q14">Cancer</label>
                            <select id="q14" name="q14" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO" selected>NO </option></select>
                            <label for="q15">Radiation</label>
                            <select id="q15" name="q15" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO" selected>NO </option></select>
                            <label for="q16">Epilepsy</label>
                            <select id="q16" name="q16" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO" selected>NO </option></select>
                            <label for="q17">Blood Disease</label>
                            <select id="q17" name="q17" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO" selected>NO </option></select>
                            <label for="q18">Heart Disease</label>
                            <select id="q18" name="q18" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO" selected>NO </option></select>
                            <label for="q19">Tuberculosis</label>
                            <select id="q19" name="q19" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO" selected>NO </option></select>
                            <label for="q20">Kidney Disease</label>
                            <select id="q20" name="q20" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO" selected>NO </option></select>
                            <label for="q21">Diabetes</label>
                            <select id="q21" name="q21" size="1" class="form-control">
                                            <option value="YES">YES </option>
                                            <option value="NO" selected>NO </option></select>
                            <label for="q22">Others:(Specify)</label>
                                            <input type="Text" name="q22" id="q22" value="NONE" class="form-control"> 
                                            <div id="formResult"></div>
                                            <button class="btn btn-success" onclick="addMedHistoryProfile()">Submit</button>
                                            

                            <!-- END OF YOUR ADDITIONAL CODE SNIPPET -->   
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include_once('bars/footer.php'); ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="controllers/logOutConroller.js"></script>
    <script src="controllers/sessionController.js"></script>
    <script src="controllers/medHistoryRegController.js"></script>

    

</body>

</html>