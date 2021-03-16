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

    public function testQueryListCustomer()
    {
        $customer = new CustomerService();
        $this->assertCount(2, $customer->index_customers());
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

    public function testQueryListEmployee()
    {
        $employee = new EmployeeService();
        $this->assertNotEmpty($employee->index_employee());
        $this->assertCount(2, $employee->index_employee());
    }

    // public function testPostCustomer()
    // {
    // $response = $this->from('/customer/create')->postJson('/customer', [
    //     '_token' => csrf_token(),
    //     'name' => "Martin",
    //     'email' => "martin@gmail.com",
    //     'phone' => "0819283212",
    //     'address' => "Jl. Soetta 23"
    // ]);

    // $response->assertStatus(302);
    // $response->assertRedirect('/customer');

    //     $customer = new CustomerService();

    //     $this->assertTrue($customer->new_customer([
    //         'name' => "Martin",
    //         'email' => "martin@gmail.com",
    //         'phone' => "0819283212",
    //         'address' => "Jl. Soetta 23"
    //     ]));
    // }
}
