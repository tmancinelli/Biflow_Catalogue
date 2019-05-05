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
     */
    public $library;

    /**
     * @var The identifier number of the manuscript
     * @Assert\NotNull
     * @ORM\Column(type="text", options={"default":""})
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $shelfMark;

    /**
     * @var Information about the place expressed in the manuscript
     * @ORM\Column(type="text", options={"default":""})
     */
    public $place = '';

    /**
     * @var the manuscript date
     *
     * @RangeDate
     * @ORM\Column(type="string", options={"default":""})
     */
    public $date = "";

    /**
     * @var material The material whose the manuscript is made.
     * @ORM\ManyToOne(targetEntity="Material", inversedBy="manuscripts")
     */
    public $material;

    /**
     * @var Futher information about the physical description
     * @ORM\Column(type="text", options={"default":""})
     */
    public $physDescription = '';

    /**
     * @var Description of the history of the codex
     * @ORM\Column(type="text", options={"default":""})
     */
    public $history = '';

    /**
     * @var width The widht of the manuscript.
     * @ORM\Column(type="float", options={"default":0})
     */
    public $width=0;

    /**
     * @var height The height of the manuscript.
     * @ORM\Column(type="float", options={"default":0})
     */
    public $height=0;

    /**
     * @var Information about the script
     * @ORM\Column(type="text", options={"default":""})
     */
    public $scriptDescription = '';

    /**
     * @var Futher information about the decoration descrition
     * @ORM\Column(type="text", options={"default":""})
     */
    public $decoDescription = '';

    /**
     * @var Description of this manuscript collation
     * @ORM\Column(type="text", options={"default":""})
     */
    public $collationDescription = '';

    /**
     * @var Information about the binding description
     * @ORM\Column(type="text", options={"default":""})
     */
    public $binding = '';

    /**
     * @var Information about the ruling description
     * @ORM\Column(type="text", options={"default":""})
     */
    public $ruledLines = '';

    /**
     * @var checked in loco, on internet or not yet checked.
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="CheckStatus", inversedBy="manuscripts")
     */
    public $checkStatus;

    /**
     * @var Note the note of this manuscript
     * @ORM\Column(type="text", options={"default":""})
     */
    public $note = '';

    /**
     * @var Localisation the list of localisations for this manuscript
     * @ORM\OneToMany(targetEntity="Localisation", mappedBy="manuscript")
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
