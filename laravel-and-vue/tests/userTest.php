<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class userTest extends TestCase
{

    Use DatabaseTransactions;

    public function testName()
    {

        factory(App\User::class)->create(['name'=>'Duilio']);

        $this->get('name')
            ->assertResponseOk();

        $this->seeText('Duilio');
    }
}
