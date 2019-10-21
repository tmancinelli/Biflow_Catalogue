<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the Library class.
 *
 * @ontology-comment This class defines a library which is the place where manuscripts are preserved.
 * 
 * @ontology-subClassOf &current;E53_Place
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
 *     attributes={"order"={"libraryCode": "ASC"}}
 * )
 * @ORM\Entity
 * @UniqueEntity(fields={"libraryName", "city"})
 * @UniqueEntity("libraryCode")
 */
class Library
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
     * @var string The city where the library is
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ontology-comment The city where the library is located
     * @ontology-equivalentProperty &current;P53i_is_former_or_current_location_of
     * @ontology-range &current;E53_Place
     * @ontology-name has_city
     */
    public $city;

    /**
     * @var string The library name
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ontology-comment The library's name
     * @ontology-equivalentProperty &current;P1_is_identified_by
     * @ontology-range &current;E41_Appellation
     * @ontology-name has_library_name
     */
    public $libraryName;

    /**
     * @var string The library identification number
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     * @ontology-comment The library's code
     * @ontology-equivalentProperty &current;P1_is_identified_by
     * @ontology-range &current;E42_Identifier
     * @ontology-name has_library_code
     */
    public $libraryCode;

    /**
     * @var Manuscripts the list of the manuscripts in this library
     * @ORM\OneToMany(targetEntity="Manuscript", mappedBy="library")
     * @ontology-range &biflow;Manuscript
     * @ontology-name has_manuscript
     * @ontology-comment The library preserves the manuscript
     */
    public $manuscripts;
    
    public function __construct() {
        $this->manuscripts = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
