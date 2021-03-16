<?php

namespace Tests\Unit;

use App\Domain\Employee\Entity\Employee;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CustTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetCustomer()
    {
        $response = $this->get('/customer');

        $response->assertRedirect('/');
    }

    public function testGetCustomerSearch()
    {
        $response = $this->get('/customer/search');

        $response->assertRedirect('/');
    }

    public function testLogin()
    {
        $credential = [
            'email' => 'albertus@gmail.com',
            'password' => Hash::make('owner')
        ];

        $response = $this->post('/gate',$credential);
        $response->assertSessionHasNoErrors();

    }

    public function testAfterLogin()
    {

        // $credential = [
        //     'email' => 'albertus@gmail.com',
        //     'password' => Hash::make('owner')
        // ];

        // $response = $this->post('/gate',$credential);
        // $response->assertRedirect('/meuble');

        // $user = Employee::factory()->create([
        //     'email' =>'albertus@gmail.com',
        //     'password' => Hash::make('owner'),
        // ]);
        // $response = $this->actingAs($user)->get('/meuble');

        $this->post('/gate',[
            'email' =>'albertus@gmail.com',
            'password' => Hash::make('owner'),
        ])->assertStatus(200);


    }
}
