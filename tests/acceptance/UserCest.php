<?php

use yii\helpers\Url;

class UserCest
{
    public function ensureThatAboutWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/user'));
        $I->see('User List', 'h1');
    }
}
