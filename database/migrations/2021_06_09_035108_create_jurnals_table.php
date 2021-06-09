<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnals', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('debit_id')->nullable()->index('debit_id_fk1_idx');
            $table->integer('nom_debit')->nullable();
            $table->foreignId('kredit_id')->nullable()->index('kredit_id_fk2_idx');
            $table->integer('nom_kredit')->nullable();
            $table->string('keterangan');
            $table->timestamps();

            $table->foreign('debit_id', 'debit_id_fk1')->references('id')->on('akuns')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('kredit_id', 'kredit_id_fk2')->references('id')->on('akuns')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jurnals');
    }
}
