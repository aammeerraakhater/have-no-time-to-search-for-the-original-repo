<?php
ob_start();
session_start();
include 'includes/header.php'      ?>
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


                <div class="card-body">
                    <h4 class="card-title align-self-center">اضافه عميل</h4>
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
                                <input type="text" class="form-control" id="phone" name="phone" required>
                                <div class="invalid-feedback">
                                    يرجى إدخال رقم هاتف.
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <label for="city" class="form-label">المنطقة</label>
                                <select class="form-select" id="city" name="city" required onchange="addAlternitave(this.value, 'allCityAll', 'altCity', 'city')">
                                    <option value="" selected disabled>اختر...</option>
                                    <?php foreach ($cities as $city) { ?>
                                        <option value="<?php echo $city ?>"><?php echo $city ?></option>
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
                                <select class="form-select" id="delegate" name="delegate" required>
                                    <option value="" selected disabled>اختر...</option>
                                    <?php foreach ($delegants as $delegant) { ?>
                                        <option value="<?php echo $delegant['wName'] ?>"><?php echo $delegant['wName'] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    يرجى اختيار المندوب
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">عنوان </label>
                                <input name="address" type="text" class="form-control" id="address" placeholder="" required>
                                <div class="invalid-feedback">
                                    يرجى إدخال العنوان
                                </div>

                            </div>

                        </div>
                        <br>
                        <div class="col-sm-12">
                            <input type="checkbox" id="option1" name="customerType" value="تكييف">
                            <label for="option1"> تكييف</label>
                            <input type="checkbox" id="option2" name="customerType1" value="فلاتر">
                            <label for="option2"> فلاتر </label>
                            <input type="checkbox" id="option3" name="customerType2" value="مراتب">
                            <label for="option3"> مراتب </label>
                            <div class="invalid-feedback">
                                يرجى اختيار المندوب
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-gradient-danger btn-fw mx-2" name="submitCustomer" type="submit">حفظ</button>
                        <button class="btn btn-gradient-info btn-fw mx-2" name="submitCustomerWithWorkReq" type="submit">حفظ و اضافه اذن عمل</button>

                    </form>

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
