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
 * This is the Manuscript class.
 * @ontology-comment The manuscript is the document made in the Middle Ages for texts. 
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
 * @UniqueEntity(fields={"library", "shelfMark"})
 */
class Manuscript
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
     * @var The library whose the manuscript is preserved.
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Library", inversedBy="manuscripts")
     * @ontology-label The library whose the manuscript is preserved
     * @ontology-comment The name of the the library where the manuscript is preserved.
     * @ontology-range &biflow;Library
     */
    public $library;

    /**
     * @var The identifier number of the manuscript
     * @Assert\NotNull
     * @ORM\Column(type="text", options={"default":""})
     * @ontology-label The identifier number of the manuscript
     * @ontology-comment A shelf-mark, or shelfmark, in a manuscript in a library is, specifically, a press-mark that denotes where is located
     */
    public $shelfMark;

    /**
     * @var Information about the place expressed in the manuscript
     * @ORM\Column(type="text", options={"default":""})
     * @ontology-label The place expressed in the manuscript
     * @ontology-comment The information written or expressed in the manuscript which denote the place where the manuscript was written
     */
    public $place = '';

    /**
     * @var the manuscript date
     *
     * @RangeDate
     * @ORM\Column(type="string", options={"default":""})
     * @ontology-label The date of the manuscript
     * @ontology-comment The information about the dates related to the manuscript. This date can be expressed in the manuscript or supposed by scholars.
     * @ontology-range &biflow;Date
     */
    public $date = "";

    /**
     * @var material The material whose the manuscript is made.
     * @ORM\ManyToOne(targetEntity="Material", inversedBy="manuscripts")
     * @ontology-label The material whose the manuscript is made
     * @ontology-comment The material whose the manuscript is made.
     * @ontology-range &biflow;Material
     */
    public $material;

    /**
     * @var Futher information about the physical description
     * @ORM\Column(type="text", options={"default":""})
     * @ontology-label Futher information about the physical description.
     * @ontology-comment Futher information about the physical description.
     */
    public $physDescription = '';

    /**
     * @var Description of the history of the codex
     * @ORM\Column(type="text", options={"default":""})
     * @ontology-label Description of the history of the codex.
     * @ontology-comment Description of the history of the codex.
     */
    public $history = '';

    /**
     * @var width The widht of the manuscript.
     * @ORM\Column(type="float", options={"default":0})
     * @ontology-label The widht of the manuscript.
     * @ontology-comment The widht of the manuscript.
     */
    public $width=0;

    /**
     * @var height The height of the manuscript.
     * @ORM\Column(type="float", options={"default":0})
     * @ontology-label The height of the manuscript.
     * @ontology-comment The height of the manuscript.
     */
    public $height=0;

    /**
     * @var Information about the script
     * @ORM\Column(type="text", options={"default":""})
     * @ontology-label Information about the script.
     * @ontology-comment Information about the script.
     */
    public $scriptDescription = '';

    /**
     * @var Futher information about the decoration descrition
     * @ORM\Column(type="text", options={"default":""})
     * @ontology-label Futher information about the decoration descrition.
     * @ontology-comment Futher information about the decoration descrition.
     */
    public $decoDescription = '';

    /**
     * @var Description of this manuscript collation
     * @ORM\Column(type="text", options={"default":""})
     * @ontology-label Description of this manuscript collation.
     * @ontology-comment Description of this manuscript collation.
     */
    public $collationDescription = '';

    /**
     * @var Information about the binding description
     * @ORM\Column(type="text", options={"default":""})
     * @ontology-label Information about the binding description.
     * @ontology-comment Information about the binding description.
     */
    public $binding = '';

    /**
     * @var Information about the ruling description
     * @ORM\Column(type="text", options={"default":""})
     * @ontology-label Information about the ruling description.
     * @ontology-comment Information about the ruling description.
     */
    public $ruledLines = '';

    /**
     * @var checked in loco, on internet or not yet checked.
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="CheckStatus", inversedBy="manuscripts")
     * @ontology-label Intormation of how this manuscrpt was examined.
     * @ontology-comment Intormation of how this manuscrpt was examined.
     * @ontology-range &biflow;CheckStatus
     */
    public $checkStatus;

    /**
     * @var Note the note of this manuscript
     * @ORM\Column(type="text", options={"default":""})
     * @ontology-label the note of this manuscript.
     * @ontology-comment Further information about this manuscript.
     */
    public $note = '';

    /**
     * @var Localisation the list of localisations for this manuscript
     * @ORM\OneToMany(targetEntity="Localisation", mappedBy="manuscript")
     * @ontology-label  The list of localisations for this manuscript.
     * @ontology-comment  The list of localisations for this manuscript.
     * @ontology-range &biflow;Localisation
     */
    public $localisations;

    public function __construct() {
        $this->localisations = new ArrayCollection();
    }

  
    public function getId(): int
    {
        return $this->id;
    }
}
