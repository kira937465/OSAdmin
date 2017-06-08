<?php
require('../include/init.inc.php');
$day_time = '';
extract($_REQUEST, EXTR_IF_EXISTS);

Common::checkParam($day_time);

// 计算产品销售排行
$product_infos = [];
$conditions = ['purchaseTime' => ['$gte' => $day_time * 1000, '$lt' => ($day_time + 60 * 60 * 24) * 1000]];
$purchase_records = PurchaseRecord::search($conditions, null, null);

$userPayInfo = []; // 用户购买各种产品的信息
foreach ($purchase_records as $value) {
    // 标示是否新增的产品类型用于计算每种产品的信息
    $isAddedProduct = (array_search($value['productName'], array_column($product_infos, 'productName')) === false);
    $addedPay = Common::getProductPrice($value['productName']) * $value['purchaseNum'];
    if ($isAddedProduct) {
        $product_info = ['productName' => $value['productName'], 'purchaseNum' => $value['purchaseNum'], 'payAmount' => $addedPay];
        $product_infos[$value['productName']] = $product_info;
    } else {
        $tmp_info = &$product_infos[$value['productName']];
        $tmp_info['purchaseNum'] += $value['purchaseNum'];
        $tmp_info['payAmount'] += $addedPay;
    }

    $productPays = &$userPayInfo[$value['productName']];
    if ($productPays) {
        if (array_search($value['userDeviceID'], $productPays) === false) {
            array_push($productPays, $value['userDeviceID']);
        }
    } else {
        $productPays = [];
    }
}
// 统计每种产品的购买人数
foreach ($userPayInfo as $key => $value) {
    $product_infos[$key]['purchaseUsers'] = count(array_unique($value));
}
// 根据产品销售总额降序排序
$product_infos = Common::array_sort($product_infos, 'payAmount', SORT_DESC);

// 计算玩家排行
$user_infos = [];
foreach ($purchase_records as $value) {
    $isAddedProduct = (array_search($value['userDeviceID'], array_column($user_infos, 'userDeviceID')) === false);
    $addedPay = Common::getProductPrice($value['productName']) * $value['purchaseNum'];
    if ($isAddedProduct) {
        $user_info = ['userDeviceID' => $value['userDeviceID'], 'userID' => $value['userID'], 'purchaseNum' => $value['purchaseNum'], 'payAmount' => $addedPay];
        $user_info['deviceModel'] = $value['userDeviceInfo']['deviceModel'];
        $user_info['countryCode'] = $value['userDeviceInfo']['countryCode'];
        $user = Player::search(['deviceID' => $value['userDeviceID']])[0];
        $user_info['registTimeStr'] = $user['registTimeStr'];
        $user_info['curTaskID'] = $value['userData']['key_task_data']['key_task_curtaskid'];

        $user_infos[$value['userDeviceID']] = $user_info;
    } else {
        $tmp_info = &$user_infos[$value['userDeviceID']];
        $tmp_info['purchaseNum'] += $value['purchaseNum'];
        $tmp_info['payAmount'] += $addedPay;
    }
}
// 根据玩家购买总额降序排序
$user_infos = Common::array_sort($user_infos, 'payAmount', SORT_DESC);

Template::assign ('product_infos', $product_infos);
Template::assign ('user_infos', $user_infos);
Template::assign ( '_GET', $_GET );
Template::display('panel/sale_detail.tpl');
