<?php


namespace Repository;

use Entity\Post;
use PDO;
use DateTime;

class PostRepository
{
    /** @var PDO */
    private $connection;

    /** @var CategoryRepository */
    private $categoryRepository;

    /** @var AuthorRepository */
    private $authorRepository;


    public function __construct(
        PDO $connection,
        CategoryRepository $categoryRepository,
        AuthorRepository $authorRepository
    ) {
        $this->connection = $connection;
        $this->categoryRepository = $categoryRepository;
        $this->authorRepository = $authorRepository;
    }

    private function hydrate(array $data): Post
    {

        $date = new DateTime($data['date']);

        $category = $this
            ->categoryRepository
            ->findOneById($data['category_id']);

        $author = $this
            ->authorRepository
            ->findOneById($data['author_id']);

        $post = new Post();
        $post
            ->setId($data['id'])
            ->setCategory($category)
            ->setAuthor($author)
            ->setTitle($data['title'])
            ->setContent($data['content'])
            ->setDate($date);

        return $post;
    }

    public function findAll(): array
    {
        $sql = "Select * FROM post";

        $statement = $this->connection->query($sql);

        $posts = [];

        while (false !== $data = $statement->fetch()) {
            $posts[] = $this->hydrate($data);
        }

        return $posts;
    }

    public function findOneById(int $id): ?Post
    {
        $sql = 'SELECT * FROM post WHERE id=:id LIMIT 1';

        $statement = $this->connection->prepare($sql);

        $statement->execute([
            'id' => $id,
        ]);

        if (false !== $data = $statement->fetch()) {
            return $this->hydrate($data);
        }

        return null;
    }
}
