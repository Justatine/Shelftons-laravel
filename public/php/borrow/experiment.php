<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500&family=Petemoss&display=swap");

        * {
            box-sizing: border-box;
            /* font-family: "Cinzel", serif; */
        }

        body {
            margin: 0;
            padding: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        p {
            margin: 0;
        }

        main {
            display: flex;
            justify-content: center;
            background-color: #d9d9d9;
        }

        .book {
            justify-content: center;
            align-items: center;
            --book-height: 50vh;
            --book-ratio: 1.4;
            display: inline-block;
        }

        .book > div {
            height: var(--book-height);
            width: calc(var(--book-height) / var(--book-ratio));
            overflow: auto;
            background-color: #0a0a0a;
            transform: scale(0.9);
            border-radius: 6px;
            transform-origin: left;
        }

        .book-cover {
            /* background-image: url('bb.jpg'); 
            background-repeat: no-repeat;
            background-size: 100% 100%; */
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            z-index: 9;
            text-align: center;
            /* background: linear-gradient(135deg, black 25%, transparent 25%) -50px 0,
                linear-gradient(225deg, black 25%, transparent 25%) -50px 0,
                linear-gradient(315deg, black 25%, transparent 25%),
                linear-gradient(45deg, black 25%, transparent 25%); */
            background-size: 2em 2em;
            /* background-color: #232323; */
            color: white;
            transition: transform 2s;
        }

        .book-cover::before {
            content: "";
            position: absolute;
            width: 20px;
            right: 20px;
            top: 0;
            bottom: 0;
            /* background-color: #b11509; */
        }

        h1 {
            /* font-family: "Petemoss", cursive; */
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 20px;
            font-weight: 300;
            color: #dbd75d;
        }

        h2 {
            font-size: 16px;
        }

        .separator {
            --separator-size: 8px;
            width: var(--separator-size);
            height: var(--separator-size);
            background-color: #dbd75d;
            margin: 50px auto 60px auto;
            border-radius: 50%;
            position: relative;
        }

        .separator::after,
        .separator::before {
            content: "";
            position: absolute;
            width: 12px;
            background-color: white;
            height: 2px;
            top: calc(50% - 1px);
        }

        .separator::after {
            left: 15px;
        }

        .separator::before {
            right: 15px;
        }

        .book-content {
            transform: scale(0.9) translateY(30px);
            background-color: #eeeeef !important;
            transition: all 0.3s 1s;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .book-content h3,
        .book-content p {
            opacity: 0;
            transition: all 0.3s 0.3s;
        }

        h3 {
            padding: 30px;
        }

        p {
            padding: 0px 30px 10px 30px;
            text-align: justify;
            font-size: 14px;
        }

        .book-cover > div {
            transition: opacity 0s 0.6s;
        }

        .book:hover > .book-cover {
            transform: rotateY(180deg) scale(0.9);
        }

        .book:hover > .book-cover > div {
            opacity: 0;
        }

        .book:hover > .book-content {
            transform: scale(0.9) translateY(0px);
        }

        .book:hover > .book-content h3,
        .book:hover > .book-content p {
            opacity: 1;
        }
        
    </style>
</head>
<body>

        <div class="asdas" style="display: inline-block;  width:80%; height:100%; position: absolute; top: 0;left: 0; right: 0;bottom: 0;margin: auto; align-items: center; padding-left:80px;">
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $conn = mysqli_connect('localhost','root','','db_lms');
        $sql ="SELECT * FROM book INNER JOIN author ON book.ISBN = author.ISBN";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $isbn = $row['ISBN'];
                $title = $row['bookTitle'];
                $desc = $row['bookDesc'];
                $author = $row['author_fullname']; ?>
                <div class="book" style="text-align: center;">
                    <div class="book-cover" style="background-image: url('../books/book-imgs/<?php echo $row["bookImg"]; ?>');background-repeat: no-repeat;background-size: 100% 100%; ">
                        <div>
                            <!-- <div style="width:80%; margin:0 auto;">
                                <h1><?=$title; ?></h1>
                            </div> -->
                            <div class="separator"></div>
                            <!-- <h2><?=$author; ?></h2> -->
                        </div>
                    </div>
                    <div class="book-content">
                    <h3><?=$title; ?></h3>
                    <!-- <img width="50px" height="50px" src="../books/book-imgs/<?php echo $row["bookImg"]; ?>"/> -->
                        <p><?=$desc; ?></p>
                        <h3 style="text-align:center;"><u>Book information</u></h3>
                        <p>Author/s: <strong><?=$author; ?></strong</p>
                        <p>Publisher: <?=$row['publisher'];?></p>
                        <p>Publication year: <?= $row['yearPublished'];?></p>
                        <p>Replacement cost: <?= $row['replacementCost'];?></p>
                    </div>
                    <button>Borrow this book</button>
                </div>
<?php        }
        }

    ?>        
    </div>

</body>
</html>