                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow text-white" style="background-color: #303991;">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline small">
                                    <?php
                                        if (isset($_SESSION['fullname'])) {
                                            echo $_SESSION['fullname'];
                                        }else{
                                            echo "Guest User";
                                        }
                                    ?>
                                </span>
                                <?php
                                    if (isset($_SESSION['profile']) && $_SESSION['profile']!="") {
                                        $profile_pic = $_SESSION['profile'];
                                    }else{
                                        $profile_pic = "prmsu_cande.png";
                                    }
                                ?>
                                <img class="img-profile rounded-circle"
                                    src="../img/profiles/<?php echo $profile_pic; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="">
                                    <?php
                                        if (isset($_SESSION['fullname'])) {
                                            echo $_SESSION['fullname'];
                                        }else{
                                            echo "Guest User";
                                        }
                                    ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" id="resetPassBtn" href="#" data-user-id="<?php echo $_SESSION['user_id']; ?>">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Update Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->