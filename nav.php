<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php"><span style="color:#198ae3; font:bolder;">
                <div class="brand-logo">
                    <img style="width: 50ox; height:50px; margin:0; padding:0;" src="./assets/images/logo-alkhater.png">
                </div>
            </span></a>
        <a class="navbar-brand brand-logo-mini" href="index.php"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <div class="d-flex flex-row-reverse">

                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <i class="mdi mdi-account-circle"></i>
                        </div>

                        <div class="nav-profile-text">
                            <p class="mb-1 text-black"><?php echo $_SESSION['wName'] ?></p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="./logOut.php">
                            <i class="mdi mdi-logout me-2 text-primary"></i> Signout
                        </a>
                    </div>
                </li>
                <li class="nav-item d-none d-lg-block full-screen-link">
                    <a class="nav-link">
                        <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                    </a>
                </li>
            </div>
        </ul>



        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>