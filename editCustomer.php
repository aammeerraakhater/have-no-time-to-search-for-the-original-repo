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
                    <?php
                    if (isset($_GET['customerID'])) {
                        $customerID = $_GET['customerID'];
                        $customers = getBased('customer', 'customerID', $customerID, "customerID");
                        $customer = $customers->fetch_assoc();
                        $dbcity = $customer['city'];
                        array_push($cities, $dbcity);
                        $cities = array_unique($cities);

                    ?>

                        <div class="container">
                            <main>
                                <div class="py-5 text-center">
                                    <h2> تعديل بيانات <?php echo $customer['usrName']; ?></h2>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-lg">
                                        <h4 class="mb-3">أضافه عميل</h4>
                                        <form class="needs-validation" novalidate action="procedures.php" method="POST">
                                            <div class="row g-3">
                                                <div class="col-sm-6">
                                                    <label for="name" class="form-label">الاسم </label>
                                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $customer['usrName']; ?>" required>
                                                    <div class="invalid-feedback">
                                                        يرجى إدخال اسم صحيح.
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="phone" class="form-label">رقم الهاتف</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $customer['phone']; ?>" required>
                                                    <div class="invalid-feedback">
                                                        يرجى إدخال رقم هاتف.
                                                    </div>
                                                </div>

                                                <div class="hidden col-sm-6">
                                                    <input type="text" class="form-control" id="customerID" name="customerID" value="<?php echo $customer['customerID']; ?>">
                                                </div>


                                                <div class="col-sm-6">
                                                    <label for="city" class="form-label">المنطقة</label>
                                                    <select class="form-select" id="city" name="city" required onchange="addAlternitave(this.value, 'allCityAll', 'altCity', 'city')">
                                                        <option value="" selected disabled>اختر...</option>
                                                        <?php foreach ($cities as $city) { ?>
                                                            <option <?php if ($customer['city'] == $city) {
                                                                        echo 'selected';
                                                                    } ?> value="<?php echo $city; ?>"> <?php echo $city; ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        يرجى إدخال المنطقة
                                                    </div>
                                                </div>
                                                <div class="hidden col-sm-6" id="allCityAll">
                                                    <label for="altCity" class="form-label">المنطقة</label>
                                                    <input type="text" class="form-control" id="altCity" name="">
                                                    <div class="invalid-feedback">
                                                        يرجى إدخال المنطقة
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="delegate" class="form-label">المندوب</label>
                                                    <select class="form-select" id="delegate" name="delegate">
                                                        <option value="" disabled>اختر...</option>
                                                        <?php foreach ($delegants as $delegate) { ?>
                                                            <option <?php if ($customer['delegate'] == $delegate) {
                                                                        echo 'selected';
                                                                    } ?> value="<?php echo $delegate["wName"]; ?>"> <?php echo $delegate["wName"]; ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        يرجى اختيار المندوب
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label for="address" class="form-label">عنوان </label>
                                                    <input name="address" type="text" class="form-control" id="address" value="<?php echo $customer['address']; ?>" required>
                                                    <div class="invalid-feedback">
                                                        يرجى إدخال العنوان
                                                    </div>
                                                </div>



                                            </div>

                                            <button class="w-45 btn btn-primary btn-lg my-3" name="editCustomer" type="submit">تعديل</button>
                                        </form>
                                    </div>
                                </div>

                            </main>
                        </div>

                </div>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
<?php } else { ?>
    <div class="py-3  text-center">
        <h2>برجاء اختيار عميل لادخال امر العمل </h2>
        <a class="btn btn-sm btn-outline-secondary" href="./allCustomers.php" role="button"> الرجوع لصفحه العملاء </a>

    </div>

<?php   } ?>
<?php include "includes/footer.php";
    ob_end_flush();
} else {
    header("Refresh:0;url=login.php");
}
