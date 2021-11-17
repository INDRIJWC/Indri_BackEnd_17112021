<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductTrans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        Schema::create('product_trans', function (Blueprint $table) {
            $table->increments('ProductId');
            $table->string('ProductName');
            $table->string('DebitCreditStatus');
        });

        DB::table('product_trans')->insert([
                [
                    'ProductName' => 'Setor Tunai',
                    'DebitCreditStatus' => 'C'
                ],
                [
                    'ProductName' => 'Beli Pulsa',
                    'DebitCreditStatus' => 'D'
                ],
                [
                    'ProductName' => 'Bayar Listrik',
                    'DebitCreditStatus' => 'D'
                ],
                [
                    'ProductName' => 'Tarik Tunai',
                    'DebitCreditStatus' => 'D'
                ] 
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_trans');
    }
}
