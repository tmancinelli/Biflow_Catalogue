<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is the Bibliography class. References related to the expression.
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
 *     attributes={"order"={"title": "ASC"}}
 * )
 * @ORM\Entity
 */
class Bibliography
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
     * @var work The work this reference belongs to.
     * @ORM\OneToMany(targetEntity="WorkBibliography", mappedBy="bibliography")
     */
    public $works;

    /**
     * @var The author of the reference.
     * @Assert\NotNull
     * @ORM\Column(type="text")
     */
    public $author;

    /**
     * @var string The title of this reference.
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $title;

    /**
     * @var string The title of the chapter of this reference.
     *
     * @ORM\Column(type="text", options={"default":""})
     */
    public $chapter = '';

    /**
     * @var The editor of this reference
     * @ORM\Column(type="text", options={"default":""})
     */
    public $editor = '';

    /**
     * @var Name of the volume.
     * @ORM\Column(type="text", options={"default":""})
     */
    public $volume = '';

    /**
     * @var Number of the volume.
     * @ORM\Column(type="text", options={"default":""})
     */
    public $volumeNumber = '';

    /**
     * @var string The city where the library is
     * @ORM\Column(type="text", options={"default":""})
     */
    public $place = '';

    /**
     * @var The date of this reference
     * @Assert\NotNull
     * @ORM\Column(type="integer")
     */
    public $date;

    /**
     * @var Publisher of this reference.
     * @ORM\Column(type="text", options={"default":""})
     */
    public $publisher = '';

    /**
     * @var Name of the journal.
     * @ORM\Column(type="text", options={"default":""})
     */
    public $journal = '';

    /**
     * @var codeBibl The code linked to the reference.
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="CodeBibl", inversedBy="bibliographies")
     */
    public $codeBibl;

    /**
     * @var The issue of this journal
     * @ORM\Column(type="text", options={"default":""})
     */
    public $journalNumber = '';

    /**
     * @var The page numbers
     * @ORM\Column(type="text", options={"default":""})
     */
    public $pageNumber = '';

    /**
     * @var The url
     * @ORM\Column(type="text", options={"default":""})
     * @ApiProperty(iri="http://schema.org/url")
     */
    public $url = '';

    public function getId(): int
    {
        return $this->id;
    }

    public function __construct() {
        $this->works = new ArrayCollection();
    }
}
