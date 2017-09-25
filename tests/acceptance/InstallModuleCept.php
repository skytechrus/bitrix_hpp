<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('install payment Skytech module');
$I->amOnPage('/');
$I->amOnPage('/restore.php');
$I->amOnPage('bitrix/admin/');
$I->fillField('USER_LOGIN', 'admin');
$I->fillField('USER_PASSWORD', 'q3sermon');
$I->click('Login');
$I->waitForText('Администрирование');

/*
 * Зайти самому в административную панель Битрикса и поставить галочку
 * в всплывающем окне Битрикс24, чтобы больше не показывало сообщение
 * */

$I->waitForText('Магазин');
$I->click('#global_menu_store');
$I->waitForText('Настройки');
$I->click('//*[@id="_global_menu_store"]/div[8]/div[1]/a');
$I->waitForText('Платежные системы');
$I->wait(5);
$I->click('Платежные системы');
$I->click('#btn_new'); // добавить платежную систему
$I->selectOption('[name=ACTION_FILE]', 'Skytech');
$I->waitForText('Идентификатор магазина (merchant id)');
$I->wait(5);
$I->uncheckOption('PAYSYSTEMBizVal[MAP][PAYSYSTEM_NEW][MERCHANT_ID][0][DELETE]');
$I->uncheckOption('PAYSYSTEMBizVal[MAP][PAYSYSTEM_NEW][SECRET_KEY][0][DELETE]');
$I->uncheckOption('PAYSYSTEMBizVal[MAP][PAYSYSTEM_NEW][IS_TEST][0][DELETE]');
$I->fillField('PAYSYSTEMBizVal[MAP][PAYSYSTEM_NEW][IS_TEST][0][PROVIDER_VALUE]', 'Y');
$I->fillField('PAYSYSTEMBizVal[MAP][PAYSYSTEM_NEW][MERCHANT_ID][0][PROVIDER_VALUE]', '5352df99-9aad-48ec-bf43-f14c1b4912c3');
$I->fillField('PAYSYSTEMBizVal[MAP][PAYSYSTEM_NEW][SECRET_KEY][0][PROVIDER_VALUE]', 'bdbbd449-33c3-4750-afdd-f5d6544e5276');
$I->click('save'); // добавить платежную систему
$I->expect('payment method install successful');