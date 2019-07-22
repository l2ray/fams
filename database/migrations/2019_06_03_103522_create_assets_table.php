<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table -> string("assetName",200);
            $table -> double("assetCost",17,2);
            $table -> double("residualValue",12,2);
            $table -> date("assetStartDate");
            $table -> integer("assetCategory");
            $table -> integer("assetType");
            $table -> integer("assetLocation");
            $table -> integer("assetUsagePeriod");
            $table -> double("assetMonthlyDepreciation",12,2);
            $table -> double("assetBookValue",12,2);
            $table -> double("totalDepreciatedAmount",12,2);
            $table -> integer("assetStatus");
            $table -> string("assetDescription",100);
            $table -> string("barcode",100);
            $table -> integer("totalMonthsDepreciated");
            $table -> integer("totalMonthsLeft");
            $table -> string("userAssigned",100);
            $table -> integer("backTracked");
            $table -> integer("aUnit");
            $table -> integer("aDep");
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
        Schema::dropIfExists('assets');
    }
}
