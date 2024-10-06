<?php
ob_start();
session_start();
include 'includes/header.php';
include 'init.php';
if (isset($_SESSION['workerID'])) {

?>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php
        include 'nav.php'; ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php
            include 'sideNav.php';
            ?>

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <main class="px-md-4">
                        <?php
                        if (isset($_GET['customerID'])) {
                            $customerID = $_GET['customerID'];
                            $results = getBased("workReq", 'customerID', $customerID, "id");
                            $customers = getBased('customer', 'customerID', $customerID, "customerID");
                            $customer = $customers->fetch_assoc();

                        ?>
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                <h1 class="h2">لوحة القيادة</h1>
                                <div class="btn-toolbar mb-2 mb-md-0">
                                    <a class="btn btn-sm btn-outline-info" href="./addWorkReq.php?customerID=<?php echo $customerID; ?>" role="button"> اضافه أمر عمل</a>
                                </div>
                            </div>


                            <h2> صفحه العميل </h2>
                            <div class="row">
                                <div class="col-md-12 col-lg">
                                    <div class="row g-3">
                                        <div class="col-md-4 col-sm-12">
                                            <label for="name" class="form-label">الاسم </label>
                                            <div class="form-control" id="name" name="name"><?php echo $customer['usrName']; ?></div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label for="phone" class="form-label">التليفون </label>
                                            <div class="form-control" id="phone" name="phone"><?php echo $customer['phone']; ?></div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label for="delegate" class="form-label">المندوب </label>
                                            <div class="form-control" id="delegate" name="delegate"><?php echo $customer['delegate']; ?></div>
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <label for="name" class="form-label">المدينه </label>
                                            <div class="form-control" id="city" name="city"><?php echo $customer['city']; ?></div>
                                        </div>
                                        <div class="col-md-8 col-sm-12">
                                            <label for="name" class="form-label">العنوان </label>
                                            <div class="form-control" id="address" name="address"><?php echo $customer['address']; ?></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <h3>كل اوامر العمل</h3>
                                <table class="table align-middle table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">عرض امر العمل</th>
                                            <th scope="col"> اضافه طلب شراء </th>
                                            <th scope="col">تعديل امر العمل</th>
                                            <th scope="col">حالة الخدمة</th>
                                            <th scope="col">أمر العمل</th>
                                            <th scope="col">التاريخ</th>
                                            <th scope="col">الفني</th>
                                            <th scope="col">المندوب</th>
                                            <th scope="col">المدينه</th>
                                            <th scope="col">العنوان</th>
                                            <th scope="col">نوع الخدمه</th>
                                            <th scope="col">الكميه</th>
                                            <th scope="col">السعر </th>
                                            <th scope="col">المدفوع </th>
                                            <th scope="col">الباقي </th>
                                            <th scope="col">الملاحظات </th> <!-- 16 -->
                                            <th scope="col">Happy call </th> <!-- 16 -->
                                            <th scope="col">اخر تعديل </th> <!-- 16 -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $i = 1;
                                        foreach ($results as $result) {

                                        ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><a href="./showWorkReq.php?customerID=<?php echo $customer['customerID']; ?>&id=<?php echo $result['id']; ?>" class="btn  btn-outline-success " tabindex="-1" role="button" aria-disabled="true">عرض </a></td>
                                                <td><a href="./addOrder.php?customerID=<?php echo $customer['customerID']; ?>&id=<?php echo $result['id']; ?>" class="btn  btn-outline-info " tabindex="-1" role="button" aria-disabled="true">اضافه </a></td>
                                                <td><a href="./editWorkReq.php?customerID=<?php echo $customer['customerID']; ?>&id=<?php echo $result['id']; ?>" class="btn  btn-outline-danger " tabindex="-1" role="button" aria-disabled="true">تعديل </a></td>
                                                <td>
                                                    <select style="width:100px;" class="form-select" id="serviceStatus<?php echo $i; ?>" name="serviceStatus" onchange="changeStatus(serviceStatus<?php echo $i; ?>, <?php echo $result['id']; ?>,this.value)">
                                                        <option selected value="" disabled>اختر...</option>
                                                        <?php foreach ($serviceStatuses as $serviceStatus) { ?>
                                                            <option <?php if ($result['serviceStatus'] == $serviceStatus) {
                                                                        echo 'selected';
                                                                    } ?> value="<?php echo $serviceStatus; ?>"> <?php echo $serviceStatus; ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td> <?php echo $result['workReqNo']; ?></td>
                                                <td> <?php echo $result['reqDate']; ?></td>
                                                <td>
                                                    <select style="width:150px;" class="form-select" id="technician<?php echo $i; ?>" name="technician" onchange="changetechnician(technician<?php echo $i; ?>,<?php echo $result['id']; ?>,this.value)">
                                                        <option selected value="" disabled>اختر...</option>
                                                        <?php foreach ($technicians as $technician) { ?>
                                                            <option <?php if ($result['technician'] == $technician['wName']) {
                                                                        echo 'selected';
                                                                    } ?> value="<?php echo $technician['wName']; ?>"> <?php echo $technician['wName']; ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td><?php echo $result['delegate']; ?></td>
                                                <td> <?php echo $result['city']; ?></td>
                                                <td>
                                                    <div style="padding:5px;max-width:450px;overflow: auto;"> <?php echo $result['address']; ?></div>
                                                </td>
                                                <td> <?php echo $result['servicesType']; ?></td>
                                                <td> <?php echo $result['Quantity']; ?></td>
                                                <td> <?php echo $result['price']; ?></td>
                                                <td> <?php echo $result['paid']; ?></td>
                                                <td> <?php echo $result['price'] - $result['paid']; ?></td>
                                                <td>
                                                    <div style="padding:5px;max-width:450px;overflow: auto;"><?php echo $result['Notes']; ?></div>
                                                </td>
                                                <td>
                                                    <div style="padding:5px;max-width:450px;overflow: auto;"><?php echo $result['happyCall']; ?></div>
                                                </td>
                                                <td><?php echo $result['editedBy']; ?></td>
                                            </tr>
                                        <?php
                                            $i++;
                                        } ?>
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                            <hr class="my-4">
                        <?php } else { ?>
                            <div class="py-5 text-center">
                                <h2>برجاء اختيار عميل لادخال امر العمل </h2>
                                <a class="btn btn-sm btn-outline-secondary" href="./allCustomers.php" role="button"> الرجوع لصفحه العملاء </a>

                            </div>

                        <?php   } ?>
                    </main>

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
