<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the Person class.
 *
 * @ApiResource(
 *     collectionOperations={
 *         "get",
 *         "post"={"access_control"="is_granted('ROLE_ADMIN')"}
 *     },
 *      itemOperations={
 *         "get",
 *         "put"={"access_control"="is_granted('ROLE_ADMIN')"},
 *         "delete"={"access_control"="is_granted('ROLE_ADMIN')"}
 *     }
 * )
 * @ORM\Entity
 */
class Person
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
     * @var string The name
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $name;

    /**
     * @var \DateInterface The date of birth
     *
     * @ORM\Column(type="date_immutable")
     */
    public $dateBirth;

     /**
      * @var \DateInterface The date of death
      *
      * @ORM\Column(type="date_immutable")
      */
    public $dateDeath;

    /**
     * @var Works[] Created works
     * 
     * @ORM\OneToMany(targetEntity="Work", mappedBy="author")
     */
    public $works;

    /**
     * @var Translations[] Translated expressions
     * 
     * @ORM\OneToMany(targetEntity="Expression", mappedBy="translator")
     */
    public $translations;

    /**
     * @var Codices[] Manuscript codices
     * 
     * @ORM\OneToMany(targetEntity="Manuscript", mappedBy="copyist")
     */
    public $codices;

    /**
     * @var Nicknames[] the nicknames for this person
     *
     * @ORM\OneToMany(targetEntity="Nickname", mappedBy="person")
     */
    public $nicknames;

    public function __construct() {
        $this->works = new ArrayCollection();
        $this->translations = new ArrayCollection();
        $this->codices = new ArrayCollection();
        $this->nicknames = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
