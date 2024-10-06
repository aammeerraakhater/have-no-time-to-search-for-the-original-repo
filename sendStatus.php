<?php
include 'init.php';

if (isset($_GET['id']) & isset($_GET['serviceStatus'])) {
    $id = $_GET['id'];
    $serviceStatus = $_GET['serviceStatus'];
    $updateCol = "serviceStatus";
    $reqDate = date("Y/m/d");

    updateSpecific('workreq', $id, $updateCol, $serviceStatus);
    updateSpecific('workreq', $id,  "operatedDate", $reqDate);
}
if (isset($_GET['id']) & isset($_GET['Notes'])) {
    $id = $_GET['id'];
    $note = $_GET['Notes'];
    echo $id, $note;
    $updateCol = "Notes";
    updateSpecific('workreq', $id, $updateCol, $note);
}
if (isset($_GET['id']) & isset($_GET['technician'])) {
    $id = $_GET['id'];
    $technician = $_GET['technician'];
    $updateCol = "technician";
    updateSpecific('workreq', $id, $updateCol, $technician);
}
if (isset($_GET['orderID'])) {
    $id = $_GET['orderID'];
    $state = $_GET['state'];
    $updateCol = "orderStatus";
    $reqDate = date("Y/m/d");
    updateSpecific('orders', $id, $updateCol, $state, 'orderID');
    updateSpecific('orders', $id, 'doneDate', $reqDate, 'orderID');
}
