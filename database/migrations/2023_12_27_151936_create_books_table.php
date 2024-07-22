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
        Schema::create('books', function (Blueprint $table) {
            $table->string('ISBN', 50);
            $table->string('bookImg', 50);
            $table->string('bookTitle', 100);
            $table->text('bookDesc');
            $table->string('bookCat', 30);
            $table->string('publisher', 100);
            $table->string('yearPublished', 11);
            $table->dateTime('date_added')->default(now());
            $table->integer('popularity')->default(0);
            $table->decimal('replacementCost', 10, 2);
            $table->integer('stocks');

            $table->timestamps();
            $table->primary('ISBN');
        });
        $data = [
            [
                'ISBN' => '0446676098',
                'bookImg' => '1686577121-the notebook.jpg',
                'bookTitle' => 'The Notebook',
                'bookDesc' => 'Every so often a love story so captures our hearts that it becomes more than a story-it becomes an experience to remember forever. The Notebook is such a book. It is a celebration of how passion can be ageless and timeless, a tale that moves us to laughter and tears and makes us believe in true love all over again. At thirty-one, Noah Calhoun, back in coastal North Carolina after World War II, is haunted by images of the girl he lost more than a decade earlier. At twenty-nine, socialite Allie Nelson is about to marry a wealthy lawyer, but she cannot stop thinking about the boy who long ago stole her heart. Thus begins the story of a love so enduring and deep it can turn tragedy into triumph, and may even have the power to create a miracle.',
                'bookCat' => 'Romance',
                'publisher' => 'Grand Central Publishing',
                'yearPublished' => '1999',
                'date_added' => '2023-06-12 13:38:41',
                'popularity' => 0,
                'replacementCost' => '219.66',
                'stocks' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '0545560217',
                'bookImg' => '1681132462-the mouse and the hoax.jpg',
                'bookTitle' => 'Geronimo Stilton: Mini Mystery: #3 The Mouse Hoax',
                'bookDesc' => 'Geronimo and friends are invited to a hotel for a vacation. They are enjoying their stay when strange things start happening. Can Geronimo solve the mystery and save the day?',
                'bookCat' => 'Entertainment',
                'publisher' => 'Scholastic US',
                'yearPublished' => '2013',
                'date_added' => '2023-05-15 16:40:55',
                'popularity' => 6,
                'replacementCost' => '171.00',
                'stocks' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '054564951X',
                'bookImg' => '1681112986-pete the cat.jpg',
                'bookTitle' => 'Pete the Cat and his Four Groovy Buttons',
                'bookDesc' => 'Pete the cat loves the buttons on his shirt so much that he makes up a song about them, and even as the buttons pop off, one by one, he still finds a reason to sing.',
                'bookCat' => 'Kids',
                'publisher' => 'Scholastic',
                'yearPublished' => '2013',
                'date_added' => '2023-04-05 16:40:59',
                'popularity' => 2,
                'replacementCost' => '223.00',
                'stocks' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '059035342X',
                'bookImg' => '1681114245-harrypota.jpg',
                'bookTitle' => "Harry Potter and the Sorcerer's Stone",
                'bookDesc' => "Harry Potter has never been the star of a Quidditch team, scoring points while riding a broom far above the ground. He knows no spells, has never helped to hatch a dragon, and has never worn a cloak of invisibility. All he knows is a miserable life with the Dursleys, his horrible aunt and uncle, and their abominable son, Dudley - a great big swollen spoiled bully. Harry's room is a tiny closet at the foot of the stairs, and he hasn't had a birthday party in eleven years. But all that is about to change when a mysterious letter arrives by owl messenger: a letter with an invitation to an incredible place that Harry - and anyone who reads about him - will find unforgettable. For it's there that he finds not only friends, aerial sports, and magic in everything from classes to meals, but a great destiny that's been waiting for him... if Harry can survive the encounter.",
                'bookCat' => 'Kids',
                'publisher' => 'Arthur A. Levine Books',
                'yearPublished' => '1998',
                'date_added' => '2023-05-16 16:41:03',
                'popularity' => 1,
                'replacementCost' => '2720.00',
                'stocks' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '0805092447',
                'bookImg' => '1681113446-brown bear.jpg',
                'bookTitle' => 'Brown Bear, Brown Bear, What Do You See? My FIRST Reader',
                'bookDesc' => "Brown Bear, Brown Bear, What Do You See? is a children's picture book published in 1967. Written and illustrated by Bill Martin Jr. and Eric Carle, the book is designed to help toddlers associate colors and meanings to objects.",
                'bookCat' => 'Kids',
                'publisher' => 'Holt & Company, Henry',
                'yearPublished' => '2010',
                'date_added' => '2023-05-10 16:41:07',
                'popularity' => 1,
                'replacementCost' => '223.00',
                'stocks' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '123hi1k1',
                'bookImg' => '1688026722-logo.png',
                'bookTitle' => 'huhu',
                'bookDesc' => 'huhu',
                'bookCat' => 'Fiction',
                'publisher' => 'ahsd',
                'yearPublished' => '1990',
                'date_added' => '2023-06-29 08:17:53',
                'popularity' => 0,
                'replacementCost' => '2.00',
                'stocks' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '1442426713',
                'bookImg' => '1686577393-tatbilb.jpg',
                'bookTitle' => 'To All the Boys I’ve Loved Before (1)',
                'bookDesc' => 'What if all the crushes you ever had found out how you felt about them...all at once? Sixteen-year-old Lara Jean Song keeps her love letters in a hatbox her mother gave her. They aren’t love letters that anyone else wrote for her; these are ones she’s written. One for every boy she’s ever loved—five in all. When she writes, she pours out her heart and soul and says all the things she would never say in real life, because her letters are for her eyes only. Until the day her secret letters are mailed, and suddenly, Lara Jean’s love life goes from imaginary to out of control.',
                'bookCat' => 'Romance',
                'publisher' => 'Simon & Schuster Books for Young Readers',
                'yearPublished' => '2016',
                'date_added' => '2023-06-12 13:43:13',
                'popularity' => 0,
                'replacementCost' => '221.90',
                'stocks' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '34',
                'bookImg' => '1688056684-dog.jpg',
                'bookTitle' => 'sdf',
                'bookDesc' => 'sdf',
                'bookCat' => 'Entertainment',
                'publisher' => '1',
                'yearPublished' => '223',
                'date_added' => '2023-06-29 16:38:04',
                'popularity' => 0,
                'replacementCost' => '0.00',
                'stocks' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780048232298',
                'bookImg' => '1681135230-lordoftherings.jpg',
                'bookTitle' => 'The Lord of the Rings',
                'bookDesc' => 'It follows the journey of hobbit Frodo Baggins as he attempts to destroy the One Ring, an artifact created by the evil Lord Sauron. Along the way, Frodo and his companions encounter a variety of allies and enemies, including elves, dwarves, wizards, and orcs. The book is known for its intricate world-building, detailed characters, and epic battle scenes, and is considered a classic of the fantasy genre.',
                'bookCat' => 'Fiction',
                'publisher' => 'HarperCollins',
                'yearPublished' => '1983',
                'date_added' => '2023-05-13 16:41:10',
                'popularity' => 1,
                'replacementCost' => '215.00',
                'stocks' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780064403849',
                'bookImg' => '1681133457-here i am.jpg',
                'bookTitle' => 'Hey World, Here I Am!',
                'bookDesc' => 'Who does not know she is alive. Outspoken, funny, sometimes confused but always observant, Kate is writing it all down-Hey World, Here I Am!',
                'bookCat' => 'Entertainment',
                'publisher' => 'Harpercollins (USA), Harpercollins publishers Inc',
                'yearPublished' => '1998',
                'date_added' => '2023-05-13 16:41:13',
                'popularity' => 0,
                'replacementCost' => '848.00',
                'stocks' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780134671796',
                'bookImg' => '1681135847-artofcomputerprog.png',
                'bookTitle' => 'The Art of Computer Programming',
                'bookDesc' => 'This multivolume work on the analysis of algorithms has long been recognised as the definitive bookDesc of classical computer science. The four volumes published to date already comprise a unique and invaluable resource in programming theory and practice. Countless readers have spoken about the profound personal influence of Knuth’s writings. Scientists have marvelled at the beauty and elegance of his analysis, while practicing programmers have successfully applied his cookbook solutions to their day-to-day problems.',
                'bookCat' => 'Computer & Techs',
                'publisher' => 'Pearson Education (US)',
                'yearPublished' => '2020',
                'date_added' => '2023-05-13 16:41:22',
                'popularity' => 0,
                'replacementCost' => '1868.00',
                'stocks' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780142424179',
                'bookImg' => '1686576852-tfios.jpg',
                'bookTitle' => 'The Fault in Our Stars',
                'bookDesc' => 'Despite the tumor-shrinking medical miracle that has bought her a few years, Hazel has never been anything but terminal, her final chapter inscribed upon diagnosis. But when a gorgeous plot twist named Augustus Waters suddenly appears at Cancer Kid Support Group, Hazel’s story is about to be completely rewritten.',
                'bookCat' => 'Romance',
                'publisher' => 'Penguin Books',
                'yearPublished' => '2014',
                'date_added' => '2023-06-12 13:34:12',
                'popularity' => 3,
                'replacementCost' => '215.79',
                'stocks' => 54,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780345803481',
                'bookImg' => '1681134353-50shades.jpg',
                'bookTitle' => 'Fifty Shades of Grey',
                'bookDesc' => 'When literature student Anastasia Steele goes to interview young entrepreneur Christian Grey, she encounters a man who is beautiful, brilliant, and intimidating...',
                'bookCat' => 'Romance',
                'publisher' => 'Fifty Shades Ltd.',
                'yearPublished' => '2012',
                'date_added' => '2023-05-13 16:41:24',
                'popularity' => 0,
                'replacementCost' => '419.00',
                'stocks' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780439691420',
                'bookImg' => '1681130940-my name is stilton.jpg',
                'bookTitle' => 'Geronimo Stilton: #19 My Name Is Stilton, Geronimo Stilton',
                'bookDesc' => 'Geronimo Stilton tells how Pinky Pick, his assistant editor, came to work for him.',
                'bookCat' => 'Kids',
                'publisher' => 'Scholastic US',
                'yearPublished' => '2005',
                'date_added' => '2023-05-13 16:41:26',
                'popularity' => 0,
                'replacementCost' => '527.00',
                'stocks' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780596004651',
                'bookImg' => '1681111883-headsfirstjava.jpg',
                'bookTitle' => 'Head First Java',
                'bookDesc' => 'Head First Java is referred to as the Java programming bible by most readers and is probably the best Java book for beginners...',
                'bookCat' => 'Computer & Techs',
                'publisher' => 'Oreilly, INC International Concepts, USA',
                'yearPublished' => '2003',
                'date_added' => '2023-05-13 16:41:28',
                'popularity' => 0,
                'replacementCost' => '5500.00',
                'stocks' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780606365000',
                'bookImg' => '1681133313-midnight1.jpg',
                'bookTitle' => 'Midnight (Warriors: The New Prophecy #1)',
                'bookDesc' => 'The wild cats of the forest have lived in peace and harmony for many moons--but now, strange messages from their warrior ancestors speak of terrifying new prophecies and a mysterious danger. All the signs point to young warrior Brambleclaw as the cat with the fate of the forest in his paws...',
                'bookCat' => 'Entertainment',
                'publisher' => 'Turtleback Books',
                'yearPublished' => '2015',
                'date_added' => '2023-05-13 16:41:30',
                'popularity' => 0,
                'replacementCost' => '231.00',
                'stocks' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780723247708',
                'bookImg' => '1681130581-Peter_Rabbit_first_edition_1902a.jpg',
                'bookTitle' => 'The Tale of Peter Rabbit',
                'bookDesc' => 'The Tale of Peter Rabbit is a children\'s book written and illustrated by Beatrix Potter that follows mischievous and disobedient young Peter Rabbit as he gets into, and is chased around, the garden of Mr. McGregor. He escapes and returns home to his mother, who puts him to bed after offering him chamomile-tea.',
                'bookCat' => 'Kids',
                'publisher' => 'Warne',
                'yearPublished' => '2002',
                'date_added' => '2023-05-13 16:41:32',
                'popularity' => 0,
                'replacementCost' => '500.00',
                'stocks' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9780751540482',
                'bookImg' => '1681134519-walk.jpg',
                'bookTitle' => 'A Walk to Remember',
                'bookDesc' => 'There was a time when the world was sweeter...when the women in Beaufort, North Carolina, wore dresses, and the men donned hats...when something happened to a seventeen-year-old boy that would change his life forever. Every April, when the wind blows in from the sea and mingles with the scent of lilacs, Landon Carter remembers his last year at Beaufort High. It was 1958, and Landon had already dated a girl or two. He even swore that he had once been in love. Certainly the last person in town he thought he would fall for was Jamie Sullivan, the daughter of the town\'s Baptist minister. A quiet girl who always carried a Bible with her schoolbooks, Jamie seemed content living in a world apart from the other teens. She took care of her widowed father, rescued hurt animals, and helped out at the local orphanage. No boy had ever asked her out. Landon would never have dreamed of it. Then a twist of fate made Jamie his partner for the homecoming dance, and Landon Carter\'s life would never be the same. Being with Jamie would show him the depths of the human heart and lead him to a decision so stunning it would send him irrevocably on the road to manhood. No other author today touches our emotions more deeply than Nicholas Sparks. Illuminating both the strength and the gossamer fragility of our deepest emotions, his two New York Times bestsellers, The Notebook and Message in a Bottle, have established him as the leading author of today\'s most cherished love stories. Now, in A Walk to Remember, he tells a truly unforgettable story, one that glimmers with all of his magic, holding us spellbound-and reminding us that in life each of us may find one great love, the kind that changes everything.',
                'bookCat' => 'Romance',
                'publisher' => 'Little, Brown Book Group',
                'yearPublished' => '2007',
                'date_added' => '2023-05-13 16:41:33',
                'popularity' => 5,
                'replacementCost' => '500.00',
                'stocks' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9781015422551',
                'bookImg' => '1681132763-wonderful wiz of oz.jpg',
                'bookTitle' => 'The Wonderful Wizard of Oz',
                'bookDesc' => 'After a cyclone transports her to the land of Oz, Dorothy must seek out the great wizard in order to return to Kansas.',
                'bookCat' => 'Entertainment',
                'publisher' => 'Legare Street Press',
                'yearPublished' => '1900',
                'date_added' => '2023-05-13 16:41:35',
                'popularity' => 1,
                'replacementCost' => '1000.00',
                'stocks' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9781118008188',
                'bookImg' => '1681112385-htmlandcss.jpg',
                'bookTitle' => 'HTML & CSS: Design and Build Web Sites',
                'bookDesc' => 'A full-color introduction to the basics of HTML and CSS. Every day, more and more people want to learn some HTML and CSS. Joining the professional web designers and programmers are new audiences who need to know a little bit of code at work (update a content management system or e-commerce store) and those who want to make their personal blogs more attractive.',
                'bookCat' => 'Computer & Techs',
                'publisher' => 'John Wiley & Sons INC International Concepts',
                'yearPublished' => '2011',
                'date_added' => '2023-05-13 16:41:37',
                'popularity' => 0,
                'replacementCost' => '6000.00',
                'stocks' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9781302914233',
                'bookImg' => '1681131944-avengers.jpg',
                'bookTitle' => 'Avengers West Coast Epic Collection: How the West Was Won',
                'bookDesc' => 'Earth\'s Mightiest Heroes go West! When Vision creates a second squad, Hawkeye grabs the first Quinjet to California to lead the West Coast Avengers — including Mockingbird, Wonder Man, Tigra and an Iron Man or two! But will local vigilante the Shroud join the West Coasters? How about Firebird, Hank "Ant-Man" Pym and the Ever-Lovin Blue-Eyed Thing! The "Whackos" quickly make their own enemies — including the Blank, Graviton, Master Pandemonium and a villainous Goliath! Plus: Kraven the Hunter targets Tigra! Wonder Man battles Sandman! And Vision and Scarlet Witch lend a hand against the Grim Reaper and Ultron!',
                'bookCat' => 'Fiction',
                'publisher' => 'Marvel Comics',
                'yearPublished' => '2018',
                'date_added' => '2023-05-13 16:41:39',
                'popularity' => 0,
                'replacementCost' => '1632.00',
                'stocks' => 16,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9781338334920',
                'bookImg' => '1681135581-hungergames.jpg',
                'bookTitle' => 'Hunger Games',
                'bookDesc' => 'The story is set in the nation of Panem, which is divided into twelve districts, each of which is forced to send one teenage boy and one teenage girl to compete in the annual Hunger Games, a televised fight to the death in which only one tribute can emerge victorious. The story is narrated by Katniss Everdeen, a sixteen-year-old girl from District 12 who volunteers to take her younger sister’s place in the Games. Along with her fellow tribute Peeta Mellark, Katniss must use her skills and wits to survive the deadly challenges of the arena, while also navigating the complex politics and propaganda of the Capitol, the ruling city of Panem.',
                'bookCat' => 'Entertainment',
                'publisher' => 'Scholastic, Incorporated',
                'yearPublished' => '2018',
                'date_added' => '2023-05-13 16:41:40',
                'popularity' => 0,
                'replacementCost' => '1496.00',
                'stocks' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9781591161783',
                'bookImg' => '1681132203-naruto2.jpg',
                'bookTitle' => 'Naruto, Vol. 2',
                'bookDesc' => 'Naruto is a ninja-in-training...',
                'bookCat' => 'Fiction',
                'publisher' => 'VIZ Media',
                'yearPublished' => '2007',
                'date_added' => '2023-05-13 16:41:45',
                'popularity' => 0,
                'replacementCost' => '642.00',
                'stocks' => 8,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9781779500199',
                'bookImg' => '1681131516-flash.jpg',
                'bookTitle' => 'The Flash',
                'bookDesc' => 'In this next graphic novel cha...',
                'bookCat' => 'Fiction',
                'publisher' => 'DC Comics',
                'yearPublished' => '2020',
                'date_added' => '2023-05-13 16:41:48',
                'popularity' => 2,
                'replacementCost' => '5300.00',
                'stocks' => 9,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '9781784163068',
                'bookImg' => '1681112667-helloworld.jpg',
                'bookTitle' => 'Hello World: How to be Human in the Age of the Machine',
                'bookDesc' => 'When it comes to AI, we only h...',
                'bookCat' => 'Computer & Techs',
                'publisher' => 'Transworld Ltd',
                'yearPublished' => '2019',
                'date_added' => '2023-05-13 16:41:50',
                'popularity' => 6,
                'replacementCost' => '5500.00',
                'stocks' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ISBN' => '979-8664653403',
                'bookImg' => '1681111350-systemdesigninterview.jpg',
                'bookTitle' => 'System Design Interview – An insider\'s guide',
                'bookDesc' => 'System design interviews are the most difficult to tackle of all technical interview questions. This book is Volume 1 of the System Design Interview - An insider’s guide series that provides a reliable strategy and knowledge base for approaching a broad range of system design questions. This book provides a step-by-step framework for how to tackle a system design question. It includes many real-world examples to illustrate the systematic approach, with detailed steps that you can follow.',
                'bookCat' => 'Computer & Techs',
                'publisher' => 'Independently published',
                'yearPublished' => '2017',
                'date_added' => '2023-05-13 16:41:51',
                'popularity' => 1,
                'replacementCost' => '5000.00',
                'stocks' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];        
        DB::table('books')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
