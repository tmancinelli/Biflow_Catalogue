<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints\RangeDate;
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
 *     },
 *     attributes={"order"={"name": "ASC"}}
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
     * @RangeDate
     * @ORM\Column(type="string", options={"default":""})
     */
    public $dateBirth = "";

     /**
      * @var \DateInterface The date of death
      *
      * @RangeDate
      * @ORM\Column(type="string", options={"default":""})
      */
    public $dateDeath = "";

    /**
     * @var Works[] Created works
     * 
     * @ORM\OneToMany(targetEntity="Work", mappedBy="author")
     */
    public $works;

    /**
     * @var Attributed Works the list of the works attributed to this person
     * @ORM\OneToMany(targetEntity="WorkAttribution", mappedBy="attribution")
     */
    public $attributedWorks;

    /**
     * @var Attributed Expressions the list of the expressions attributed to this person
     * @ORM\OneToMany(targetEntity="ExpressionAttribution", mappedBy="attribution")
     */
    public $attributedExpressions;

    /**
     * @var Translations[] Translated expressions
     * 
     * @ORM\OneToMany(targetEntity="Expression", mappedBy="translator")
     */
    public $translations;

    /**
     * @var Codices[] Localisation codices
     * 
     * @ORM\OneToMany(targetEntity="Localisation", mappedBy="copyist")
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
