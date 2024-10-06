<?php
ob_start();
session_start();
include 'includes/header.php';
include 'init.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST["password"]);
    $hashpass = sha1($password);
    $table = 'workers';
    checkUser($table, $email, $hashpass);
}

?>

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-6 mx-auto">
                    <?php if (isset($_SESSION['msg'])) { ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['msg']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    <?php } ?>

                    <div class="auth-form-light text-left px-5">
                        <div class="brand-logo">
                            <img style="width: 130px; height:130px; margin:0; padding:0;" src="./assets/images/logo-alkhater.png">
                        </div>
                        <h3>تسجيل الدخول</h3>
                        <p class="font-weight-light">برجاء سجل الدخول</p>
                        <form class="pt-1" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
                            <div class="form-group">
                                <input required name="email" type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                            </div>
                            <div clas="form-group my-2">
                                <label class="m-2" for="exampleInputEmail1">الباسورد</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="r2PasswordNewUser" size="40" maxlength="40" class="form-control" required autofocus />
                                    <span class="input-group-text">
                                        <span data-target="#r2PasswordNewUser" class="pw-toggle2 material-icons"><i class=" mdi mdi-blur "></i></span>

                                    </span>
                                </div>
                            </div>
<br><br>
                            <!-- <div class="form-group">
                                <input required name="password" type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                            </div> -->
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">تسجبل الدخول</button>
                            </div>
                            <br><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<?php include 'includes/footer.php';
ob_end_flush();
?>