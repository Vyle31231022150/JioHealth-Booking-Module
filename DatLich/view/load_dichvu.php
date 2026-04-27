<?php
require_once __DIR__ . '/../model/booking_model.php';
if (isset($_GET['hinhthuc'])) {
    $hinhthuc = $_GET['hinhthuc'];
    $services = get_services($hinhthuc);
    echo '<option value="">-- Chọn dịch vụ --</option>';
    foreach ($services as $dv) {
        echo '<option value="'.$dv['MaDV'].'">'.htmlspecialchars($dv['TenDV']).'</option>';
    }
}
?>
