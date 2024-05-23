<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regusers', function (Blueprint $table) {
            $table->bigIncrements('id')->length(5);
            $table->unsignedBigInteger('user_id');
            $table->string('first_name', 250)->nullable();
            $table->string('last_name', 250)->nullable();
            $table->bigInteger('mobile_number')->nullable();
            $table->string('email', 200)->nullable();
            $table->string('password', 120)->nullable();
            $table->timestamp('reg_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

//        DB::table('regusers')->insert([
//            'ID' => 2,
//            'FirstName' => 'Anuj',
//            'LastName' => 'Kumar',
//            'MobileNumber' => 1234567890,
//            'Email' => 'ak@gmail.com',
//            'Password' => bcrypt('f925916e2754e5e03f75dd58a5733251'), // You should hash the password
//            'Regdate' => '2022-05-10 18:05:56',
//        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regusers');
    }
}
