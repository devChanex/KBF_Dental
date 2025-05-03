<?php



echo '
 <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="basecode.php">
                <div class="sidebar-brand-text mx-3">KBFDentalCare System</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="basecode.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span></a>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="ticketList.php">
                        <i class="fas fa-file"></i>
                    <span>Tickets</span></a>
            </li>
           
         <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                    aria-controls="collapseTwo">
                    <i class="fas fa-address-card"></i>
                    <span>Client Profile</span>
                    </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="clientProfileList.php">View List</a>
				<a class="collapse-item" href="registerClient.php">Register Client</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#clientTreatment" aria-expanded="false"
                aria-controls="config">
                <i class="fas fa-tooth"></i>
                <span>Client Treatment</span>
                </a>
            <div id="clientTreatment" class="collapse" aria-labelledby="clientTreatment"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="clientTreatmentList.php">Client Treatment List</a>
                    <a class="collapse-item" href="allSoaList.php">SOA List</a>
                  
                </div>
            </div>

  


        <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#appointment" aria-expanded="false"
            aria-controls="appointment">
            <i class="fas fa-calendar"></i>
            <span>Client Appointment</span>
            </a>
        <div id="appointment" class="collapse" aria-labelledby="config"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="pendingAppointmentList.php">Appointment List</a>
                
            </div>
        </div>
    </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#report" aria-expanded="false"
                    aria-controls="config">
                    <i class="fas fa-file"></i>
                    <span>Reports</span>
                    </a>
                <div id="report" class="collapse" aria-labelledby="report"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="soadaterange.php">SOA Summary per Date</a>
                    <a class="collapse-item" href="soaperclient.php">SOA Summary per Client</a>
                    <a class="collapse-item" href="clienttreatmentrecordperdate.php">CT Records per Date</a>
                    <a class="collapse-item" href="clienttreatmentrecordperclient.php">CT Records per Client</a>
                    <a class="collapse-item" href="clienttreatmentrecordpertreatment.php">CT Records per Treatment</a>
                    </div>
                </div>
            </li>
    
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#config" aria-expanded="false"
                    aria-controls="config">
                    <i class="fas fa-cog"></i>
                    <span>Configurations</span>
                    </a>
                <div id="config" class="collapse" aria-labelledby="config"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="treatmentList.php">Treatment List</a>
                        <a class="collapse-item" href="calendar.php">Clinic Calendar</a>
                    </div>
                </div>
            </li>

        </ul>
        <!-- End of Sidebar -->

';
