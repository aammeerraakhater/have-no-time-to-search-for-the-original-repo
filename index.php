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
      $date = date('Y-m') . '-%';
      ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
              </span>
              الداش بورد
            </h3>
          </div>
          <?php if (isset($_SESSION['workerID']) && (($_SESSION['workerLevel']) == 1 || ($_SESSION['isAdmin']) == 1 || $_SESSION['workerLevel'] == 2)) { ?>
            <div class="row">

              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                      مبيعات الشهر
                      <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <?php
                    if ($_SESSION['isAdmin'] == 1) {
                      $sumresult =  getSum($table = 'workreq', $countElement = 'paid', $condition = 'operatedDate', $monthlyDate = $date)->fetch_array();
                    } else {
                      $sumresult =  getSumbased2($table = 'workreq', $countElement = 'paid', $condition = 'operatedDate', $monthlyDate = $date, 'delegate', $_SESSION['wName'])->fetch_array();
                    } ?>
                    <h2 class="mb-5"><?php echo $sumresult[0]; ?><i class=" mdi mdi-cash-usd "></i></h2>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                      عدد اوامر العمل في الشهر
                      <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <?php
                    if ($_SESSION['isAdmin'] == 1) {
                      $countresult =  getCount($table = 'workreq', $countElement = 'id', $condition = 'reqDate', $date)->fetch_array();
                    } else {
                      $countresult =  getCountbased2($table = 'workreq', $countElement = 'id', $condition = 'reqDate', $date, 'delegate', $_SESSION['wName'])->fetch_array();
                    } ?>


                    <h2 class="mb-5"><?php echo $countresult[0]; ?></h2>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                      عدد العملاء
                      <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <?php $countresult =  getCountAll('customer', 'customerID')->fetch_array(); ?>
                    <h2 class="mb-5"><?php echo $countresult[0]; ?></h2>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
          <div class="row">
            <?php $results = getBased("workreq", "serviceStatus", "عمل اليوم", "id"); ?>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $results->num_rows; ?> أعمال لليوم </h4>
                  <div class="table-responsive">
                    <div class="card-body px-2">
                      <h4 class="card-title">أوامر العمل</h4>
                      </p>
                    <table id="todaysWork" class="table table-bordered table-striped">
                      <?php require_once 'tablecontent.php'?>
                    </table>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <?php $results = getBased("workreq", "serviceStatus", "تأجيل", "id"); ?>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $results->num_rows; ?> أعمال مؤجله </h4>
                  <div class="table-responsive">
                    <div class="card-body px-2">
                      <h4 class="card-title">أوامر العمل</h4>
                      </p>
                      <table id="postponed" class="table table-bordered table-striped">
                        <?php require_once 'tablecontent.php'?>
                      </table>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <h1>المبيعات لشهر <?php echo date('m-Y'); ?> </h1>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> المبيعات للمندوبين</h4>
                  <div class="table-responsive">
                    <table class="table">

                      <thead>
                        <tr>
                          <th>#</th>
                          <th>الاسم</th>
                          <th>عدد اوامر العمل</th>
                          <th>النسبه بالارقام</th>
                          <th>النسبه</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $totalNum = getCountAllBased($table = 'workreq', $countElement = 'id', $condition = 'operatedDate', $date)->fetch_array();
                        $i = 1;
                        foreach ($delegants as $delegant) {  ?>
                          <tr>
                            <td><?= $i; ?></td>
                            <td><?php echo $delegant['wName']; ?></td>
                            <?php $countresult = getCountbasedLike($table = 'workreq', $countElement = 'id', $condition = 'delegate', $delegant['wName'], 'operatedDate', $date)->fetch_array(); ?>
                            <td><?php echo $countresult[0] ?> </td>
                            <?php try {
                              $totalResult = round(($countresult[0] / $totalNum[0]) * 100, 2);
                            } catch (DivisionByZeroError $e) {
                              $totalResult = 0;
                            } ?>

                            <td><?php echo $totalResult ?>%</td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-<?php echo $colors[$i % 5]; ?>" role="progressbar" style="width: <?php echo $totalResult; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                        <?php
                          $i++;
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">تنفيذ الفنيين</h4>
                  <div class="table-responsive">
                    <table class="table">

                      <thead>
                        <tr>
                          <th>#</th>
                          <th>الاسم</th>
                          <th>عدد اوامر العمل</th>
                          <th>النسبه بالارقام</th>
                          <th>النسبه</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $totalNum = getCountAllBased($table = 'workreq', $countElement = 'id', $condition = 'operatedDate', $date)->fetch_array();
                        $i = 1;
                        foreach ($technicians as $technician) { ?>
                          <tr>
                            <td><?= $i; ?></td>
                            <td><?php echo $technician['wName']; ?></td>
                            <?php $countresult = getCountbasedLike($table = 'workreq', $countElement = 'id', $condition = 'technician', $technician['wName'], 'operatedDate', $date)->fetch_array(); ?>
                            <td><?php echo $countresult[0]  ?></td>
                            <?php try {
                              $totalResult = round(($countresult[0] / $totalNum[0]) * 100, 2);
                            } catch (DivisionByZeroError $e) {
                              $totalResult = 0;
                            } ?>

                            <td><?php echo $totalResult; ?>%</td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-<?php echo $colors[$i % 5]; ?>" role="progressbar" style="width: <?php echo $totalResult; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                        <?php
                          $i++;
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">انواع الخدمه و النسبه </h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>نوع الخدمة</th>
                          <th>العدد</th>
                          <th>النسبه بالارقام</th>
                          <th>النسبه</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        $totalNum = getCountAllBased($table = 'workreq', $countElement = 'id', $condition = 'operatedDate', $date)->fetch_array();
                        foreach ($serviceStatuses as $serviceStatus) { ?>
                          <tr>
                            <td><?= $i; ?></td>
                            <td><?php echo $serviceStatus; ?></td>
                            <?php $countresult = getCountbasedLike($table = 'workreq', $countElement = 'id', $condition = 'serviceStatus',  $serviceStatus, $condition = 'operatedDate', $date)->fetch_array(); ?>
                            <td><?php echo $countresult[0]; ?></td>
                            <?php try {
                              $totalResult = round(($countresult[0] / $totalNum[0]) * 100, 2);
                            } catch (DivisionByZeroError $e) {
                              $totalResult = 0;
                            } ?>
                            <td><?php echo $totalResult; ?></td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-<?php echo $colors[$i % 5]; ?>" role="progressbar" style="width: <?php echo  $totalResult ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                        <?php
                          $i++;
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
<?php include "includes/footer.php";
  ob_end_flush();
} else {
  header("Refresh:0;url=login.php");
}
