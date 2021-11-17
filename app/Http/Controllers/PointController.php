<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PointController extends Controller
{

    public function index()
    {
        $data = DB::table("nasabah")->get();
        $res  = array();
        foreach ($data as $d) {
            $point = 0;
            $trans = DB::table("transaksi")->where(['AccountId'=>$d->AccountId])->get();
            foreach ($trans as $t) {
                $tpoint = 0;
                if ($t->Description == 'Beli Pulsa') {
                    if($t->Amount < 10000){
                       $tpoint = 0; 
                    }elseif ($t->Amount > 10000 && $t->Amount < 30000) {
                        $tpoint = $t->Amount/1000;
                    }elseif ($t->Amount > 30000) {
                        $tpoint = $t->Amount/1000*2;
                    }
                }

                if ($t->Description == 'Bayar Listrik') {
                    if($t->Amount < 50000){
                       $tpoint = 0; 
                    }elseif ($t->Amount > 50000 && $t->Amount < 100000) {
                        $tpoint = $t->Amount/2000;
                    }elseif ($t->Amount > 100000) {
                        $tpoint = $t->Amount/2000*2;
                    }
                }
                $point += $tpoint;
                
            }
            $res[] = array(
                            ["nama" => $d->Name, "point"=>$point]
                        );
        }
        return response()->json([
                                "RC"=>00,
                                "message"=>$res
                            ]);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
