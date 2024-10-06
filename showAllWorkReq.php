<?php
ob_start();
session_start();
include "init.php";
include "includes/header.php";
if (isset($_SESSION['workerID'])) {
    if (isset($_GET['city']) && isset($_GET['servicesType'])) {
        $city = $_GET['city'];
        $servicesType = $_GET['servicesType'];
        $results = getDataBasedOnCityServices("workreq", $city, $servicesType);
    } elseif (isset($_GET['serviceStatus'])) {
        $serviceStatus = $_GET['serviceStatus'];
        $results = getDataBasedStatus("workreq", $serviceStatus);
    } elseif (isset($_GET['q'])) {
        $results = getDataBasedMoney("workreq");
    } elseif (isset($_GET['date']) && isset($_GET['serviceStatusDated'])) {
        $date = $_GET['date'];
        $serviceStatus = $_GET['serviceStatus'];
        $results = getDataBasedOn2Elements("workreq", 'operatedDate', $date, 'serviceStatus', $serviceStatus);
    } elseif (isset($_GET['delegantWorkReq'])) {
        $delegant = $_GET['delegantWorkReq'];
        $results = getBased("workreq", "delegate", $delegant, "operatedDate");
    } elseif (isset($_GET['technichanWorkReq'])) {
        $delegant = $_GET['technichanWorkReq'];
        $results = getBased("workreq", "technician", $delegant, "operatedDate");
    } else {
        $results = getAllData("workreq", "id");
    }

?>

    <body>
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
                            <div class="row">
                                <br>
                                <form action="" method="GET">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="date" name="date" value="<?= isset($_GET['date']) == true ? $_GET['date'] : '' ?>" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <select style="width:115px;" class="form-select" name="serviceStatusDated" required>
                                                <option value="" disabled selected>اختر...</option>
                                                <?php foreach ($serviceStatuses as $serviceStatus) { ?>
                                                    <option <?php if (isset($_GET['serviceStatusDated']) && $_GET['serviceStatusDated'] == $serviceStatus) {
                                                                echo 'selected';
                                                            } ?> value="<?php echo $serviceStatus; ?>"> <?php echo $serviceStatus; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">بحث</button>
                                            <a href="showAllWorkReq.php" class="btn btn-danger">مسح</a>
                                        </div>
                                    </div>
                                </form>
                                <br><br>

                            </div>
                            <div class="card-body px-2">
                                <h4 class="card-title">أوامر العمل</h4>
                                </p>
                                <table id="AllWorkReq" class="table table-bordered table-striped">
                                <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">أمر العمل</th>
                            <th scope="col">حالة الخدمة</th>
                            <th scope="col">الاسم</th>
                            <th scope="col">الفني</th>
                            <th scope="col">نوع الخدمه</th>
                            <th scope="col">الموبايل</th>
                            <th scope="col">المدينه</th>
                            <th scope="col">العنوان</th>
                            <th scope="col">الكميه</th>
                            <th scope="col">السعر </th>
                            <th scope="col">المدفوع </th>
                            <th scope="col">الباقي </th>
                            <th scope="col">المندوب</th>
                            <th scope="col">تاريخ الطلب</th>
                            <th scope="col">تاريخ التنفيذ</th>
                            <th scope="col">الملاحظات </th> <!-- 16 -->
                            <th scope="col">Happy call </th> <!-- 17 -->
                            <th scope="col">كتب امر العمل</th> <!-- 17 -->
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                          $i = 1;
                          foreach ($results as $result) {
                            $customers = getBased("customer", "customerID", $result['customerID'], 'customerID');
                            foreach ($customers as $customer) {

                          ?>
                              <tr>
                                <td><?php echo $i;?></td>
                                <td> <?php echo $result['workReqNo']; ?></td>
                                <td>
                                  <select style="width:115px;" class="form-select" id="serviceStatus<?php echo $i; ?>" name="serviceStatus" onchange="changeStatus(serviceStatus<?php echo $i; ?>, <?php echo $result['id']; ?>,this.value)">
                                    <option selected value="" disabled>اختر...</option>
                                    <?php foreach ($serviceStatuses as $serviceStatus) { ?>
                                      <option <?php if ($result['serviceStatus'] == $serviceStatus) {
                                                echo 'selected';
                                              } ?> value="<?php echo $serviceStatus; ?>"> <?php echo $serviceStatus; ?> </option>
                                    <?php } ?>
                                  </select>
                                </td>
                                <td>
                                  <div style="padding:5px;max-width:250px;overflow: auto;">
                                    <a href="./showUsr.php?customerID=<?php echo $customer['customerID']; ?>" aria-disabled="true" class="text-decoration-none"> <?php echo $customer['usrName']; ?></a>
                                  </div>
                                </td>
                                <td> <select style="width:150px;height:fit-content;" class="form-select" id="technician<?php echo $i; ?>" name="technician" onchange="changetechnician(technician<?php echo $i; ?>,<?php echo $result['id']; ?>,this.value)">
                                    <option selected value="" disabled>اختر...</option>
                                    <?php foreach ($technicians as $technician) { ?>
                                      <option <?php if ($result['technician'] == $technician['wName']) {
                                                echo 'selected';
                                              } ?> value="<?php echo $technician['wName']; ?>"> <?php echo $technician['wName']; ?> </option>
                                    <?php } ?>
                                  </select>
                                </td>
                                <td> <?php echo $result['servicesType']; ?></td>
                                <td> <?php echo $customer['phone']; ?></td>
                                <td> <?php echo $result['city']; ?></td>
                                <td>
                                  <div style="padding:5px;max-width:450px;overflow: auto;">
                                    <?php echo $result['address']; ?>
                                  </div>
                                </td>
                                <td> <?php echo $result['Quantity']; ?></td>
                                <td> <?php echo $result['price']; ?></td>
                                <td> <?php echo $result['paid']; ?></td>
                                <td> <?php echo $result['price'] - $result['paid']; ?></td>
                                <td> <?php echo $result['delegate']; ?></td>
                                <td>
                                  <div style="width:100px;"> <?php echo $result['reqDate']; ?> </div>
                                </td>
                                <td>
                                  <div style="width:100px;"> <?php echo $result['operatedDate']; ?> </div>
                                <td>
                                  <div style="padding:5px;max-width:450px;overflow: auto;"><?php echo $result['Notes']; ?></div>
                                </td>
                                <td>
                                  <div style="padding:5px;max-width:450px;overflow: auto;"><?php echo $result['happyCall']; ?></div>
                                </td>
                                <td> <?php echo $result['editedBy']; ?></td>

                              </tr>
                          <?php
                              $i++;
                            }
                          } ?>
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
    <?php include 'includes/footer.php';
    ob_end_flush();
} else {
    header("Refresh:0;url=login.php");
}
