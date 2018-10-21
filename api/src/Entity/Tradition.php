<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the Tradition class. The tradition of a Expression.
 *
 * @ApiResource
 * @ORM\Entity
 * @UniqueEntity("tradition")
 */
class Tradition
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
     * @var string The tradition's name.
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $tradition;

    /**
     * @var expressions The list of expressions of this tradition.
     * @ORM\OneToMany(targetEntity="Expression", mappedBy="tradition")
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
