<?php


namespace Repository;

use Entity\Author;
use PDO;


class AuthorRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $sql = "Select id, name FROM author";

        $statement = $this->connection->query($sql);

        $authors = [];

        while (false !== $data = $statement->fetch()) {
            $authors[] = $this->hydrate($data);
        }

        return $authors;
    }

    public function findOneById(int $id): ?Author
    {
        $sql = "Select * FROM author WHERE id = " . $id;

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $authorinfo = $statement->fetch();

        return $this->hydrate($authorinfo);
    }


    private function hydrate(array $data): Author
    {
        $author = new Author();
        $author
            ->setId($data['id'])
            ->setName($data['name']);

        return $author;
    }

    public function update(Author $author)
    {
        $sql = "UPDATE author SET name = :name WHERE id = :id";

        $statement = $this->connection->prepare($sql);
        if($statement->execute(array(
            'name' => $author->getName(),
            'id' => $author->getId(),
        ))) {
            return 1;
        } else {
            return 0;
        }
    }


    public function delete(Author $author)
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