<?php
ob_start();
session_start();
include 'includes/header.php';
include 'init.php';
if (isset($_SESSION['workerID'])) {
    include 'nav.php'; ?>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php
            include 'sideNav.php';
            if (isset($_GET['customerID'])) {
                $customerID = $_GET['customerID'];
                $customers = getBased('customer', 'customerID', $customerID, 'customerID');
                $customer = $customers->fetch_assoc();
                $dbcity = $customer['city'];
                array_push($cities, $dbcity);
                $cities = array_unique($cities);
            }

            ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="content-wrapper">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title align-self-center">اضافه أمر عمل</h4>
                                    <form class="needs-validation" novalidate action="procedures.php" method="POST">
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <label for="name" class="form-label">الاسم </label>
                                                <input type="text" class="form-control" id="name" name="name" disabled value="<?php echo $customer['usrName']; ?>">
                                                <div class="invalid-feedback">
                                                    يرجى إدخال اسم صحيح.
                                                </div>
                                            </div>



                                            <div class="col-sm-6">
                                                <label for="workId" class="form-label">رقم امر العمل </label>
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control" id="workId" name="workId" required>
                                                    <div class="invalid-feedback">
                                                        رقم العمل الخاص بالعميل
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden">
                                                <?php $customerID = $_GET['customerID'] ?>
                                                <input type="text" class="form-control" id="id" name="customerID" value="<?php echo $customerID; ?>">
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="city" class="form-label">المنطقة</label>
                                                <select class="form-select" id="city" name="city" required onchange="addAlternitave(this.value, 'allCityAlt', 'altCity', 'city')">
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
                                            <div class="hidden col-sm-6" id="allCityAlt">
                                                <label for="altCity" class="form-label">المنطقة</label>
                                                <input type="text" class="form-control" id="altCity" name="">
                                                <div class="invalid-feedback">
                                                    يرجى إدخال المنطقة
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-sm-12">
                                                <label for="address" class="form-label">عنوان </label>
                                                <input name="address" type="text" class="form-control" id="address" value="<?php echo $customer['address']; ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="serviceStatus" class="form-label">نوع الخدمة</label>
                                                <select class="form-select" id="serviceStatus" name="serviceStatus">
                                                    <option selected value="" disabled>اختر...</option>
                                                    <?php foreach ($serviceStatuses as $serviceStatus) { ?>
                                                        <option value="<?php echo $serviceStatus; ?>"> <?php echo $serviceStatus; ?> </option>
                                                    <?php } ?>
                                                </select>


                                            </div>

                                            <div class="col-sm-6">
                                                <label for="technician" class="form-label">الفني</label>
                                                <select class="form-select" id="technician" name="technician">
                                                    <option value="">اختر...</option>
                                                    <?php foreach ($technicians as $technician) { ?>
                                                        <option value="<?php echo $technician['wName'] ?>"><?php echo $technician['wName'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    يرجى اختيار اسم الفني
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="delegate" class="form-label">المندوب</label>
                                                <select class="form-select" id="delegate" name="delegate" onchange="addAlternitave(this.value, 'allDelegatealt', 'altDelegate', 'delegate')">
                                                    <option value="" selected disabled>اختر...</option>
                                                    <?php foreach ($delegants as $delegant) { ?>
                                                        <option value="<?php echo $delegant['wName'] ?>"><?php echo $delegant['wName'] ?></option>
                                                    <?php } ?>
                                                    <option value="أخرى">أخرى</option>

                                                </select>
                                                <div class="invalid-feedback">
                                                    يرجى اختيار المندوب
                                                </div>
                                            </div>
                                            <div class="hidden col-sm-6" id="allDelegatealt">
                                                <label for="altDelegate" class="form-label">المندوب </label>
                                                <input type="text" class="form-control" id="altDelegate" name="">
                                                <div class="invalid-feedback">
                                                    يرجى إدخال المندوب
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="orderType" class="form-label"> نوع الصنف</label>
                                                <select class="form-select" id="orderType" name="orderType" onchange="addAlternitave(this.value, 'allOrdersTypealt', 'altOrdersType', 'orderType')">
                                                    <option value="">اختر...</option>
                                                    <?php foreach ($orderTypes as $orderType) { ?>
                                                        <option value="<?php echo $orderType ?>"><?php echo $orderType ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    نوع الصنف .
                                                </div>
                                            </div>

                                            <div class="hidden col-sm-6" id="allOrdersTypealt">
                                                <label for="altOrdersType" class="form-label">نوع الصنف</label>
                                                <input type="text" class="form-control" id="altOrdersType" name="">
                                                <div class="invalid-feedback">
                                                    يرجى إدخال نوع الصنف
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="servicesType" class="form-label"> نوع الخدمة</label>
                                                <select class="form-select" id="servicesType" name="servicesType" onchange="addAlternitave(this.value, 'allServicesTypealt', 'altServicesType', 'servicesType')">
                                                    <option value="">اختر...</option>
                                                    <?php foreach ($serviceTypes as $serviceType) { ?>
                                                        <option value="<?php echo $serviceType ?>"><?php echo $serviceType ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    نوع الخدمة .
                                                </div>
                                            </div>
                                            <div class="hidden col-sm-6" id="allServicesTypealt">
                                                <label for="altServicesType" class="form-label">نوع الخدمة</label>
                                                <input type="text" class="form-control" id="altServicesType" name="">
                                                <div class="invalid-feedback">
                                                    يرجى إدخال نوع الخدمة
                                                </div>
                                            </div>


                                        </div>

                                        <hr class="my-4">

                                        <div class="row gy-3">
                                            <div class="hidden">
                                                <input type="text" class="form-control" name="editedBy" value="<?php echo $_SESSION['wName']; ?>">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="quantity" class="form-label">الكمية</label>
                                                <input type="text" class="form-control" id="quantity" name="quantity">
                                                <div class="invalid-feedback">
                                                    الكمية
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="price" class="form-label">المبلغ</label>
                                                <input type="text" class="form-control" id="price" name="price">
                                                <div class="invalid-feedback">
                                                    المبلغ
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="paid" class="form-label">المدفوع</label>
                                                <input type="text" class="form-control" id="paid" name="paid" placeholder="">
                                                <div class="invalid-feedback">
                                                    المدفوع
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="my-4">
                                        <div class="col-12">
                                            <label for="notes" class="form-label">ملاحظات</label>
                                            <input name="notes" type="text" class="form-control" id="notes">
                                        </div>
                                        <hr class="my-4">

                                        <button class="w-100 btn btn-primary btn-lg" name="submitWorkReq" type="submit">حفظ</button>
                                        <hr class="my-4">

                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>

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
