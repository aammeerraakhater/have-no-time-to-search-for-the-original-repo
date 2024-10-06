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
                    <div class="card-body">
                        <h4 class="card-title align-self-center">اضافه عامل</h4>
                        <form class="needs-validation" novalidate action="procedures.php" method="POST">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="name" class="form-label">الاسم </label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    <div class="invalid-feedback">
                                        يرجى إدخال اسم صحيح.
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="phone" class="form-label">رقم الهاتف</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                    <div class="invalid-feedback">
                                        يرجى إدخال رقم هاتف.
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="workerType" class="form-label">المندوب</label>
                                    <select class="form-select" id="workerType" name="workerType" required onchange="viewWorkerThings(this.value, 'showEmail','showPassword','email', 'password')">
                                        <option value="" selected disabled>اختر...</option>
                                        <option value="1">مبيعات</option>
                                        <option value="2">محاسب</option>
                                        <option value="3">فني</option>
                                        <option value="4">تشغيل</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        يرجى اختيار المندوب
                                    </div>
                                </div>

                                <div id="showEmail" class="hidden col-sm-6">
                                    <label for="email" class="form-label">الايميل </label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback">
                                        يرجى إدخال الايميل صحيح.
                                    </div>
                                </div>
                                <div id="showPassword" class="hidden col-sm-6">
                                    <label for="password" class="form-label">الباسورد </label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <div class="invalid-feedback">
                                        يرجى إدخال باسورد صحيح.
                                    </div>
                                </div>

                            </div>
                            <br>
                            <button class="btn btn-gradient-danger btn-fw mx-2" name="submitWorker" type="submit">حفظ</button>

                        </form>

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
?>