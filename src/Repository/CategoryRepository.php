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
        $sql = "Select * FROM author WHERE id = " . $id;

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $authorinfo = $statement->fetch();

        return $this->hydrate($authorinfo);
    }


    private function hydrate(array $data): Category
    {
        $category = new Category();
        $category
            ->setId($data['id'])
            ->setTitle($data['title']);

        return $category;
    }

    public function update(Category $author)
    {
        $sql = "UPDATE author SET name = :name WHERE id = :id";

        $statement = $this->connection->prepare($sql);
        if($statement->execute(array(
            'name' => $author->getTitle(),
            'id' => $author->getId(),
        ))) {
            return 1;
        } else {
            return 0;
        }
    }


    public function delete(Category $author)
    {
        $sql = "DELETE FROM author WHERE id = :id";

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