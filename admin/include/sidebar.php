        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion text-white" id="accordionSidebar" style="background-color: #001f54;">

            <li class="text-center">   <!-- Sidebar - Brand -->
                <a class="sidebar-brand align-items-center justify-content-center" href="index.php">
                    <div class="sidebar-brand-icon">
                        <img src="../img/prmsu_cande.png" alt="" style="width: 100px; height: auto;">
                    </div>
                    <div class="">
                        <div class="sidebar-brand-text mt-2">iClinic - PRMSU Candelaria</div>
                    </div>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-1">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Manage Users
            </div>

            <!-- Nav Item - Student Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#studentCollapse"
                    aria-expanded="true" aria-controls="studentCollapse">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Students</span>
                </a>
                <div id="studentCollapse" class="collapse" aria-labelledby=""
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Students</h6>
                        <a class="collapse-item" href="students-pending.php">Pending</a>
                        <a class="collapse-item" href="students-declined.php">Declined</a>
                        <a class="collapse-item" href="students-approved.php">Approved</a>
                        <a class="collapse-item" href="students-archived.php">Archived</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Employee Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#employeeCollapse"
                    aria-expanded="true" aria-controls="employeeCollapse">
                    <i class="fas fa-fw fa-user-group"></i>
                    <span>Employees</span>
                </a>
                <div id="employeeCollapse" class="collapse" aria-labelledby=""
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Employees</h6>
                        <a class="collapse-item" href="">Pending</a>
                        <a class="collapse-item" href="">Approved</a>
                        <a class="collapse-item" href="">Archived</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Admin Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#adminCollapse"
                    aria-expanded="true" aria-controls="adminCollapse">
                    <i class="fas fa-fw fa-user-tie"></i>
                    <span>Admins</span>
                </a>
                <div id="adminCollapse" class="collapse" aria-labelledby=""
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Admins</h6>
                        <a class="collapse-item" href="">Active</a>
                        <a class="collapse-item" href="">Archived</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Manage Appointments
            </div>

            <!-- Nav Item - Admin Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#appointmentCollapse"
                    aria-expanded="true" aria-controls="appointmentCollapse">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Appointments</span>
                </a>
                <div id="appointmentCollapse" class="collapse" aria-labelledby=""
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Appointments</h6>
                        <a class="collapse-item" href=""><i class="fa-regular fa-square mr-2"></i>Pending</a>
                        <a class="collapse-item" href=""><i class="fa-regular fa-square-check mr-2"></i>Approved</a>
                        <a class="collapse-item" href=""><i class="fa-solid fa-square mr-2"></i>Completed</a>
                        <a class="collapse-item" href=""><i class="fa-solid fa-square-xmark mr-2"></i>Declined</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->