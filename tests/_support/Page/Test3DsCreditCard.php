<?php
namespace Page;

class Test3DsCreditCard
{
    // include url of current page
    public static $URL = '';

    public static $pan = '4809386824280323';
    public static $expireMonth = '12';
    public static $expireYear = '2024';
    public static $firshName = 'Jhon';
    public static $lastName = 'Doe';
    public static $threeDSCode = 'qqq111222333';
    public static $cvv = '547';

    public static $firstNameField = '//*[@id="first_name"]';
    public static $lastNameField = '//*[@id="last_name"]';
    public static $panField = '//*[@id="account_number"]';
    public static $cvvField = '//*[@id="card_security_code"]';
    public static $expireMonthField = '//*[@id="expiration_month_list"]';
    public static $expireYearField = '//*[@id="expiration_year_list"]';
    public static $successButton = '//*[@id="hpp-form-submit"]';
    public static $cancelButton = '//*[@id="hpp-form-cancel"]';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }


}
