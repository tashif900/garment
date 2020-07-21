<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChildTransaction;
use App\Models\MasterTransaction;


class ChildTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ChildTransaction::with('product','master_transaction')->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        for($i = 0; $i < $request->count; $i++)
        {
            ChildTransaction::create([
            'product_id'            =>$request[$i]['product_id'],
            'master_transaciton_id' =>$request[$i]['master_transaction_id'],
            'quantity'              =>$request[$i]['quantity'],
            'color'                 =>$request[$i]['color'],
            'price'                 =>$request[$i]['price'],
            'discount'              =>$request[$i]['discount']
        ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
