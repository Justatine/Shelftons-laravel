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
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('userID');
            $table->string('userImg', 50);
            $table->string('firstname', 30);
            $table->string('middlename', 30)->nullable();
            $table->string('lastname', 30);
            $table->enum('gender', ['Male', 'Female']);
            $table->date('birthdate');
            $table->string('email', 50); 
            $table->string('phoneNo', 11);
            $table->string('current_address', 255);
            $table->string('city', 50);
            $table->string('province', 50);
            $table->string('zipcode', 11);
            $table->string('username', 50); 
            $table->string('password', 255);
            $table->enum('userType', ['Admin', 'Librarian', 'Patron'])->default('Patron');
            $table->timestamps();
        });
        
                // Inserting data
                $data = [
                    [
                        'userImg' => '1695522026-me1-removebg-preview.png',
                        'firstname' => 'Justine Mark',
                        'middlename' => 'Ramos',
                        'lastname' => 'Taga-an',
                        'gender' => 'Male',
                        'birthdate' => '2002-06-22',
                        'email' => 'tagaanjustinemark5@gmail.com',
                        'phoneNo' => '09055757460',
                        'current_address' => 'Zamora Corner Abanil Street, 50th Barangay',
                        'city' => 'Ozamiz City',
                        'province' => 'Misamis Occidental',
                        'zipcode' => '7200',
                        'username' => 'admin',
                        'password' => '123',
                        'userType' => 'Admin',
                        'created_at' => now(),
                        'updated_at' => now()
                    ],
                    [
                        'userImg' => '1685364068-happy.jpg',
                        'firstname' => 'Lloyd Clarence',
                        'middlename' => 'Dela Cuesta',
                        'lastname' => 'Maquiling',
                        'gender' => 'Male',
                        'birthdate' => '2001-05-08',
                        'email' => 'lloyd@gmail.com',
                        'phoneNo' => '0912345',
                        'current_address' => 'P-6, Barangay Villa',
                        'city' => 'Ozamiz City',
                        'province' => 'Misamis Occidental',
                        'zipcode' => '7200',
                        'username' => 'lloyd',
                        'password' => '123',
                        'userType' => 'Patron',
                        'created_at' => now(),
                        'updated_at' => now()
                    ],
                    [
                        'userImg' => '1681025175-mike.jpg',
                        'firstname' => 'Jan Mike',
                        'middlename' => '',
                        'lastname' => 'Butnande',
                        'gender' => 'Male',
                        'birthdate' => '2001-12-25',
                        'email' => 'janmikey@gmail.com',
                        'phoneNo' => '09123456789',
                        'current_address' => 'Airport Street, Barangay Labo',
                        'city' => 'Ozamiz City',
                        'province' => 'Misamis Occidental',
                        'zipcode' => '7200',
                        'username' => 'janmikey',
                        'password' => '123',
                        'userType' => 'Patron',
                        'created_at' => now(),
                        'updated_at' => now()
                    ],
                    [
                        'userImg' => '1685313088-kap.jpg',
                        'firstname' => 'Ruxe',
                        'middlename' => 'Enquilino',
                        'lastname' => 'Pasok',
                        'gender' => 'Male',
                        'birthdate' => '2001-07-04',
                        'email' => 'ruxepasok@gmail.com',
                        'phoneNo' => '09123456789',
                        'current_address' => 'P-3, Tinago',
                        'city' => 'Ozamiz City',
                        'province' => 'Misamis Occidental',
                        'zipcode' => '7200',
                        'username' => 'ruxe',
                        'password' => 'asd',
                        'userType' => 'Patron',
                        'created_at' => now(),
                        'updated_at' => now()
                    ],
                    [
                        'userImg' => '1681025839-lods.jpg',
                        'firstname' => 'Adelle',
                        'middlename' => 'Pabriga',
                        'lastname' => 'Andales',
                        'gender' => 'Female',
                        'birthdate' => '2003-05-30',
                        'email' => 'adellepabriga@gmail.com',
                        'phoneNo' => '09123456789',
                        'current_address' => 'P-Mauswagon, Maningcol Highway',
                        'city' => 'Ozamiz City',
                        'province' => 'Misamis Occidental',
                        'zipcode' => '7200',
                        'username' => 'adelle',
                        'password' => '123',
                        'userType' => 'Librarian',
                        'created_at' => now(),
                        'updated_at' => now()
                    ],
                    [
                        'userImg' => '1687503563-fr.jfif',
                        'firstname' => 'Francille',
                        'middlename' => 'C',
                        'lastname' => 'Mapagdalita',
                        'gender' => 'Female',
                        'birthdate' => '2001-11-26',
                        'email' => 'francillemapagdalita@gmail.com',
                        'phoneNo' => '09622542572',
                        'current_address' => 'P-1 Calabayan Ozamiz City',
                        'city' => 'Ozamiz City',
                        'province' => 'Misamis Occidental',
                        'zipcode' => '7200',
                        'username' => 'Franciang',
                        'password' => '12345',
                        'userType' => 'Patron',
                        'created_at' => now(),
                        'updated_at' => now()
                    ],
                ];
                DB::table('accounts')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
