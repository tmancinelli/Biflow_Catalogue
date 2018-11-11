<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the Modern edition class.
 *
 * @ApiResource
 * @ORM\Entity
 */
class Edition
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
     * @var expression The expression this manuscript belongs to.
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Expression", inversedBy="editions")
     */
    public $expression;

    /**
     * @var string The title of this edition.
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $title;

    /**
     * @var The editor of this edition.
     * @Assert\NotNull
     * @ORM\Column(type="text", options={"default":""})
     */
    public $editor = '';

    /**
     * @var The date of this edition.
     * @Assert\NotNull
     * @ORM\Column(type="integer")
     */
    public $date;

    /**
     * @var Publisher of this edition.
     * @Assert\NotNull
     * @ORM\Column(type="text", options={"default":""})
     */
    public $publisher = '';

    /**
     * @var Note the note of this edition
     * @ORM\Column(type="text", options={"default":""})
     */
    public $note = '';
  
    public function getId(): int
    {
        return $this->id;
    }
}
