<?php 
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

$I->wait(10);
