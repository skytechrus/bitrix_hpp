<?php
$merchantId = '7a3fd25e-eabd-441e-8f8a-561891740683';
$secretKey = 'e60d5d84-44a8-490a-863e-f212da659cd8';

$I = new AcceptanceTester($scenario);
$I->wantTo('config module to PRODUCTION');
$I->amOnPage('/');
//$I->amOnPage('/restore.php');
$I->amOnPage('bitrix/admin/');
$I->fillField('USER_LOGIN', 'admin');
$I->fillField('USER_PASSWORD', 'q3sermon');
$I->click('Login');
$I->waitForText('Администрирование');
$I->waitForText('Подключите свой Битрикс24');
$I->click('close');
$I->waitForText('Магазин');
$I->click('#global_menu_store');
$I->click('Платежные системы');
$I->doubleClick('//*[@id="tbl_sale_pay_system"]/tbody/tr[9]/*[text()=\'Skytech\']');
$I->waitForText('Параметры платежной системы');
$id = $I->grabTextFrom('//*[@id="edit1_edit_table"]/tbody[1]/tr[1]/td[2]');
$I->waitForText('Показать все');
$I->scrollTo('//*[@id="map"]/div/p/a'); //fix error ...is not clickable at point...
$I->click('Показать все');
$I->uncheckOption('PAYSYSTEMBizVal[MAP][PAYSYSTEM_'.$id.'][MERCHANT_ID][0][DELETE]');
$I->uncheckOption('PAYSYSTEMBizVal[MAP][PAYSYSTEM_'.$id.'][SECRET_KEY][0][DELETE]');
$I->uncheckOption('PAYSYSTEMBizVal[MAP][PAYSYSTEM_'.$id.'][IS_TEST][0][DELETE]');
$I->fillField('PAYSYSTEMBizVal[MAP][PAYSYSTEM_'.$id.'][IS_TEST][0][PROVIDER_VALUE]', '');
$I->fillField('PAYSYSTEMBizVal[MAP][PAYSYSTEM_'.$id.'][MERCHANT_ID][0][PROVIDER_VALUE]', $merchantId);
$I->fillField('PAYSYSTEMBizVal[MAP][PAYSYSTEM_'.$id.'][SECRET_KEY][0][PROVIDER_VALUE]', $secretKey);
$I->click('save');
