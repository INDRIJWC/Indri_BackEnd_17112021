<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'AccountId'             => 'required',
            'ProductId'             => 'required',
            'Amount'                => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ]);

        if ($validator->fails()) {
            return response()->json([
                                        "RC"=>01,
                                        "message"=>"Format salah"
                                    ]);
        }

        $account = DB::table('nasabah')->where('AccountId','=',$request->AccountId)->first();
        if (is_null($account)) {
            return response()->json([
                                        "RC"=>01,
                                        "message"=>"AccountId Tidak Ditemukan"
                                    ]);
        }

        $product = DB::table('product_trans')->where('ProductId','=',$request->ProductId)->first();
        if (is_null($product)) {
            return response()->json([
                                        "RC"=>01,
                                        "message"=>"ProductId Tidak Ditemukan"
                                    ]);
        }
        
        $insert = DB::table("transaksi")->insert([
            "AccountId"             =>$request->AccountId,
            "TransactionDate"       =>date("Y-m-d H:i:s"),
            "Description"           =>$product->ProductName,
            "DebitCreditStatus"     =>strtoupper($product->DebitCreditStatus),
            "Amount"                =>$request->Amount,
        ]);
        return response()->json([
                                    "RC"=>00,
                                    "message"=>"Berhasil"
                                ]);
        
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'AccountId'     => 'required',
            'StartDate'     => 'required|date_format:Y-m-d',
            'EndDate'       => 'required|date_format:Y-m-d'
        ]);

        if ($validator->fails()) {
            return response()->json([
                                        "RC"=>01,
                                        "message"=>"Format salah"
                                    ]);
        }

        $data = DB::table('transaksi')
                    ->where(['AccountId'=>$request->AccountId])
                    ->whereBetween('TransactionDate',array($request->StartDate,$request->EndDate))
                    ->select('TransactionDate','Description','DebitCreditStatus','Amount')
                    ->get();
        
        return response()->json([
                                    "RC"=>00,
                                    "message"=>$data
                                ]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
