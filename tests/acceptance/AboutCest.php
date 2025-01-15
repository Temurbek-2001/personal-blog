<?php

use yii\helpers\Url;

class AboutCest
{
    public function ensureThatAboutWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Welcome!', 'h1');
        $I->seeLink('About');
        $I->click('About');
        $I->see('About', 'h1');


    }
}
