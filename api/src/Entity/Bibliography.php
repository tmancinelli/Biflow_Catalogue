<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is the Bibliography class. References related to the work description.
 *
 * @ApiResource
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
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Work", inversedBy="bibliographies")
     */
    public $work;

    /**
     * @var string The title of this reference.
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $title;

    /**
     * @var The author of the reference.
     * @Assert\NotNull
     * @ORM\Column(type="text")
     */
    public $author;

    /**
     * @var The date of this reference
     * @Assert\NotNull
     * @ORM\Column(type="integer")
     */
    public $date;

    /**
     * @var The editor of this reference
     * @ORM\Column(type="text", options={"default":""})
     */
    public $editor = '';

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
     * @var The issue of this journal
     * @ORM\Column(type="text", options={"default":""})
     */
    public $journalNumber = '';

   

    public function getId(): int
    {
        return $this->id;
    }
}
