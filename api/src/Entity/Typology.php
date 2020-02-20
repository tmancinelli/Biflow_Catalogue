<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the Typology class.
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
 *     attributes={"order"={"typology": "ASC"}}
 * )
 * @ORM\Entity
 * @UniqueEntity("typology")
 *
 */
class Typology
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
     * @var string The typology of a manuscript
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $typology;

    /**
     * @var Manuscripts the typologies of a manuscript
     * @ORM\OneToMany(targetEntity="Manuscript", mappedBy="typology")
     * -ontology-name is_typology_of
     * -ontology-range &biflow;Manuscript
     * -ontology-inverseOf &biflow;has_typology
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
