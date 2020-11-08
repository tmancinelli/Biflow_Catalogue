<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Validator\Constraints\RangeDate;

/**
 * This is the Work class. This class comprises distinct concepts or combinations of concepts identified in artistic and intellectual expressions, such as poems, stories or musical compositions. Such concepts may appear in the course of the coherent evolution of an original idea into one or more expressions that are dominated by the original idea. A Work may be elaborated by one or more Actors simultaneously or over time. The substance of Work is ideas. A Work may have members that are works in their own right.
 *
 * -ontology-equivalentClass &efrbroo;/F1_Work
 * -ontology-subClassOf 
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
 *     attributes={"order"={"code": "ASC"}}
 * )
 * @ORM\Entity
 * @UniqueEntity("code")
 */
class Work
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
     * @var string The Biflow code created to this work
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     * -ontology-range &biflow;Identifier
     * -ontology-name has_code
     * -ontology-equivalentProperty &current;P1_is_identified_by
     * -ontology-comment The biflow code of the work
     */
    public $code = '';

    /**
     * @var Author The author of this work. 
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="works")
     * -ontology-range &biflow;Person
     * -ontology-name has_author
     * -ontology-comment The author who created this work. 
     * -ontology-equivalentProperty &current;P94i_was_created_by
     */
    public $author;

    /**
     * @var Other attributions for this work
     * @ORM\ManyToMany(targetEntity="Person", inversedBy="works")
     * @ORM\JoinTable(
     *  name="work_attribution",
     *  joinColumns={@ORM\JoinColumn(name="work_id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="attribution_id")}
     * )
     * -ontology-name has_been_attributed_to
     * -ontology-comment statements of responsibility are expressed though knowledge creation of a work
     * -ontology-range &biflow;Person
     * -ontology-equivalentProperty &current;P140_assigned_attribute_to
     */
    public $attributions;

    /**
     * @var Content the content of this work
     * @ORM\Column(type="text", options={"default":""})
     * -ontology-name has_content
     * -ontology-comment A textual description of the content of this work
     */
    public $content = '';

    /**
     * @var Other Translations the history of the translations of this work. TBD
     * @ORM\Column(type="text", options={"default":""})
     * -ontology-name has_other_translations
     * -ontology-comment The history of the translations of this work
     */
    public $otherTranslations = '';

    /**
     * @var Other Works related to this one
     * @ORM\Column(type="text", options={"default":""})
     * -ontology-name has_related_works
     * -ontology-comment A description of related works
     */
    public $relatedWorks = '';

    /**
     * @var the genres whose the text was written.
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="works")
     * @ORM\JoinTable(
     *  name="work_genre",
     *  joinColumns={@ORM\JoinColumn(name="work_id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="genre_id")}
     * )
     * -ontology-name has_genre
     * -ontology-range &biflow;Genre
     */
    public $genres;
    
    /**
     * @var Expressions the list of the expressions for this work
     * @ORM\OneToMany(targetEntity="Expression", mappedBy="work")
     * -ontology-inverseOf &biflow;work
     * -ontology-name has_representative_expression
     * -ontology-range &biflow;Expression
     * -ontology-comment This property identifies an instance of F22 Self-Contained Expression that has been chosen as the most characteristic expression of the instance of F1 Work of which it is an expression. There is no other semantic implication to this notion of being characteristic than to be an adequate candidate to uniquely identify the Work realized by it. Prototypically, this is the instance of F22 Self-Contained Expression that is deemed characteristic of an instance of F15 Complex Work.
     */
    public $expressions;

    /**
     * @var Editor The editor of this work
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Editor", inversedBy="works")
     * -ontology-range &biflow;Editor
     * -ontology-name has_been_created_by
     * -ontology-comment The editor of this work
     * -ontology-subPropertyOf &current;P14_carried_out_by
     */
    public $editor;

    /**
     * @var the creation date of this work by the editor
     *
     * @RangeDate
     * @ORM\Column(type="string", options={"default":""})
     * -ontology-range &biflow;Date
     * -ontology-name has_creation_date
     * -ontology-comment The creation date of the dossier by the editor
     */
    public $creationDate = "";

    /**
     * @var The bibliography of this work
     * @ORM\ManyToMany(targetEntity="Bibliography", inversedBy="works")
     * @ORM\JoinTable(
     *  name="work_bibliography",
     *  joinColumns={@ORM\JoinColumn(name="work_id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="bibliography_id")}
     * )
     * -ontology-name has_bibliography
     * -ontology-range &biflow;Bibliography
     * -ontology-comment Has a bibliografy entry of this work
     */
    public $bibliographies;

    /**
     * @var Published
     *
     * @ORM\Column(type="boolean", options={"default":false})
     * -ontology-ignore
     */
    public $published = false;

    public function __construct() {
        $this->expressions = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->attributions = new ArrayCollection();
        $this->bibliographies = new ArrayCollection();
    }


    public function getId(): int
    {
        return $this->id;
    }
}
