<?php
ob_start();
session_start();

// if (isset($_SESSION['workerID'])) {
$title = " لوحة تحكم الخاطر ";
include "init.php";
include "includes/header.php";
if (isset($_SESSION['workerID'])) {

    $results = getAllData("customer", "customerID");

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
                                        <th scope="col">#</th>
                                        <th scope="col">الاسم</th>
                                        <th scope="col">المندوب</th>
                                        <th scope="col">المدينه</th>
                                        <th scope="col">العنوان</th>
                                        <th scope="col">الموبايل</th>
                                        <th scope="col">تعديل</th>
                                        <th scope="col">اضافه امر عمل</th>
                                        <th scope="col">اضافه طلب شراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $i = 1;
                                    foreach ($results as $customer) {

                                    ?>

                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td>
                                                <a href="./showUsr.php?customerID=<?php echo $customer['customerID']; ?>" aria-disabled="true" class="text-decoration-none"> <?php echo $customer['usrName']; ?></a>
                                            </td>
                                            <td> <?php echo $customer['delegate']; ?></td>
                                            <td> <?php echo $customer['city']; ?></td>
                                            <td>
                                                <div style="padding:5px;max-width:450px;overflow: auto;"> <?php echo $customer['address']; ?></div>
                                            </td>
                                            <td> <?php echo $customer['phone']; ?></td>
                                            <td> <a href="./editCustomer.php?customerID=<?php echo $customer['customerID']; ?>" class="btn  btn-outline-info " tabindex="-1" role="button" aria-disabled="true">تعديل </a></td>
                                            <td> <a href="./addWorkReq.php?customerID=<?php echo $customer['customerID']; ?>" class="btn  btn-outline-success " tabindex="-1" role="button" aria-disabled="true">اضافه </a></td>
                                            <td><a href="./addOrder.php?customerID=<?php echo $customer['customerID']; ?>&id=<?php echo $result['id']; ?>" class="btn  btn-outline-danger " tabindex="-1" role="button" aria-disabled="true">اضافه </a></td>

                                        <?php
                                        $i++;
                                    } ?>
                                        </tr>
                                </tbody>
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
    <?php #} 
    ?>
<?php include 'includes/footer.php';
    ob_end_flush();
} else {
    header("Refresh:0;url=login.php");
}
