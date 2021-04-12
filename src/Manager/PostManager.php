<?php



namespace Manager;

use Entity\Post;
use PDO;

class PostManager
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insert(Post $post)
    {
        $sql =
            'INSERT INTO post(category_id, author_id, title, content, date) ' .
            'VALUES (:category, :author, :title, :content, :date)';

        $insert = $this->connection->prepare($sql);

        $insert->execute([
            'category' => $post->getCategory()->getId(),
            'author'   => $post->getAuthor()->getId(),
            'title'    => $post->getTitle(),
            'content'  => $post->getContent(),
            'date'     => $post->getDate()->format('Y-m-d'), // 2021-04-09
        ]);

        // Met à jour l'identifiant
        $post->setId($this->connection->lastInsertId());
    }

    public function update(Post $post)
    {
        $sql = "UPDATE post SET title = :name, content = :cont, category_id = :cate, author_id = :auth, date = :dat  WHERE id = :id";

        $statement = $this->connection->prepare($sql);
        if($statement->execute(array(
            'name' => $post->getTitle(),
            'cont' => $post->getContent(),
            'cate' => $post->getCategory()->getId(),
            'auth' => $post->getAuthor()->getId(),
            'dat' => $post->getDate()->format('Y-m-d'),
            'id' => $post->getId(),
        ))) {
            return 1;
        } else {
            return 0;
        }
    }

    public function delete(Post $post)
    {
        $sql = "DELETE FROM post WHERE id = :id";

        $statement = $this->connection->prepare($sql);
        if($statement->execute(array(
            'id' => $post->getId(),
        ))) {
            return 1;
        } else {
            return 0;
        }
    }
}