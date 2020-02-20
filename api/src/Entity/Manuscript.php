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
 * -ontology-comment The manuscript is the document made in the Middle Ages for texts.
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
 *     }
 * )
 *
 * @ORM\Entity
 * @UniqueEntity(fields={"library", "shelfMark"})
 *
 * -ontology-subClassOf &current;E84_Information_Carrier
 * -ontology-equivalentClass &efrbroo;F4_Manifestation_Singleton
 * -ontology-comment "This is the Manuscript Class
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
     * -ontology-name has_current_library_location
     * -ontology-label The library whose the manuscript is preserved
     * -ontology-comment The name of the the library where the manuscript is preserved.
     * -ontology-range &biflow;Library
     * -ontology-equivalentProperty &current;P55_has_current_location
     */
    public $library;

    /**
     * @var The identifier number of the manuscript
     * @Assert\NotNull
     * @ORM\Column(type="text", options={"default":""})
     * -ontology-name has_shelf_mark_identifier
     * -ontology-label The identifier number of the manuscript
     * -ontology-comment A shelf-mark, or shelfmark, in a manuscript in a library is, specifically, a press-mark that denotes where is located
     * -ontology-equivalentProperty &current;P1_is_identified_by
     * -ontology-range &current;E41_Appellation
     */
    public $shelfMark;

    /**
     * @var typology The typology of this manuscript.
     * @ORM\ManyToOne(targetEntity="Typology", inversedBy="manuscripts")
     * -ontology-name has_typology
     * -ontology-label The typology of this manuscript
     * -ontology-comment The typology of this manuscript.
     * -ontology-range &biflow;Typology
     */
    public $typology;

    /**
     * @var Information about the place expressed in the manuscript
     * @ORM\Column(type="text", options={"default":""})
     * -ontology-comment The information written or expressed in the manuscript which denote the place where the manuscript was written
     * -ontology-name has_place_expressed
     * -ontology-range &current;E53_Place
     */
    public $place = '';

    /**
     * @var the manuscript date
     *
     * @RangeDate
     * @ORM\Column(type="string", options={"default":""})
     * -ontology-name has_date
     * -ontology-label The date of the manuscript
     * -ontology-comment The information about the dates related to the manuscript. This date can be expressed in the manuscript or supposed by scholars.
     * -ontology-range &biflow;Date
     */
    public $date = "";

    /**
     * @var material The material whose the manuscript is made.
     * @ORM\ManyToOne(targetEntity="Material", inversedBy="manuscripts")
     * -ontology-name has_material
     * -ontology-label The material whose the manuscript is made
     * -ontology-comment The material whose the manuscript is made.
     * -ontology-range &biflow;Material
     * -ontology-equivalentProperty &current;P45_consists_of
     */
    public $material;

    /**
     * @var Futher information about the physical description
     * @ORM\Column(type="text", options={"default":""})
     * -ontology-name has_physical_description
     * -ontology-label Futher information about the physical description.
     * -ontology-comment Futher information about the physical description.
     */
    public $physDescription = '';

    /**
     * @var Description of the history of the codex
     * @ORM\Column(type="text", options={"default":""})
     * -ontology-name has_history
     * -ontology-label Description of the history of the codex.
     * -ontology-comment Description of the history of the codex.
     */
    public $history = '';

    /**
     * @var width The widht of the manuscript.
     * @ORM\Column(type="float", options={"default":0})
     * -ontology-label The widht of the manuscript.
     * -ontology-comment The widht of the manuscript.
     * -ontology-name has_dimension_width
     * -ontology-equivalentProperty &current;P43_has_dimension
     * -ontology-range &current;E54_Dimension
     */
    public $width=0;

    /**
     * @var height The height of the manuscript.
     * @ORM\Column(type="float", options={"default":0})
     * -ontology-label The height of the manuscript.
     * -ontology-comment The height of the manuscript.
     * -ontology-name has_dimension_height
     * -ontology-equivalentProperty &current;P43_has_dimension
     * -ontology-range &current;E54_Dimension
     */
    public $height=0;

    /**
     * @var Information about the script
     * @ORM\Column(type="text", options={"default":""})
     * -ontology-label Information about the script.
     * -ontology-comment Information about the script.
     * -ontology-name has_script_description
     * -ontology-range &current;E55_Type
     */
    public $scriptDescription = '';

    /**
     * @var Futher information about the decoration descrition
     * @ORM\Column(type="text", options={"default":""})
     * -ontology-label Futher information about the decoration descrition.
     * -ontology-comment Futher information about the decoration descrition.
     * -ontology-name has_decoration_description
     */
    public $decoDescription = '';

    /**
     * @var Description of this manuscript collation
     * @ORM\Column(type="text", options={"default":""})
     * -ontology-label Description of this manuscript collation.
     * -ontology-comment Description of this manuscript collation.
     * -ontology-name has_collation_description
     */
    public $collationDescription = '';

    /**
     * @var Information about the binding description
     * @ORM\Column(type="text", options={"default":""})
     * -ontology-label Information about the binding description.
     * -ontology-comment Information about the binding description.
     * -ontology-name has_binding_description
     * -ontology-range &base;Binding
     */
    public $binding = '';

    /**
     * @var Information about the ruling description
     * @ORM\Column(type="text", options={"default":""})
     * -ontology-label Information about the ruling description.
     * -ontology-comment Information about the ruling description.
     * -ontology-name has_ruled_lines
     */
    public $ruledLines = '';

    /**
     * @var ruled line technique
     * @ORM\ManyToOne(targetEntity="RuledLineTechnique", inversedBy="manuscripts")
     * -ontology-name has_ruled_line_technique
     * -ontology-label The ruled line tecnique whose the manuscript is made
     * -ontology-comment The ruled line tecnique whose the manuscript is made.
     * -ontology-range &biflow;ruledLineTechnique
     */
    public $ruledLineTechnique;

    /**
     * @var checked in loco, on internet or not yet checked.
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="CheckStatus", inversedBy="manuscripts")
     * -ontology-label Intormation of how this manuscrpt was examined.
     * -ontology-comment Intormation of how this manuscrpt was examined.
     * -ontology-range &biflow;CheckStatus
     * -ontology-name has_check_Status
     */
    public $checkStatus;

    /**
     * @var Note the note of this manuscript
     * @ORM\Column(type="text", options={"default":""})
     * -ontology-label the note of this manuscript.
     * -ontology-comment Further information about this manuscript.
     * -ontology-name has_note
     * -ontology-equivalentClass &current;P3_has_note
     */
    public $note = '';

    /**
     * @var Content the content of this manuscript
     * @ORM\Column(type="text", options={"default":""})
     * -ontology-label the content of this manuscript.
     * -ontology-name has_content
     */
    public $content = '';

    /**
     * @var Localisation the list of localisations for this manuscript
     * @ORM\OneToMany(targetEntity="Localisation", mappedBy="manuscript")
     * -ontology-label  The list of localisations for this manuscript.
     * -ontology-comment  The list of localisations for this manuscript.
     * -ontology-range &biflow;Localisation
     * -ontology-name has_localization
     */
    public $localisations;

    /**
     * @var The bibliography of this manuscript
     * @ORM\ManyToMany(targetEntity="Bibliography", inversedBy="manuscripts")
     * @ORM\JoinTable(
     *  name="manuscript_bibliography",
     *  joinColumns={@ORM\JoinColumn(name="manuscript_id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="bibliography_id")}
     * )
     * -ontology-name has_bibliography
     * -ontology-range &biflow;Bibliography
     * -ontology-comment Has a bibliografy entry of this manuscript
     */
    public $bibliographies;

    /**
     * @var Editor The editor of this manuscript
     * @ORM\ManyToOne(targetEntity="Editor", inversedBy="manuscripts")
     * -ontology-range &biflow;Editor
     * -ontology-name has_been_created_by
     * -ontology-comment The editor of this manuscript
     * -ontology-subPropertyOf &current;P14_carried_out_by
     */
    public $editor;

    public function __construct() {
        $this->localisations = new ArrayCollection();
        $this->bibliographies = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
