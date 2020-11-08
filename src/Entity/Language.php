<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the Language class. It defines the language used in a version of a text.
 * This class comprises the natural languages in the sense of concepts. It describes the definition of the language introduced by the editor and a more general codes, such as those defined in ISO 639:1988. 
 * ontology-equivalentClass current:E56_Language
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
 *     attributes={"order"={"language": "ASC"}}
 * )
 * @ORM\Entity
 * @UniqueEntity("language")
 */
class Language
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
     * @var string The language
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $language;

    /**
     * @var expressions The list of expressions of this tradition.
     * @ORM\OneToMany(targetEntity="Expression", mappedBy="language")
     * -ontology-range &biflow;Expression
     */
    public $expressions;

    /**
     * @var expressions The list of expressions with multi-language texts.
     * @ORM\ManyToMany(targetEntity="Expression", mappedBy="otherLanguages")
     * -ontology-range &biflow;Expression
     */
    public $otherExpressions;

    public function __construct() {
        $this->expressions = new ArrayCollection();
        $this->otherExpressions = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
