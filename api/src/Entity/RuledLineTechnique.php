<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the RuledLineTechnique class.
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
 *     attributes={"order"={"ruledLineTechnique": "ASC"}}
 * )
 * @ORM\Entity
 * @UniqueEntity("ruledLineTechnique")
 *
 * -ontology-subClassOf &current;E57_RuledLineTechnique
 */
class RuledLineTechnique
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
     * @var string The ruledLineTechnique
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     * -ontology-name has_ruledLineTechnique_identifier
     */
    public $ruledLineTechnique;

    /**
     * @var Manuscripts the list of the manuscripts for this ruled line technique
     * @ORM\OneToMany(targetEntity="Manuscript", mappedBy="ruledLineTechnique")
     * -ontology-name is_ruled_line_technique_of
     * -ontology-range &biflow;Manuscript
     * -ontology-inverseOf &biflow;has_ruled_line_technique
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
