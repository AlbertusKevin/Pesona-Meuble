<?php

namespace Tests\Feature;

use App\Domain\CustomerManagement\Service\CustomerService;
use App\Domain\Employee\Service\EmployeeService;
use App\Domain\Procurement\Service\ProcurementService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class UnitTest extends TestCase
{
    public function testQueryListCustomer()
    {
        $customer = new CustomerService();
        $this->assertCount(2, $customer->index_customers());
    }

    public function testQueryListEmployee()
    {
        $employee = new EmployeeService();
        $this->assertNotEmpty($employee->index_employee());
        $this->assertCount(3, $employee->index_employee());
    }

    public function testQueryShowCustomer()
    {
        $customer = new CustomerService();
        $this->assertNull($customer->customer_by_id(3));
    }

    public function testGetNumPO()
    {
        $procurement = new procurementService();
        $number = $procurement->get_last_numPO();

        $this->assertEquals("10000002", $number);
    }

    //TEST LOGIN 
    public function testLoginPage()
    {
        $response = $this->get('/gate');
        $this->assertEquals(200, $response->status());
    }

    public function testLoginServiceFail()
    {
        $response = $this->post('/gate', [
            'email' => 'abc@gmail.com',
            'password' => 'test',
        ]);

        $response->assertRedirect('/');
    }

    public function testLoginSuccess()
    {
        $response = $this->post('/gate', [
            'email' => 'albertus@gmail.com',
            'password' => 'owner',
        ]);

        $response->assertRedirect('/meuble');
    }

    public function testLogout()
    {
        $response = $this->withSession(['login' => true, 'id_employee' => 1])
            ->get('/logout');
        $response->assertRedirect('/');
    }

    //Cek validasi jika input email dan password yang tidak sesuai dengan Validator
    public function testLoginValidation()
    {
        $response = $this->post('/gate', [
            'email' => 'test',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['email', 'password']);
    }

    public function testGetCustomer()
    {
        $response = $this->get('/customer');

        $response->assertRedirect('/');
    }

    public function testGetPageCustomerSearch()
    {
        $response = $this->get('/customer/search');

        $response->assertRedirect('/');
    }


    public function testGoToCustomerPage()
    {

        $this->withSession(['login' => true, 'id_employee' => 1])
            ->get('/customer')
            ->assertStatus(200);
    }

    public function testGetSearchCustomer()
    {
        $this->withSession(['login' => true, 'id_employee' => 1])
            ->get('/customer/1')
            ->assertSee('Martin');
    }

    // disini gaada validasi, jadi customer dengan nama&email sama pun bisa berkali2 dimasukin
    public function testPostCustomer()
    {
        $this->withSession(['login' => true, 'id_employee' => 1])
            ->post('/customer', [
                'name' => 'Fera',
                'email' => 'christy.ferani@gmail.com',
                'phone' => '0811112222',
                'address' => 'Jalan layang no 22'
            ])
            ->assertRedirect('/customer');
    }

    public function testUpdateCustomer()
    {
        $this->withSession(['login' => true, 'id_employee' => 1])
            ->patch('/customer/update/1', [
                'name' => 'Kimchi',
            ])
            ->assertSessionHasErrors('phone');
    }
}
