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
     * @return Product
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
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
     * @return Product
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
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
     * @return Product
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateRelease(): string
    {
        $dt = DateTime::createFromFormat('Y-m-d H:i:s', $this->dateRelease);
        return $dt->format('m-d-Y');
    }

    /**
     * @param string $dateRelease
     * @return Product
     */
    public function setDateRelease(string $dateRelease): self
    {
        $this->dateRelease = $dateRelease;
        return $this;
    }


}