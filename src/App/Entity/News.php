<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Validation\NewsValidator;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 * @ORM\Table(name="news")
 */
class News
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=32)
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(name="content", type="text")
     * @var string
     */
    private $content;

    /**
     * Application constructor.
     * @param $name
     */
    public function __construct($title, $content)
    {
        $this->validator = new NewsValidator();
        $this->title = $title;
        $this->content = $content;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content
        ];
    }

    public function __get($name) {
        return $this->{$name};
    }
}