<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackAssetMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_asset_movements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table -> integer("sourceDepId");
            $table -> integer("sourceUnitId");
            $table -> integer("destinationDepId");
            $table -> integer("destinationUnitId");
            $table -> integer("assetId");
            $table -> string("Justification",200);
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
        Schema::dropIfExists('track_asset_movements');
    }
}
