<?php

namespace App\Tests;

class LoginTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->install();
    }

    public function testSuccessfulLoginWithDefaultCredentials()
    {
        $this->visit(route('voyager.login'));
        $this->type('admin@admin.com', 'email');
        $this->type('password', 'password');
        $this->press('Login');
        $this->seePageIs(route('voyager.dashboard'));
    }

    public function testShowAnErrorMessageWhenITryToLoginWithWrongCredentials()
    {
        $this->visit(route('voyager.login'))
             ->type('john@Doe.com', 'email')
             ->type('pass', 'password')
             ->press('Login')
             ->seePageIs(route('voyager.login'))
             ->see('The given credentials don\'t match with an user registered.')
             ->seeInField('email', 'john@Doe.com');
    }
}
