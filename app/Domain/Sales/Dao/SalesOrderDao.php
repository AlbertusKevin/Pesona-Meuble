<?php

namespace App\Domain\Sales\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Sales\Entity\SalesOrder;
use App\Domain\CustomerManagement\Dao\CustomerDB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalesOrderDao extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    public function findAllSalesOrders()
    {
        // $salesorders = SalesOrder::orderBy('numSO', 'asc')->paginate(9);
        $salesorders = SalesOrder::all();
        return $salesorders; 
    }

    public function findSalesOrderByNumSOWithCustomer($numSO)
    {
        $salesorder = SalesOrder::where('numSO', $numSO)
            ->join('customer', 'sales_order.customer', '=', 'customer.id')->first();
        return $salesorder; 
    }

    public function findLastNumSO()
    {
        $salesorder =  Salesorder::orderBy('numSO', 'desc')->take(1)->get();
        return $salesorder;
    }

    public function findSalesOrderHistory()
    {
        $salesorders =  Salesorder::where('transactionStatus', '=', 2)
            ->orwhere('transactionStatus', '=', 3)
            ->get();
        return $salesorders;
    }

    //insert data header dari PO ke tabel purchase_order
    public function createSalesOrder($header)
    {
        $customerDB = new CustomerDB(); 
        
        SalesOrder::create([
            'numSO' => $header["numSO"],
            'customer' => (int)$header["customer"],
            'responsibleEmployee' => (int)$header["employeeID"],
            'date' =>Carbon::parse($header["date"])->format('Y-m-d'),
            'validTo' => Carbon::parse($header["validTo"])->format('Y-m-d'),
            'transactionStatus' => 0,
            'totalItem' => (int)$header["totalItem"],
            //   'freightIn' => (int)$header["freightIn"],
            'totalPrice' => (int)$header["totalPrice"],
            'paymentDiscount' => null,
            'totalDiscount' => (int)$header["totalDisc"],
            'totalPayment' => (int)$header["totalPayment"],
            'totalMeubleDiscount' => 0
        ]);
    }

    public function updateSalesOrder(Request $request)
    {
        $salesorder = SalesOrder::find($request->numSO);
        
        $salesorder->numSO = $request->numSO; 
        $salesorder->responsibleEmployee = $request->responsibleEmployee; 
        $salesorder->customer = $request->customer;
        $salesorder->date = $request->date; 
        $salesorder->validTo = $request->validTo; 
        $salesorder->transactionSatus = $request->transactionStatus; 
        $salesorder->totalItem = $request->totalItem; 
        $salesorder->totalMeubleDiscount = $request->totalMeubleDiscount; 
        $salesorder->totalPrice = $request->totalPrice; 
        $salesorder->paymentDiscount = $request->paymentDiscount; 
        $salesorder->totalDiscount = $request->totalDiscount; 
        $salesorder->totalPayment = $request->totalPayment; 
        
        $salesorder->save(); 
    }


    
}
