<?php


namespace Manager;


use Entity\Author;
use PDO;

class AuthorManager
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insert(Author $author) {
        $author_name = $author->getName();
        $insert = $this->connection->prepare("INSERT INTO author (name) VALUES (:name)");
        $insert->bindParam(':name', $author_name);

        $insert->execute();
    }
}