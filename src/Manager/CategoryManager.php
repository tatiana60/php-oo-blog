<?php


namespace Manager;


use Entity\Category;
use PDO;

class CategoryManager
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insert(Category $category) {
        $category_title = $category->getTitle();
        $insert = $this->connection->prepare("INSERT INTO category (title) VALUES (:name)");
        $insert->bindParam(':name', $category_title);

        $insert->execute();
    }
}