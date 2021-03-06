<?php

namespace Tests\Browser\Admin\User;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use Tests\Browser\Pages\Admin\User\CreateUserPage;

class CreateUserTest extends DuskTestCase
{
    use DatabaseMigrations;

    public $createUserPage;

    /**
     * Override function setup
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->createUserPage = new CreateUserPage;
    }

    /**
     * A Dusk test create user success.
     *
     * @return void
     */
    public function test_create_user_success()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                ->visit($this->createUserPage)
                ->type('@full_name', 'Nguyen Huu Khanh')
                ->type('@email', 'butchicun1236@gmail.com')
                ->type('@password', '12361236')
                ->type('@phone', '01695114848')
                ->type('@address', 'Da Nang')
                ->press('Submit')
                ->assertPathIs('/admin/users')
                ->assertSee(trans('user.admin.add.message.add_success'));
            $this->assertDatabaseHas('users', [
                'full_name' => 'Nguyen Huu Khanh',
                'email' => 'butchicun1236@gmail.com'
            ]);
        });
    }

    /**
     * A dusk test create user fail
     *
     * @return void
     */
    public function test_create_user_fail()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                    ->visit($this->createUserPage)
                    ->type('@full_name', '')
                    ->type('@email', 'taylor@laravel.com')
                    ->type('@password', '1236')
                    ->type('@phone', '1236')
                    ->type('@address', 'Da Nang')
                    ->press('Submit')
                    ->assertPathIs($this->createUserPage->url())
                    ->assertSee(trans('user.admin.add.message.require_full_name'))
                    ->assertSee(trans('user.admin.add.message.unique_email'))
                    ->assertSee(trans('user.admin.add.message.add_invalid_phone'))
                    ->assertSee(trans('user.admin.add.message.max_password'));
        });
    }
}
