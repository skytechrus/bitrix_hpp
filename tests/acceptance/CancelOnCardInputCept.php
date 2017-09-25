<?php

use Page\Test3DsCreditCard as Test3DsCreditCard;

$I = new AcceptanceTester($scenario);
$I->wantTo('buy order by test minb card with 3ds');
$I->amOnPage('/');
$I->moveMouseOver('//*[@id="bx_eshop_wrap"]/div[1]/div/div/div/div[3]/div[1]/div/div/div[1]/div/div/div');
$I->waitForText('В корзину');
//$I->grabAttributeFrom('//*[@id="bx_eshop_wrap"]/div[1]/div/div/div/div[3]/div[1]/div/div/div[1]/div/div/div', );
//$I->wait(5);//*[@id="bx_eshop_wrap"]/div[1]/div/div/div/div[3]/div[1]/div/div/div[1]/div/div/div/div/div[4]/div/div/a
$I->click('//*[@id="bx_eshop_wrap"]/div[1]/div/div/div/div[3]/div[1]/div/div/div[1]/div/div/div/div/div[4]/div/div/a');
$I->waitForText('Перейти в корзину');
//$I->click('/html/body/div[6]/div[3]/span');
$I->click('.btn.btn-default.btn-buy.btn-sm');
$I->waitForText('Оформить заказ');
$I->click('Оформить заказ');
$I->waitForText('Оформление заказа');
$I->click('Далее');
$I->wait(1);
$I->click('Далее');
$I->wait(1);
$I->click('Далее');
$I->wait(1);
$I->click('//*[@id="bx-soa-paysystem"]/div[2]/div[2]/div[1]/div//*[contains(., \'Skytech\')]');
$I->waitForText('Skytech', null, '//*[@id="bx-soa-paysystem"]/div[2]/div[2]/div[2]/div/div/div[1]');
$I->click('Далее');
$I->fillField('ORDER_PROP_1', 'Иванов Сергей Васильевич');
//$I->wait(1);
$I->fillField('ORDER_PROP_2', 'test@test.com');
//$I->wait(1);
$I->fillField('ORDER_PROP_3', '+79999999999');
//$I->wait(1);
$I->fillField('ORDER_PROP_7', 'test');
//$I->wait(1);
$I->click('//*[@id="bx-soa-orderSave"]/a');
$I->waitForText('Заказ сформирован');
$I->click('Оплатить');
$I->waitForText('ОБЗОР ЗАКАЗА', 30);
$I->canSee('ОБЗОР ЗАКАЗА');
$I->fillField(Test3DsCreditCard::$firstNameField, Test3DsCreditCard::$firshName);
$I->fillField(Test3DsCreditCard::$lastNameField, Test3DsCreditCard::$lastName);
$I->fillField(Test3DsCreditCard::$panField, Test3DsCreditCard::$pan);
$I->fillField(Test3DsCreditCard::$cvvField, Test3DsCreditCard::$cvv);
$I->selectOption(Test3DsCreditCard::$expireMonthField, Test3DsCreditCard::$expireMonth);
$I->selectOption(Test3DsCreditCard::$expireYearField, Test3DsCreditCard::$expireYear);
$I->click(Test3DsCreditCard::$cancelButton);
//$I->waitForText('Главная страница');
//$I->wait(30);
$I->waitForText('ОКНО ПОДТВЕРЖДЕНИЯ', 10);
$I->click('//*[@id="hpp-confirm-button-yes"]');
//*[@id="hpp-confirm-button-no"]
$I->wait(30);
//$I->cantSee('Не удалось совершить оплату', '//*[@id="bx_eshop_wrap"]/div[1]/div/div/div[1]');
