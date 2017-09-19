<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?><?
include(GetLangFileName(dirname(__FILE__) . "/", "/payment.php"));

$psTitle = GetMessage("SPCP_DTITLE");
$psDescription = GetMessage("SPCP_DDESCR");
$arPSCorrespondence = array(

    "MERCHANT_ID" => array(
        "NAME" => GetMessage("MERCHANT_ID"),
        "DESCR" => GetMessage("MERCHANT_ID_DESCR"),
        "VALUE" => "",
        "TYPE" => ""
    ),
    "SECRET_KEY" => array(
        "NAME" => GetMessage("SECRET_KEY"),
        "DESCR" => GetMessage("SECRET_KEY_DESCR"),
        "VALUE" => "",
        "TYPE" => ""
    ),
    "REDIRECT_URL" => array(
        "NAME" => GetMessage("REDIRECT_URL"),
        "DESCR" => GetMessage("REDIRECT_URL_DESCR"),
        "VALUE" => "https://host/bitrix/pa",
        "TYPE" => ""
    ),
    "ORDER_ID" => array(
        "NAME" => GetMessage("ORDER_ID"),
        "DESCR" => GetMessage("ORDER_ID_DESCR"),
        "VALUE" => "ID",
        "TYPE" => "ORDER"
    ),
    "ORDER_DATE" => array(
        "NAME" => GetMessage("ORDER_DATE"),
        "DESCR" => GetMessage("ORDER_DATE_DESCR"),
        "VALUE" => "DATE",
        "TYPE" => "ORDER"
    ),
    "SHOULD_PAY" => array(
        "NAME" => GetMessage("SHOULD_PAY"),
        "DESCR" => GetMessage("SHOULD_PAY_DESCR"),
        "VALUE" => "SHOULD_PAY",
        "TYPE" => "ORDER"
    ),
    "CHANGE_STATUS_PAY" => array(
        "NAME" => GetMessage("PYM_CHANGE_STATUS_PAY"),
        "DESCR" => GetMessage("PYM_CHANGE_STATUS_PAY_DESC"),
        "VALUE" => "Y",
        "TYPE" => ""
    ),
    "IS_TEST" => array(
        "NAME" => GetMessage("IS_TEST"),
        "DESCR" => GetMessage("IS_TEST_DESCR"),
        "VALUE" => "Y",
        "TYPE" => ""
    ),

);
?>