<?php

class Product
{
    private int $id;
    private string $name;
    private string $content;
    private string $dateRelease;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

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
     * @return string
     */
    public function getDateRelease(): string
    {
        return $this->dateRelease;
    }

    /**
     * @param string $dateRelease
     */
    public function setDateRelease(string $dateRelease): void
    {
        $this->dateRelease = $dateRelease;
    }


}