<?php
ob_start();
session_start();

// if (isset($_SESSION['workerID'])) {
$title = " لوحة تحكم الخاطر ";
include "init.php";
include "includes/header.php";
if (isset($_SESSION['workerID'])) {
?>

    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include 'nav.php' ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php
            include 'sideNav.php';
            ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="table-responsive card p-2 m-2">
                        <div class="card-body px-2">
                            <div class="d-flex flex-row-reverse">
                                <div class=""><a href="addCustomer.php" class="btn btn-primary">اضافه عميل</a></div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <h4 class="card-title"> العملاء</h4>
                                </div>
                            </div>


                            </p>
                            <table id="customersTable" class="table table-bordered table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">الاسم</th>
                                        <th scope="col">المندوب</th>
                                        <th scope="col">المدينه</th>
                                        <th scope="col">العنوان</th>
                                        <th scope="col">الموبايل</th>
                                        <th scope="col">تعديل</th>
                                        <th scope="col">اضافه امر عمل</th>
                                    </tr>
                                </thead>
                            </table>

                        </div>
                    </div>


                </div>
                <!-- content-wrapper ends -->
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    
     <?php
        $source = "srvr_customers.php";
        if (isset($_GET['city']) &&isset($_GET['servicesType'])) {
            $city = $_GET['city'];
            $servicesType = $_GET['servicesType'];
            if($city == 'بنها'&& $servicesType=='تكييف'){
                $source = "srvr_customers_b_c.php";
            }
            elseif($city == 'بنها'&& $servicesType=='فلتر'){
                $source = "srvr_customers_b_f.php";
            }
            elseif($city == 'طوخ'&& $servicesType=='تكييف'){
                $source = "srvr_customers_t_c.php";
            }
            elseif($city == 'طوخ'&& $servicesType=='فلتر'){
                $source = "srvr_customers_t_f.php";
            }
    } 
     $script = '<script>
     jQuery(document).ready(function($) {
         $("#customersTable").DataTable( {
             "processing": true,
             "serverSide": true,
             "ajax": "scripts/'.$source.'"
         } );
     } );
     </script>';

    include 'includes/footer.php';
} else {
    header("Refresh:0;url=login.php");
}

// include 'includes/footer.php';
// ob_end_flush();                             