<?php

namespace App\Model\Entity;

use AbstractEntity;
use Product;
use User;

class Comment extends AbstractEntity
{
    private string $content;
    private User $author;
    private Product $product;


    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    /**
     * @return product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(\Product $product): void
    {
        $this->product = $product;
    }

}