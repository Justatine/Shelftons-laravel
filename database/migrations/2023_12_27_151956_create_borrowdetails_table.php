<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('borrowdetails', function (Blueprint $table) {
            $table->bigIncrements('borrowID');
            $table->unsignedBigInteger('userID');
            $table->string('ISBN', 50);
            $table->dateTime('borrowDate');
            $table->date('returnSchedule');
            $table->dateTime('returnDate')->nullable();
            $table->enum('borrowStatus', ['Pending', 'Approved', 'Cancelled', 'Overdue'])->default('Pending');
            $table->enum('returnStatus', ['Returned', 'Not returned', 'Lost'])->nullable();
            $table->decimal('fine', 10, 2)->default(0.00);
            $table->timestamps();
        
            $table->foreign('ISBN')->references('ISBN')->on('books')->onDelete('cascade');
            $table->foreign('userID')->references('userID')->on('accounts')->onDelete('cascade');
        });
        // $data = [
        //     [
        //         'userID' => 2,
        //         'ISBN' => '0545560217',
        //         'borrowDate' => '2023-06-12 03:14:57',
        //         'returnSchedule' => '2023-06-15',
        //         'returnDate' => NULL,
        //         'borrowStatus' => 'Pending',
        //         'returnStatus' => NULL,
        //         'fine' => '0.00',
        //     ],
        //     [
        //         'userID' => 2,
        //         'ISBN' => '9781784163068',
        //         'borrowDate' => '2023-06-12 03:19:37',
        //         'returnSchedule' => '2023-06-15',
        //         'returnDate' => NULL,
        //         'borrowStatus' => 'Approved',
        //         'returnStatus' => 'Not returned',
        //         'fine' => '0.00',
        //     ],
        //     [
        //         'userID' => 2,
        //         'ISBN' => '9780142424179',
        //         'borrowDate' => '2023-06-21 03:50:00',
        //         'returnSchedule' => '2023-06-24',
        //         'returnDate' => NULL,
        //         'borrowStatus' => 'Pending',
        //         'returnStatus' => NULL,
        //         'fine' => '0.00',
        //     ],
        //     [
        //         'userID' => 2,
        //         'ISBN' => '9781015422551',
        //         'borrowDate' => '2023-06-23 07:05:40',
        //         'returnSchedule' => '2023-06-26',
        //         'returnDate' => NULL,
        //         'borrowStatus' => 'Approved',
        //         'returnStatus' => 'Returned',
        //         'fine' => '0.00',
        //     ],
        // ];        
        // DB::table('borrowdetails')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowdetails');
    }
};
