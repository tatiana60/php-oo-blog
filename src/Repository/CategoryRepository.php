<?php


namespace Repository;

use Entity\Category;
use PDO;


class CategoryRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $sql = "Select * FROM category";

        $statement = $this->connection->query($sql);

        $categories = [];

        while (false !== $data = $statement->fetch()) {
            $categories[] = $this->hydrate($data);
        }

        return $categories;
    }

    public function findOneById(int $id): ?Category
    {
        $sql = "Select * FROM category WHERE id = " . $id;

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        if(false !== $data = $statement->fetch()) {
            return $this->hydrate($data);
        }

        return NULL;
    }


    private function hydrate(array $data): Category
    {
        $category = new Category();
        $category
            ->setId($data['id'])
            ->setTitle($data['title']);

        return $category;
    }

    public function update(Category $category)
    {
        $sql = "UPDATE category SET title = :name WHERE id = :id";

        $statement = $this->connection->prepare($sql);
        if($statement->execute(array(
            'name' => $category->getTitle(),
            'id' => $category->getId(),
        ))) {
            return 1;
        } else {
            return 0;
        }
    }


    public function delete(Category $author)
    {
        $sql = "DELETE FROM category WHERE id = :id";

        $statement = $this->connection->prepare($sql);
        if($statement->execute(array(
            'id' => $author->getId(),
        ))) {
            return 1;
        } else {
            return 0;
        }
    }
}