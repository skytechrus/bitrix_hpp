<?
$Sum = $GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["SHOULD_PAY"];
$secretKey = CSalePaySystemAction::GetParamValue("SECRET_KEY");
$merchantId = CSalePaySystemAction::GetParamValue("MERCHANT_ID");
//$customerNumber = CSalePaySystemAction::GetParamValue("ORDER_ID");
$orderDate = $GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["CURRENCY"]["ORDER_DATE"];
$orderNumber = IntVal($GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["ID"]);
$currency = $GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["CURRENCY"];
if ($currency === "RUR") {
    $currency = "RUB";
}
$Sum = number_format($Sum, 2, '.', '');

$host = COption::GetOptionString("main", "server_name", $_SERVER["HTTP_HOST"]);
if ($host == "") {
    $host = $_SERVER["HTTP_HOST"];
}
$host = $_SERVER['HTTPS'] == 'on' ? 'https://' . $host : 'http://' . $host;

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

function generateUid()
{
    $bytes = openssl_random_pseudo_bytes(32);
    return bin2hex($bytes);
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$timezone = new DateTimeZone("UTC");
$date = new DateTime("now", $timezone);

$fields = array(
    "request_time_stamp" => "",
    "request_signature" => "",
    "merchant_account_id" => trim($merchantId),
    "request_id" => "",
    "transaction_type" => "purchase",
    "requested_amount" => trim($Sum),
    "requested_amount_currency" => trim($currency),
    "ip_address" => '127.0.0.1',
    "redirect_url" => trim(CSalePaySystemAction::GetParamValue("REDIRECT_URL")),
    "order_number" => trim($orderNumber),
    "locale" => strtoupper(LANGUAGE_ID),
    "attempt_three_d" => "true"
);

$_SESSION['OrderId'] = $orderNumber;
$fields["request_time_stamp"] = trim($date->format("YmdHis"));
$fields["request_id"] = trim(generateUid());
$fields["request_signature"] = getSignature($fields, $secretKey);

if (CSalePaySystemAction::GetParamValue("IS_TEST") == ('true' || '1')) {

    echo "<form name = 'ShopForm' action = 'https://api-test.skytecrussia.com/engine/hpp/' method = 'post'>";
} else {
    echo '<form name="ShopForm" action="https://api.skytecrussia.com/engine/hpp/" method="post">';
}

while (list($name, $value) = each($fields)) {
    echo "<input name='{$name}' value='{$value}' type='hidden'>";
}

?>

<input name="cms_name" value="1C-Bitrix" type="hidden">
<br/>
Детали заказа:<br/>
<input name="OrderDetails" value="заказ №<?= $orderNumber ?> " type="hidden">
<br/>
<input name="BuyButton" value="Оплатить" type="submit">

</font><p><font class="tablebodytext"><b>ВНИМАНИЕ!</b> Возврат средств по платежной системе Skytech - невозможен,
        пожалуйста, будьте внимательны при оплате заказа.</font></p>
</form>