<?php
require_once('../connect_db.php');
require_once('../functions.php');
global $con;
$query = $con->query("SELECT count(id) FROM customer");
$totalRecords =  getCountAll('customer', 'customerID')->fetch_array(); 
$length = $_GET ['length'];
$start = $_GET ['start'];

$sql = "SELECT customerID , usrName, phone, delegate, city, address, servicesType FROM customer";

if (isset($_GET['search']) && !empty($_GET['search']['value'])) {
    $search = $_GET['search']['value'];
    $sql .= sprintf(" WHERE usrName like '%s' OR phone like '%s' OR city like '%s' OR address like '%s'", '%'.$con->real_escape_string($search).'%', '%'.$con->real_escape_string($search).'%', '%'.$con->real_escape_string($search).'%', '%'.$con->real_escape_string($search).'%');
}



$sql .= " LIMIT $start, $length";
$query = $con->query($sql);
$result = [];
while ($row = $query->fetch_assoc()) {
    $result[] = [
        $row['usrName'],
        $row['delegate'],
        $row['city'],
        $row['address'],
        $row['phone'],
        "<a class='btn  btn-outline-info ' tabindex='-1' role='button' aria-disabled='true' href='./editCustomer.php?customerID=".$row['customerID']." '>تعديل </a>",
        "<a class='btn  btn-outline-success ' tabindex='-1' role='button' aria-disabled='true' href='./addWorkReq.php?customerID=". $row['customerID']." '>اضافه </a>"
    ];
}

echo json_encode([
    'draw' => $_GET['draw'],
    'recordsTotal' => $totalRecords[0],
    'data' => $result,
]);
