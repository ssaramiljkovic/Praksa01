<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id')->length(10);
            $table->string('vehicle_cat', 120);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->timestamp('creation_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::table('categories')->insert([
            'vehicle_cat' => 'Four Wheeler Vehicle',
            'creation_date' => '2022-05-01 11:06:50',
        ]);

        DB::table('categories')->insert([
            'vehicle_cat' => 'Two Wheeler Vehicle',
            'creation_date' => '2022-03-02 11:07:09'
        ]);

        DB::table('categories')->insert([
            'id' => 4,
            'vehicle_cat' => 'Bicycles',
            'creation_date' => '2022-05-03 11:31:17'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
