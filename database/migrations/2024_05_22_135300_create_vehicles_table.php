<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id')->length(10);
            $table->string('parking_number', 120)->nullable();
            $table->string('vehicle_category', 120);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('vehicle_company_name', 120)->nullable();
            $table->string('registration_number', 120)->nullable();
            $table->string('owner_name', 120)->nullable();
            $table->bigInteger('owner_contact_number')->nullable();
            $table->timestamp('in_time')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('out_time')->nullable()->default(null)->useCurrentOnUpdate();
            $table->string('parking_charge', 120);
            $table->mediumText('remark');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->string('status', 5);
        });

//        DB::table('vehicle')->insert([
//            [
//                'ParkingNumber' => '521796069',
//                'VehicleCategory' => 'Two Wheeler Category',
//                'VehicleCompanyName' => 'Hyndai',
//                'RegistrationNumber' => 'DEL-678787',
//                'OwnerName' => 'Rakesh Chandra',
//                'OwnerContactNumber' => 7987987987,
//                'InTime' => '2022-05-09 05:58:38',
//                'OutTime' => '2022-05-09 11:38:04',
//                'ParkingCharge' => '50 Rs',
//                'Remark' => 'NA',
//                'Status' => 'Out'
//                ],
//            [
//                'ParkingNumber' => '469052796',
//                'VehicleCategory' => 'Two Wheeler Vehicle',
//                'Vehicle CompanyName' => 'Activa',
//                'RegistrationNumber' => 'DEL-895623',
//                'OwnerName' => 'Pankaj',
//                'OwnerContactNumber' => 8989898989,
//                'InTime' => '2022-05-06 08:58:38',
//                'OutTime' => '2022-05-07 11:09:33',
//                'ParkingCharge' => '35 Rs.',
//                'Remark' => 'NA',
//                'Status' => 'Out'
//            ],
//            [
//                'ParkingNumber' => '734465023',
//                'VehicleCategory' => 'Four Wheeler Vehicle',
//                'Vehicle CompanyName' => 'Hondacity',
//                'RegistrationNumber' => 'DEL-562389',
//                'OwnerName' => 'Avinash',
//                'OwnerContactNumber' => 7845123697,
//                'InTime' => '2022-05-06 08:58:38',
//                'OutTime' => '2022-05-06 08:59:36',
//                'ParkingCharge' => '50 Rs.',
//                'Remark' => 'Vehicle Out',
//                'Status' => 'Out'
//            ],
//            [
//                'ParkingNumber' => '432190880',
//                'VehicleCategory' => 'Two Wheeler Vehicle',
//                'Vehicle CompanyName' => 'Hero Honda',
//                'RegistrationNumber' => 'DEL-451236',
//                'OwnerName' => 'Harish',
//                'OwnerContactNumber' => 1234567890,
//                'InTime' => '2022-05-06 08:58:38',
//                'OutTime' => '2022-05-10 18:07:00',
//                'ParkingCharge' => '35 Rs.',
//                'Remark' => 'Vehicle Out',
//                'Status' => 'Out'
//            ],
//            [
//                'ParkingNumber' => '323009894',
//                'VehicleCategory' => 'Two Wheeler Vehicle',
//                'Vehicle CompanyName' => 'Activa',
//                'RegistrationNumber' => 'DEL-55776',
//                'OwnerName' => 'Abhi',
//                'OwnerContactNumber' => 4654654654,
//                'InTime' => '2022-05-06 08:58:38',
//                'OutTime' => '2022-05-06 08:59:24',
//                'ParkingCharge' => '',
//                'Remark' => '',
//                'Status' => ''
//            ],
//            [
//                'ParkingNumber' => '522578915',
//                'VehicleCategory' => 'Two Wheeler Vehicle',
//                'Vehicle CompanyName' => 'Hondacity',
//                'RegistrationNumber' => 'DEL-895623',
//                'OwnerName' => 'Mahesh',
//                'OwnerContactNumber' => 7978999879,
//                'InTime' => '2022-05-06 08:58:38',
//                'OutTime' => '2022-05-09 04:43:50',
//                'ParkingCharge' => '',
//                'Remark' => '',
//                'Status' => ''
//            ],
//            [
//                'ParkingNumber' => '917725207',
//                'VehicleCategory' => 'Two Wheeler Vehicle',
//                'Vehicle CompanyName' => 'Honda',
//                'RegistrationNumber' => 'DEL-895623',
//                'OwnerName' => 'ABC',
//                'OwnerContactNumber' => 1234567890,
//                'InTime' => '2022-05-07 11:03:05',
//                'OutTime' => '2022-05-09 04:43:55',
//                'ParkingCharge' => '50',
//                'Remark' => 'ljlkjlk',
//                'Status' => 'Out'
//            ]
//
//        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
