<?php
ob_start();
session_start();
include 'includes/header.php';
if (isset($_SESSION['workerID'])) {
?>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->

        <?php include 'init.php';
        include 'nav.php' ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php
            include 'sideNav.php';
            ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
<?php include 'includes/footer.php';
    ob_end_flush();
} else {
    header("Refresh:0;url=login.php");
}
