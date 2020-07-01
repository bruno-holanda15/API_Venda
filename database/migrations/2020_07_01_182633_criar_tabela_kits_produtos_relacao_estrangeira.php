<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaKitsProdutosRelacaoEstrangeira extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kits_produtos', function (Blueprint $table){
            $table->foreign('kit_id')->references('id')->on('kits');
            $table->foreign('produto_id')->references('id')->on('produtos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kits_produtos', function (Blueprint $table){
            $table->dropForeign(['kit_id']);
            $table->dropForeign(['produto_id']);

        });
    }
}
