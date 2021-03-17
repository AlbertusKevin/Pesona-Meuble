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
    public function testPostCustomer(){
        $this->withSession(['login' => true, 'id_employee' => 1])
            ->post('/customer',[
                'name'=>'Fera',
                'email'=>'christy.ferani@gmail.com',
                'phone'=> '0811112222',
                'address'=>'Jalan layang no 22'
            ])
            ->assertRedirect('/customer');
    }

    public function testUpdateCustomer(){
        $this->withSession(['login' => true, 'id_employee' => 1])
            ->patch('/customer/update/1',[
                'name' => 'Kimchi',
            ])
            ->assertSessionHasErrors('phone');
    }


}
