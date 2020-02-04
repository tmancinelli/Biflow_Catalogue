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
 * This is the Work class. The beginning of our world.
 *
 * -ontology-comment This class comprises beginnings of evolutions of works.
 * -ontology-comment An instance of F27 Work Conception marks the initiation of the creation of a work. The work, as an intellectual construction, evolves from this point on, until the last known expression of it. The instance of E39 Actor with which a work is associated through the chain of properties F1 Work R16i was initiated by F27 Work Conception P14 carried out by E39 Actor corresponds to the notion of the “creator” of the work. In the case of commissioned works, it is not the commissioning that is regarded as the work conception, but the acceptance of the commission.
 * -ontology-comment This event does not always correlate with the date assigned in common library practice to the work, which is usually a later event (such as the date of completion of the first clean draft).
 * -ontology-comment In addition, F27 Work Conception can serve to document the circumstances that surrounded the appearance of the original idea for a work, when these are known.
 * -ontology-equivalentClass &efrbroo;F27_Work_Conception
 * -ontology-subClassOf &current;E65_Creation
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
     * @var string The code of this work
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
     * @var Author The author of this work
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="works")
     * -ontology-range &biflow;Person
     * -ontology-name has_author
     * -ontology-comment The author who created this work
     * -ontology-subPropertyOf &current;P14_carried_out_by
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
     * -ontology-comment Different author for this work whois been attributed to
     * -ontology-range &biflow;Person
     * -ontology-subPropertyOf &current;P14_carried_out_by
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
     * -ontology-name has_expression
     * -ontology-range &biflow;Expression
     * -ontology-comment The expression that belongs to this work
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
     * -ontology-comment The creation date of this work by the editor
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
