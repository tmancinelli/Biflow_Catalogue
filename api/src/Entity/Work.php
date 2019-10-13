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
 * @ontology-comment This class comprises beginnings of evolutions of works.
 * @ontology-comment An instance of F27 Work Conception marks the initiation of the creation of a work. The work, as an intellectual construction, evolves from this point on, until the last known expression of it. The instance of E39 Actor with which a work is associated through the chain of properties F1 Work R16i was initiated by F27 Work Conception P14 carried out by E39 Actor corresponds to the notion of the “creator” of the work. In the case of commissioned works, it is not the commissioning that is regarded as the work conception, but the acceptance of the commission.
 * @ontology-comment This event does not always correlate with the date assigned in common library practice to the work, which is usually a later event (such as the date of completion of the first clean draft).
 * @ontology-comment In addition, F27 Work Conception can serve to document the circumstances that surrounded the appearance of the original idea for a work, when these are known.
 * @ontology-equivalentClass &efrbroo;F27_Work_Conception
 * @ontology-subclassOf &current;E65_Creation
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
     */
    public $code = '';

    /**
     * @var Author The author of this work
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="works")
     * @ontology-range &biflow;Person
     */
    public $author;

    /**
     * @var Other attributions for this work
     * @ORM\OneToMany(targetEntity="WorkAttribution", mappedBy="work")
     */
    public $attributions;

    /**
     * @var Content the content of this work
     * @ORM\Column(type="text", options={"default":""})
     */
    public $content = '';

    /**
     * @var Other Translations the history of the translations of this work. TBD
     * @ORM\Column(type="text", options={"default":""})
     */
    public $otherTranslations = '';

    /**
     * @var Other Works related to this one
     * @ORM\Column(type="text", options={"default":""})
     */
    public $relatedWorks = '';

    /**
     * @var the genres whose the text was written.
     * @ORM\OneToMany(targetEntity="WorkGenre", mappedBy="work")
     */
    public $genres;
    
    /**
     * @var Expressions the list of the expressions for this work
     * @ORM\OneToMany(targetEntity="Expression", mappedBy="work")
     */
    public $expressions;

    /**
     * @var Editor The editor of this work
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Editor", inversedBy="works")
     * @ontology-range &biflow;Editor
     */
    public $editor;

    /**
     * @var the creation of this work by the editor
     *
     * @RangeDate
     * @ORM\Column(type="string", options={"default":""})
     * @ontology-range &biflow;Date
     */
    public $creationDate = "";

    /**
     * @var The bibliography of this work
     * @ORM\OneToMany(targetEntity="WorkBibliography", mappedBy="work")
     */
    public $bibliographies;

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
