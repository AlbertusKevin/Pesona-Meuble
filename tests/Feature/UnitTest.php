<?php

namespace Tests\Feature;

use App\Domain\CustomerManagement\Service\CustomerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class UnitTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }


    // public function testPostCustomer()
    // {
    //     $response = $this->from('customer/create')->json('POST', 'customer', [
    //         'name' => "Martin",
    //         'email' => "martin",
    //         'phone' => "0819283212",
    //         'address' => "Jl. Soetta 23"
    //     ]);

    //     $response->assertStatus(302);
    //     $response->assertRedirect('customer');
    // }

    public function testQueryListCustomer()
    {
        $customer = new CustomerService();
        $this->assertCount(3, $customer->index_customers());

        // Test Failed, It should be 3.
    }

    public function testQueryShowCustomer()
    {
        $customer = new CustomerService();
        $this->assertNull($customer->customer_by_id(3));
    }

    //TEST LOGIN 
    public function testLoginPage()
    {
        $response = $this->get('/gate');

        $this->assertEquals(200, $response->status());
    }

    public function testLoginServiceFail() { 
        $response = $this->post('/gate', [
            'email' => 'abc@gmail.com',
            'password' => 'test',
        ]);
        $response->assertRedirect('/');

    }

    public function testLoginSuccess() { 
        $response = $this->post('/gate', [
            'email' => 'albertus@gmail.com',
            'password' => 'owner',
        ]);
        $response->assertRedirect('/meuble');
    }

    public function testLogout() { 
        $response = $this->withSession(['login' => true, 'id_employee' => 1])->get('/logout');
        $response->assertRedirect('/');
    }

    //Cek validasi jika input email dan password yang tidak sesuai dengan Validator
    public function testLoginValidation() { 
        $response = $this->post('/gate', [
            'email' => 'test',
            'password' => '',
        ]);
        $response->assertSessionHasErrors(['email', 'password']);
    }

    // masih sedikit error
    // public function testCancelSalesOrder() { 
    //     $response = $this->withSession(['login' => true, 'id_employee' => 1])
    //         ->patch('/salesorder/cancel/123')
    //         ->assertRedirect('/salesorder');
    // }

}
