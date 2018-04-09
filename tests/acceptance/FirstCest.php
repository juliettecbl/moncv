<?php


class FirstCest
{
    
    public function frontpageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/cours');
        $I->see('bde mmi');
    }
    
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }
}
