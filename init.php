<?php
date_default_timezone_set('Africa/Cairo');
$path = "includes/templates/";
$cssPath = "layout/css/";
$jsPath = "layout/js/";

include "connect_db.php";
include "functions.php";

$delegants = getBased('workers', 'workerLevel', 1, 'workerID');
$technicians = getBased('workers', 'workerLevel', 3, 'workerID');
$serviceStatuses = array('عمل اليوم', 'تم', 'شكوى', 'تأجيل', 'مطلوب',  'بالورشة', 'استكمال', 'ضروري', 'الغاء', 'حجز','اعادة صيانة');
$cities = array('بنها', 'طوخ', 'أخرى');
$serviceTypes = array(' تركيب تكييف', 'صيانه تكييف', ' تركيب فلتر', 'صيانه فلتر', '  مراتب', 'أخرى');
$customerTypes = array('تكييف', 'فلاتر', 'مراتب');
$orderStatuses = array('تسعير', 'طلب', 'تم', 'الغاء', 'تواصل مع العميل');
$orderTypes = array('تكييف', 'فلاتر ', 'مستلزمات', 'مراتب', 'أخرى');
$colors = array('success', 'danger', 'warning', 'primary', 'info');
