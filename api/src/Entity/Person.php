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
 * @ontology-equivalentClass &efrbroo;F10_Person
 * @ontology-equivalentClass &current;E21_Person
 * @ontology-subClassOf &current;E39_Actor
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
     * @ontology-name has_name
     * @ontology-equivalentProperty &current;P131_is_identified_by
     * @ontology-comment The name of the person
     * @ontology-range &current;E82_Actor_Appellation
     */
    public $name;

    /**
     * @var \DateInterface The date of birth
     *
     * @RangeDate
     * @ORM\Column(type="string", options={"default":""})
     * @ontology-range &biflow;Date
     * @ontology-name has_birth_date
     * @ontology-comment The date of birth
     */
    public $dateBirth = "";

    /**
     * @var \DateInterface The date of death
     *
     * @RangeDate
     * @ORM\Column(type="string", options={"default":""})
     * @ontology-range &biflow;Date
     * @ontology-name has_death_date
     * @ontology-comment The date of death
     */
    public $dateDeath = "";

    /**
     * @var Works[] Created works
     * 
     * @ORM\OneToMany(targetEntity="Work", mappedBy="author")
     * @ontology-name is_author_of
     * @ontology-range &biflow;Work
     * @ontology-comment This person is the author of that work
     */
    public $works;

    /**
     * @var Attributed Works the list of the works attributed to this person
     * @ORM\OneToMany(targetEntity="WorkAttribution", mappedBy="attribution")
     * @ontology-name has_been_considered_author_of
     * @ontology-range &biflow;Work
     * @ontology-comment This person has been considered the author of that work
     */
    public $attributedWorks;

    /**
     * @var Attributed Expressions the list of the expressions attributed to this person
     * @ORM\OneToMany(targetEntity="ExpressionAttribution", mappedBy="attribution")
     * @ontology-name has_been_considered_author_of
     * @ontology-range &biflow;Expression
     * @ontology-comment This person has been considered the author of that expression
     */
    public $attributedExpressions;

    /**
     * @var Translations[] Translated expressions
     * 
     * @ORM\OneToMany(targetEntity="Expression", mappedBy="translator")
     * @ontology-name is_translator_of
     * @ontology-range &biflow;Expression
     * @ontology-comment This person is the translator of that expression
     */
    public $translations;

    /**
     * @var Codices[] Localisation codices
     * 
     * @ORM\OneToMany(targetEntity="Localisation", mappedBy="copyist")
     * @ontology-name is_copyst_of
     * @ontology-range &biflow;Localisation
     * @ontology-comment This person is the copyst of the text
     */
    public $codices;

    /**
     * @var Nicknames[] the nicknames for this person
     *
     * @ORM\OneToMany(targetEntity="Nickname", mappedBy="person")
     * @ontology-name has_nickname
     * @ontology-equivalentProperty &current;P1_is_identified_by
     * @ontology-range &current;E41_Appellation
     * @ontology-comment The person is also known as
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
