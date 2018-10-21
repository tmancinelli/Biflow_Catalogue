<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the Genre class.
 *
 * @ApiResource
 * @ORM\Entity
 * @UniqueEntity("genre")
 */
class Genre
{
    /**
     * @var int The entity Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string, The genre
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $genre;

    /**
     * @var Expressions the list of the expressions for this genre
     * @ORM\OneToMany(targetEntity="Expression", mappedBy="genre")
     */
    public $expressions;
    
    public function __construct() {
        $this->expressions = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
}