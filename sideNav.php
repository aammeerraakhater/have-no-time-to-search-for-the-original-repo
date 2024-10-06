<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge mx-2"></i>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2"><?php echo $_SESSION['wName'] ?></span>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="mdi mdi-home menu-icon  menu-icon mx-2"></i>
                <span class="menu-title">الداش بورد</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-client" aria-expanded="false" aria-controls="ui-basic-client">
                <i class=" mdi mdi-account-switch  menu-icon mx-2"></i>
                <span class="menu-title">العملاء</span>
                <i class="menu-arrow"></i>

            </a>
            <div class="collapse" id="ui-basic-client">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="showAllCustomers.php"> كل عملاء </a></li>
                    <li class=" nav-item"> <a class="nav-link" href="showAllCustomers.php?city=بنها&servicesType=تكييف">عملاء بنها - تكييف</a></li>
                    <li class="nav-item"> <a class="nav-link" href="showAllCustomers.php?city=بنها&servicesType=فلتر">عملاء بنها - فلتر </a></li>
                    <li class="nav-item"> <a class="nav-link" href="showAllCustomers.php?city=طوخ&servicesType=تكييف">عملاء طوخ - تكييف</a></li>
                    <li class="nav-item"> <a class="nav-link" href="showAllCustomers.php?city=طوخ&servicesType=فلتر">عملاء طوخ - فلتر</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-work-req" aria-expanded="false" aria-controls="ui-basic-work-req">
                <i class="mdi mdi-account-card-details menu-icon mx-2"></i>
                <span class="menu-title">أوامر العمل</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic-work-req">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="showAllWorkReq.php">كل اوامر العمل</a></li>
                    <li class="nav-item"> <a class="nav-link" href="showAllWorkReq.php?serviceStatus=شكوى">شكوي</a></li>
                    <li class="nav-item"> <a class="nav-link" href="showAllWorkReq.php?serviceStatus=تأجيل">تأجل</a></li>
                    <li class="nav-item"> <a class="nav-link" href="showAllWorkReq.php?serviceStatus=تم">تمت</a></li>
                    <li class="nav-item"> <a class="nav-link" href="showAllWorkReq.php?serviceStatus=استكمال">استكمال</a></li>
                    <li class="nav-item"> <a class="nav-link" href="showAllWorkReq.php?serviceStatus=مطلوب">مطلوب</a></li>
                    <li class="nav-item"> <a class="nav-link" href="showAllWorkReq.php?serviceStatus=بالورشة">بالورشة</a></li>
                    <li class="nav-item"> <a class="nav-link" href="showAllWorkReq.php?q=unpaid">عملاء عليهم مديونية</a></li>
                </ul>
            </div>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-order" aria-expanded="false" aria-controls="ui-basic-order">
                <i class="mdi mdi-crosshairs-gps menu-icon mx-2"></i>
                <span class="menu-title">طلبات</span>
                <i class="menu-arrow"></i>

            </a>
            <div class="collapse" id="ui-basic-order">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="./showAllOrders.php?q=تسعير">
                            طلبات - تسعير</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./showAllOrders.php?q=طلب">
                            طلبات - طلب</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./showAllOrders.php?q=تم"> طلبات - تم</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./showAllOrders.php?q=الغاء">
                            طلبات - الغاء</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./showAllOrders.php?q=تواصل مع العميل">طلبات - تواصل مع العميل</a>
                    </li>
                </ul>
            </div>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="./showAllCustomers.php">
                <i class="mdi mdi-account-multiple-plus  menu-icon mx-2"></i>
                <span class="menu-title">اضافة عميل / أمر عمل</span>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-delicate" aria-expanded="false" aria-controls="ui-basic-delicate">
                <i class="mdi mdi-clipboard-account menu-icon mx-2"></i>
                <span class="menu-title">المندوب</span>
                <i class="menu-arrow"></i>

            </a>
            <div class="collapse" id="ui-basic-delicate">
                <ul class="nav flex-column sub-menu">
                    <?php foreach ($delegants as $delegant) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./showAllWorkReq.php?delegantWorkReq=<?php echo $delegant['wName']; ?>">
                                <?php echo $delegant['wName']; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-technician" aria-expanded="false" aria-controls="ui-basic-technician">
                <i class="mdi mdi-human-male menu-icon mx-2"></i>
                <span class="menu-title">الفني</span>
                <i class="menu-arrow"></i>

            </a>
            <div class="collapse" id="ui-basic-technician">
                <ul class="nav flex-column sub-menu">
                    <?php foreach ($technicians as $technician) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./showAllWorkReq.php?technichanWorkReq=<?php echo $technician['wName']; ?>">
                                <?php echo $technician['wName']; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </li>
        <?php if ($_SESSION['isAdmin'] == 1) { ?>
            <li class="nav-item">
                <a class="nav-link" href="./addWorker.php">
                    <i class=" mdi mdi-account-plus  menu-icon mx-2"></i>
                    <span class="menu-title">اضافة مندوب / فني</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./saveXlsx.php?q=customers" role="button"> 
                    <i class=" mdi mdi-account-plus  menu-icon mx-2"></i>
                    <span class="menu-title"> مشاركة العملاء </span>
                    </a>
            </li>
            <li class="nav-item"> <a class="nav-link" href="./saveXlsx.php?q=workReq" role="button"> 
                <i class=" mdi mdi-account-plus  menu-icon mx-2"></i>
                <span class="menu-title"> مشاركة أوامر العمل</span>
                </a>

            </li>
        <?php } ?>



    </ul>
</nav>