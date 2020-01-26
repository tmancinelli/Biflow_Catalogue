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
 * This is the Localisation class.
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
 *     attributes={"order"={"localisation": "ASC"}}
 * )
 * @ORM\Entity
 * @UniqueEntity(fields={"localisation", "manuscript"})
 */
class Localisation
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
     * @var string The Localisation
     *
     * @ORM\Column
     * @Assert\NotNull
     */
    public $localisation;

    /**
     * @var the manuscript for this localisation
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Manuscript", inversedBy="localisations")
     * -ontology-range &biflow;Manuscript
     */
    public $manuscript;

    /**
     * @var expression The expression this localisation of this manuscript belongs to.
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Expression", inversedBy="localisations")
     * -ontology-range &biflow;Expression
     */
    public $expression;

    /**
     * @var Copyist The copyist
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="codices")
     * -ontology-range &biflow;Person
     */
    public $copyist;

    /**
     * @var The date of the localisation of this manuscript
     *
     * @RangeDate
     * @ORM\Column(type="string", options={"default":""})
     * -ontology-range &biflow;Date
     */
    public $date = '';

    /**
     * @var Note the note of this localisation of this manuscript
     * @ORM\Column(type="text", options={"default":""})
     */
    public $note = '';

    public function getId(): int
    {
        return $this->id;
    }
}
