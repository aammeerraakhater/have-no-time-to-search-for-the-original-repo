<?php
ob_start();
session_start();
include 'includes/header.php';
if (isset($_SESSION['workerID'])) {
?>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php
        include 'init.php';
        include 'nav.php'; ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php
            include 'sideNav.php';
            if (isset($_GET['q'])) {
                $state =  $_GET['q'];
                $orders = getBased("orders", "orderStatus", $state, "orderID");
            } else {
                $orders = getAllData("orders", "orderID");
            }

            ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <h2> كل الطلبات </h2>
                    <div class="table-responsive">
                        <table id="ordersTable" class="table align-middle table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">تعديل بيانات </th>
                                    <th scope="col">حاله الطلب</th>
                                    <th scope="col">الاسم</th>
                                    <th scope="col">الطالب</th>
                                    <th scope="col">المطلوب منه</th>
                                    <th scope="col">رفم التليفون</th>
                                    <th scope="col">رقم امر العمل</th>
                                    <th scope="col">تاريخ تمام الطلب</th>
                                    <th scope="col">تاريخ الطلب</th>
                                    <th scope="col">الكميه</th>
                                    <th scope="col">السعر</th>
                                    <th scope="col">المدفوع</th>
                                    <th scope="col">الباقي</th>
                                    <th scope="col">الطلبات</th>
                                    <th scope="col">ملاحظات</th>
                                    <th scope="col">العنوان</th>
                                    <th scope="col">المدينه</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($orders as $order) {
                                    $workReqs =  getBased('workreq', 'id', $order['workReqID'], 'customerID');
                                    $workReq = $workReqs->fetch_assoc();
                                    $customers = getBased('customer', 'customerID', $workReq['customerID'], 'customerID');
                                    $customer =  $customers->fetch_assoc();
                                ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td> <a href="./editOrder.php?orderID=<?php echo $order['orderID']; ?>&customerID=<?php echo $workReq['customerID']; ?>" class="btn  btn-outline-info " tabindex="-1" role="button" aria-disabled="true">تعديل </a></td>
                                        <td>
                                            <select style="width:115px;" class="form-select" id="order<?php echo $i; ?>" name="orderStatus" onchange="confirmOrder(order<?php echo $i; ?>, <?php echo $order['orderID']; ?>,this.value)">
                                                <option selected value="" disabled>اختر...</option>
                                                <?php foreach ($orderStatuses as $orderStatus) { ?>
                                                    <option <?php if ($order['orderStatus'] == $orderStatus) {
                                                                echo 'selected';
                                                            } ?> value="<?php echo $orderStatus; ?>"> <?php echo $orderStatus; ?> </option>
                                                <?php } ?>
                                            </select>

                                        </td>
                                        <td> <?php echo $customer['usrName']; ?></td>
                                        <td> <?php echo $order['personOrdered']; ?></td>
                                        <td> <?php echo $order['orderedFrom']; ?></td>
                                        <td> <?php echo $customer['phone']; ?></td>
                                        <td> <?php echo $workReq['workReqNo']; ?></td>
                                        <td> <?php echo $order['doneDate']; ?></td>
                                        <td> <?php echo  $order['reqDate']; ?></td>
                                        <td> <?php echo $order['quantity']; ?></td>
                                        <td> <?php echo $order['price']; ?></td>
                                        <td> <?php echo $order['paid']; ?></td>
                                        <td> <?php echo $order['price'] - $order['paid']; ?></td>
                                        <td>
                                            <div style="width:150px;"><?php echo $order['Required']; ?></div>
                                        <td>
                                            <div style="width:300px;"><?php echo $order['addNotes']; ?></div>
                                        </td>
                                        <td> <?php echo $workReq['city']; ?></td>
                                        <td> <?php echo $workReq['address']; ?></td>
                                    </tr>
                                <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
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

?>