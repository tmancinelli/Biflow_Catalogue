<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints\RangeDate;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

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
 * @UniqueEntity("shelfMark")
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
     * @var expression The expression this manuscript belongs to.
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Expression", inversedBy="manuscripts")
     */
    public $expression;

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
      * @var The date of the manuscript
      *
      * @RangeDate
      * @ORM\Column(type="string", options={"default":""})
      */
    public $date = '';

    /**
     * @var material The material whose the manuscript is made.
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Material", inversedBy="manuscripts")
     */
    public $material;

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
     * @var Localisation the localisation of the text in this manuscript
     * @ORM\Column(type="text", options={"default":""})
     */
    public $localisation = '';

    /**
     * @var checked in loco, on internet or not yet checked.
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="CheckStatus", inversedBy="manuscripts")
     */
    public $checkStatus;

    /**
     * @var Copyist The copyist
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="codices")
     */
    public $copyist;

    /**
     * @var Note the note of this manuscript
     * @ORM\Column(type="text", options={"default":""})
     */
    public $note = '';
  
    public function getId(): int
    {
        return $this->id;
    }
}
