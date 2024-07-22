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
        Schema::create('authors', function (Blueprint $table) {
            $table->bigIncrements('authorID'); // Use bigIncrements for auto-incrementing primary key
            $table->string('ISBN', 50);
            $table->text('author_fullname');
            $table->timestamps();
            $table->foreign('ISBN')->references('ISBN')->on('books')->onDelete('cascade');
        });
        $data = [
            [
                'ISBN' => '979-8664653403',
                'author_fullname' => 'Alex Xu',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780596004651',
                'author_fullname' => 'Kathy Siera, Bert Bates',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9781118008188',
                'author_fullname' => 'Jon Duckett',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9781784163068',
                'author_fullname' => 'Hannah Fry',  
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '054564951X',
                'author_fullname' => 'Eric Litwin', 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '0805092447',
                'author_fullname' => 'Bill Martin Jr',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '059035342X',
                'author_fullname' => 'J.K. Rowling',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780723247708',
                'author_fullname' => 'Beatrix Potter',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780439691420',
                'author_fullname' => 'Geronimo Stilton', 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9781779500199',
                'author_fullname' => 'Mark Waid',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9781302914233',
                'author_fullname' => 'Steve Englehart',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9781591161783',
                'author_fullname' => 'Masashi Kishimoto',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '0545560217',
                'author_fullname' => 'Geronimo Stilton',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9781015422551',
                'author_fullname' => 'Lyman Frank', 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780606365000',
                'author_fullname' => 'Erin Hunter', 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780064403849',
                'author_fullname' => 'Jean Little',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780345803481',
                'author_fullname' => 'Erika Leonard née Mitchell James',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780751540482',
                'author_fullname' => 'Nicholas Sparks',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780048232298',
                'author_fullname' => 'J.R.R. Tolkien',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9781338334920',
                'author_fullname' => 'Suzanna Collins',
                'created_at' => now(),
                'updated_at' => now()  
            ],
            [
                'ISBN' => '9780134671796',
                'author_fullname' => 'Donald Knuth',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780142424179',
                'author_fullname' => 'John Green',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '0446676098',
                'author_fullname' => 'Nicholas Sparks',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '1442426713',
                'author_fullname' => 'Jenny Han',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '123hi1k1',
                'author_fullname' => 'mark benedik',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '34',
                'author_fullname' => 'sdf',
                'created_at' => now(),
                'updated_at' => now() 
            ]
        ];
        
        DB::table('authors')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
