<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>
<?php

if (CModule::IncludeModule('sale')) {
    $ORDER_ID = $_SESSION["OrderId"];
    $arOrder = CSaleOrder::GetByID($ORDER_ID);

    $payID = $arOrder['PAY_SYSTEM_ID'];

    $temp = CSalePaySystemAction::GetList(array(), array("PAY_SYSTEM_ID" => $payID));
    $payData = $temp->Fetch();

    $data = array(
        "request_time_stamp" => trim($_POST['completion_time_stamp']),
        "request_signature" => trim($_POST['response_signature']),
        "merchant_account_id" => trim($_POST['merchant_account_id']),
        "request_id" => trim($_POST['request_id']),
        "transaction_type" => trim($_POST['transaction_type']),
        "requested_amount" => trim($_POST['requested_amount']),
        "requested_amount_currency" => trim($_POST['requested_amount_currency']),
        "ip_address" => trim($_POST['ip_address']),
        "redirect_url" => CSalePaySystemAction::GetParamValue("REDIRECT_URL"),
    );

    if ($_REQUEST['transaction_state'] == "failed") {
        $answer = 'Не удалось совершить оплату';
    } elseif ($_REQUEST['transaction_state'] == "success") {
        $answer = 'Оплата прошла успешно';
    } else {
        $answer = $_REQUEST['transaction_state'];
    }

    $arOrder = CSaleOrder::GetByID($orderNumber = IntVal($ORDER_ID));
    if ($arOrder) {
        $arFields = array(
            "STATUS_ID" => $answer == 'OK' ? "P" : "N",
            "PAYED" => $answer == 'OK' ? "Y" : "N",
            "PS_STATUS" => $answer == 'OK' ? "Y" : "N",
            "PS_STATUS_CODE" => $_POST['status_code_1'],
            "PS_STATUS_DESCRIPTION" => $_POST['status_description_1'] . " " . $payID . " " .
                ($answer != 'OK' ? $_REQUEST['status_description_1'] : ''),
            "PS_STATUS_MESSAGE" => $_POST["transaction_state"],
            "PS_SUM" => $_POST['requested_amount'],
            "PS_CURRENCY" => $_POST['requested_amount_currency'],
            "PS_RESPONSE_DATE" => date("d.m.Y H:i:s"),
        );
        if (CSaleOrder::Update($ORDER_ID, $arFields)) {
            if ($_POST["transaction_state"] == "success") {
                CSaleOrder::PayOrder($ORDER_ID, "Y");
                CSaleOrder::StatusOrder($ORDER_ID, "P");
            }
        }
    }

    echo $answer;
}

function getSignature($data, $secretKey)
{
    return hash('sha256', trim($data['request_time_stamp'] .
        $data['request_id'] .
        $data["merchant_account_id"] .
        $data["transaction_type"] .
        $data["requested_amount"] .
        $data["requested_amount_currency"] .
        $data["redirect_url"] .
        $data["ip_address"] .
        $secretKey));
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");