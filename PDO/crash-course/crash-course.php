<?php

    // PDO Crash Course (PHP) by Traversy

    // db vars
    $host = 'localhost';
    $user = 'kevin';
    $password = 'test1234';
    $dbname = 'pdo_crash_course';

    // set DSN (data source name)
    $dsn = 'mysql:host='.$host.';dbname='.$dbname;

    // create PDO instance
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    // PDO QUERY

    // $stmt = $pdo->query('SELECT * FROM posts');

    // // formated as an associative array
    // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //     echo $row['title'].'<br/>';
    // }

    // // formated as an object
    // while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    //     echo $row->title.'<br/>';
    // }

    // set a default ($pdo->setAttribute) before so we don't have to always specify a fetch method
    // nb: we can override the default
    // while ($row = $stmt->fetch()) {
    //     echo $row->title.'<br/>';
    // }

    // PREPARED STATEMENTS
    // prepared statement separate the instruction from the data

    // unsafe way (where $author var comes form a form), gives an oportunity for sql insertions
    // $sql = "SELECT * FROM posts WHERE author = '$author' ";

    // FETCH POSTS with prepared statements

    // user data gotten from a form
    $author = 'kevin';
    $is_published = true;
    $id = 1;
    // // using positional parameters (the ?)
    // // nb: order of positional parameters is sensitive
    // $sql = 'SELECT * FROM posts WHERE author = ?';
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute([$author]);
    // $posts = $stmt->fetchall(); //nb: default of FETCH_OBJ was set before

    // // echo posts to the screen
    // // var_dump($posts);
    // foreach ($posts as $post) {
    //     echo $post->title.'<br/>';
    // }

    // // using named parameters
    // $sql = 'SELECT * FROM posts WHERE author = :author AND is_published= :is_published';
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute([
    //     'author' => $author,
    //     'is_published' => $is_published,
    // ]);
    // $posts = $stmt->fetchall(); //nb: default of FETCH_OBJ was set before

    // // echo posts to the screen
    // // var_dump($posts);
    // foreach ($posts as $post) {
    //     echo $post->title.'<br/>';
    // }

    // //  FECTH SINGLE POST
    // $sql = 'SELECT * FROM posts WHERE id = :id';
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute(['id' => $id]);
    // $post = $stmt->fetch(); //nb: default of FETCH_OBJ was set before
    // echo $post->body;

    // // GET ROW COUNT
    // $stmt = $pdo->prepare('SELECT * FROM posts WHERE author = ?');
    // $stmt->execute(([$author]));
    // $postCount = $stmt->rowCount();
    // echo $postCount;

    // // INSERT DATA (coming from a form)
    // $title = 'NEW POST';
    // $body = 'This is a new post from php';
    // $author = 'kevin';

    // $sql = 'INSERT INTO posts(title, body, author) VALUES(:title, :body,:author)';
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute([
    //     'title' => $title,
    //     'body' => $body,
    //     'author' => $author,
    // ]);
    // echo 'Post Added';

    // // UPDATE DATA (coming from a form)
    // $id = 1;
    // $body = 'This is a the updated post from php';

    // $sql = 'UPDATE posts SET body = :body WHERE id = :id';
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute([
    //     'id' => $id,
    //     'body' => $body,
    // ]);
    // echo 'Post Updated';

    // // DELETE DATA
    // $id = 2;

    // $sql = 'DELETE FROM posts WHERE id = :id';
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute(['id' => $id]);
    // echo 'Post Deleted';

    // SEARCH DATA
    // search for posts with 'three' in the title
    $search = '%three%';

    $sql = 'SELECT * FROM posts WHERE title LIKE ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$search]);
    $posts = $stmt->fetchAll();
    foreach ($posts as $post) {
        echo $post->title.'<br>';
    }
