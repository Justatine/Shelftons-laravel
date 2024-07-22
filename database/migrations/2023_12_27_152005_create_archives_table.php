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
        Schema::create('archives', function (Blueprint $table) {
            $table->bigIncrements('archiveID');
            $table->unsignedBigInteger('borrowID');
            $table->string('ISBN', 50);
            $table->unsignedBigInteger('userID');
            $table->dateTime('borrowDate');
            $table->dateTime('returnDate')->nullable();
            $table->string('bookStatus', 30);
            $table->enum('status_when_lost', ['Paid', 'Unpaid'])->default('Unpaid');
            $table->float('fine', 10, 2);
            $table->timestamps();
        });        
        
        // $data = [
        //     [
        //         'borrowID' => 1,
        //         'userID' => 2,
        //         'ISBN' => '0446605239',
        //         'borrowDate' => '2023-06-06 12:53:22',
        //         'returnDate' => null,
        //         'bookStatus' => 'Lost',
        //         'status_when_lost' => 'Paid',
        //         'fine' => 2000.00,
        //     ],
        //     [
        //         'borrowID' => 2,
        //         'userID' => '230409032738',
        //         'ISBN' => '9781407149073',
        //         'borrowDate' => '2023-06-08 21:44:39',
        //         'returnDate' => null,
        //         'bookStatus' => 'Lost',
        //         'status_when_lost' => 'Paid',
        //         'fine' => 319.00,
        //     ],
        //     [
        //         'borrowID' => 3,
        //         'userID' => '230409032738',
        //         'ISBN' => '9781784163068',
        //         'borrowDate' => '2023-06-09 21:22:20',
        //         'returnDate' => '2023-06-10 08:43:00',
        //         'bookStatus' => 'Returned',
        //         'status_when_lost' => 'Unpaid',
        //         'fine' => 0.00,
        //     ],
        //     [
        //         'borrowID' => 4,
        //         'userID' => '230409032738',
        //         'ISBN' => '9781784163068',
        //         'borrowDate' => '2023-06-10 08:46:54',
        //         'returnDate' => '2023-06-10 08:47:00',
        //         'bookStatus' => 'Returned',
        //         'status_when_lost' => 'Unpaid',
        //         'fine' => 0.00,
        //     ],
        // ];
        // DB::table('archives')->insert($data);        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};
