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
 * This is the Expression class. The expression is a rapresentation of a work.
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
 * @ORM\Entity
 * @UniqueEntity("code")
 */
class Expression
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
     * @var string The code of this expression
     *
     * @ORM\Column(type="text", options={"default":""})
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $code;

    /**
     * @var work The work this expression belongs to.
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Work", inversedBy="expressions")
     */
    public $work;

    /**
     * @var Translator The translator of this work, if any
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="translations")
     */
    public $translator;

    /**
     * @var Other attributions for this expression
     * @ORM\OneToMany(targetEntity="ExpressionAttribution", mappedBy="expression")
     */
    public $attributions;

    /**
     * @var Title the title of this expression
     * @Assert\NotNull
     * @ORM\Column(type="text", options={"default":""})
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $title = '';

    /**
     * @var Incipit the incipit of this expression
     * @ORM\Column(type="text", options={"default":""})
     */
    public $incipit = '';

    /**
     * @var Explicit the explicit of this expression
     * @ORM\Column(type="text", options={"default":""})
     */
    public $explicit = '';

    /**
     * @var Textual History the history of the text of this expression. It can also be the arrival of the test if this is not a top-level expression.
     * @ORM\Column(type="text", options={"default":""})
     */
    public $textualHistory = '';

    /**
     * @var the expression date
     *
     * @RangeDate
     * @ORM\Column(type="string", options={"default":""})
     */
    public $date = "";

    /**
     * @var ManuscriptTradition the tradition of the manuscripts for this expression
     * @ORM\Column(type="text", options={"default":""})
     */
    public $manuscriptTradition = '';

    /**
     * @var derivedFrom Ogni traduzione deriva da una espressione precedente. Se questa non esiste, vuol dire che l'espressione e' la prima della 'catena di espressioni'. La possiamo vedere come la prima espressione di un lavoro, anche se possono esserci tante "prime" espressioni di un lavoro... (da espandere).
     *
     * @ORM\ManyToOne(targetEntity="Expression", inversedBy="derivedExpressions")
     */
    public $derivedFrom;

    /**
     * @var derivedExpressions Expressions derived by this one.
     *
     * @ORM\OneToMany(targetEntity="Expression", mappedBy="derivedFrom")
     */
    public $derivedExpressions;

     /**
     * @var History of thef the note of this expression
     * @ORM\Column(type="text", options={"default":""})
     */
    public $editionHistory = '';

    /**
     * @var textualTypology whose the text is written.
     *
     * @ORM\ManyToOne(targetEntity="TextualTypology", inversedBy="expressions")
     */
    public $textualTypology;

    /**
     * @var the language whose the text was written.
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="expressions")
     */
    public $language;

    /**
	 * @var The bibliography of this expressions
	 * @ORM\OneToMany(targetEntity="Bibliography", mappedBy="expressions")
     */
    public $bibliographies;

    /**
     * @var Localisations[] localisation of this manuscript
     * 
     * @ORM\OneToMany(targetEntity="Localisation", mappedBy="expression")
     */
    public $localisations;

    /**
    TODO
    public $date(format)
    */
    
    public function __construct() {
        $this->derivedExpressions = new ArrayCollection();
        $this->localisations = new ArrayCollection();
        $this->editions = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
