<?php


namespace Entity;


class Category
{
    private ?int $id = NULL;
    private ?string $title = NULL;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function setId(?int $id): Category
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $name): Category
    {
        $this->title = $name;

        return $this;
    }

}