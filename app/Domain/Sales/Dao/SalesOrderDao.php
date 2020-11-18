<?php

namespace App\Domain\Sales\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Sales\Entity\SalesOrder;
use Illuminate\Http\Request;


class SalesOrderDao extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    public function findAllSalesOrders()
    {
        $salesorders = SalesOrder::orderBy('numSO', 'asc')->paginate(9);
        return $salesorders; 
    }

    public function findSalesOrderByNumSO($numSO)
    {
        $salesorder = SalesOrder::where('numSO', '=', $numSO)->first();
        return $salesorder; 
    }

    public function createSalesOrder(Request $request)
    {
        $salesorder = new SalesOrder;
        
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
