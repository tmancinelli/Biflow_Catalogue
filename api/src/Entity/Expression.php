<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is the Expression class. The expression is a rapresentation of a work, in this case a single manuscript.
 *
 * @ApiResource
 * @ORM\Entity
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
     * @var string The  title.
     *
     * @ORM\Column
     * @Assert\NotBlank
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $title = '';

    /**
     * @var work The work this expression belongs to.
     *
     * @ORM\ManyToOne(targetEntity="Work", inversedBy="expressions")
     */
    public $work;

     /**
     * @var The city where the manuscript is
     * @ORM\Column(type="text", options={"default":""})
     */
    public $city;


    /**
     * @var The library whose the manuscript is preserved.
     *
     * @ORM\ManyToOne(targetEntity="Repository", inversedBy="expressions")
     */
    public $repository;

    /**
     * @var The city where the manuscript is
     * @ORM\Column(type="text", options={"default":""})
     */
    public $idno;

    /**
     * @var material The material whose the manuscript is made.
     *
     * @ORM\ManyToOne(targetEntity="Material", inversedBy="expressions")
     */
    public $material;

    /**
     * @var The number of the folios
     * @ORM\Column(type="text", options={"default":""})
     */
    public $cartaNumber;

     /**
     * @var The localitation of the folios
     * @ORM\Column(type="text", options={"default":""})
     */
    public $localisation;

    /**
     * @var Content the content of this expression
     * @ORM\Column(type="text", options={"default":""})
     */
    public $content = '';

    /**
     * @var History the history of this expression
     * @ORM\Column(type="text", options={"default":""})
     */
    public $history = '';

    /**
     * @var Inplicit the inplicit of this expression
     * @ORM\Column(type="text", options={"default":""})
     */
    public $inplicit = '';

    /**
     * @var Explicit the explicit of this expression
     * @ORM\Column(type="text", options={"default":""})
     */
    public $explicit = '';

    /**
     * @var tradition The tradition whose the manuscript belogs to.
     *
     * @ORM\ManyToOne(targetEntity="Tradition", inversedBy="expressions")
     */
    public $tradition;

    /**
     * @var width The widht of the manuscript.
     *
     * @ORM\Column(type="float", options={"default":0})
     */
    public $width=0;

    /**
     * @var height The height of the manuscript.
     *
     * @ORM\Column(type="float", options={"default":0})
     */
    public $height=0;

    /**
     * @var people The people .
     *
     * @ORM\OneToMany(targetEntity="ExpressionRolePerson", mappedBy="expression")
     */
    public $people;

    /**
     * @var derivedFrom The derivedFrom is a relation between manuscripts.
     *
     * @ORM\ManyToOne(targetEntity="Expression", inversedBy="derivedExpessions")
     */
    public $derivedFrom;

    /**
     * @var derivedExpressions Expressions derived by this one.
     *
     * @ORM\OneToMany(targetEntity="Expression", mappedBy="derivedFrom")
     */
    public $derivedExpressions;

     /**
     * @var Note the note of this expression
     * @ORM\Column(type="text", options={"default":""})
     */
    public $note = '';

    /**
     * @var textualTypology whose the text is written.
     *
     * @ORM\ManyToOne(targetEntity="TextualTypology", inversedBy="expressions")
     */
    public $textualTypology;

    /**
     * @var the genre whose the text was written.
     *
     * @ORM\ManyToOne(targetEntity="Genre", inversedBy="expressions")
     */
    public $genre;

    

    /**
    TODO
    public $date(format)
    */
    
    public function __construct() {
        $this->derivedExpressions = new ArrayCollection();
        $this->people = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
