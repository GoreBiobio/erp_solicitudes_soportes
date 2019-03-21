<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_servicio', function (Blueprint $table) {
            $table->increments('idSolServ')->index();
            $table->datetime('fecCreaSolServ');
            $table->text('solicitudServ');
            $table->integer('servIdSolServ');
            $table->text('obsSolServ');
            $table->datetime('fecCierreSolServ');
            $table->datetime('fecAprobSolServ');
            $table->text('obsCierreSolServ');
            $table->string('tipoSolServA',20);
            $table->string('tipoSolServB',20);
            $table->string('tipoSolServC',20);
            $table->string('tipoSSolServD',20);
            $table->integer('funcSolServ');
            $table->integer('funcRespoSolServ');
            $table->integer('funcAprobSolServ');
            $table->integer('estadoCritSolServ');
            $table->integer('estadoSolServ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_servicio');
    }
}
