<?php
include('../class/class.config.php');

$config = new config;


if (isset($_GET['prepare_once'])) {

    $m_shop = $config->PayeerMerchantId;
    $m_orderid = $_GET['uid'];
    $m_amount = number_format($_GET['sum'], 2, '.', '');
    $m_curr = $_GET['curr']; if ($m_curr <> "RUB" && $m_curr <> "USD") { $m_curr = "RUB"; }
    $m_desc = base64_encode($_GET['desc']);
    $m_key = $config->PayeerMerchantSecret;

    $arHash = array(
        $m_shop,
        $m_orderid,
        $m_amount,
        $m_curr,
        $m_desc
    );

    $arHash[] = $m_key;

    $sign = strtoupper(hash('sha256', implode(':', $arHash)));

    $arrayansw = array($m_amount, $m_desc, $sign);

    echo json_encode($arrayansw);

    //echo $sign;
    //print_r($arrayansw);
    //print_r($arHash);
    //echo '<hash>'.$sign.'</hash>';
    //echo '<hash>'.$sign.'</hash><hash>'.$m_amount.'</hash>';
    exit;
}
?>