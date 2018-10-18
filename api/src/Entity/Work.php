<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is the Work class. The beginning of our world.
 *
 * @ApiResource
 * @ORM\Entity
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
     *
     * @ORM\Column
     * @Assert\NotBlank
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $code = '';

    /**
     * @var Creator The creator of this work
     *
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="works")
     */
    public $creator;

    /**
     * @var Expressions the list of the expressions for this work
     * @ORM\OneToMany(targetEntity="Expression", mappedBy="work")
     */
    public $expressions;

    /**
     * @var Content the content of this work
     * @ORM\Column(type="text", options={"default":""})
     */
    public $content = '';

    /**
     * @var History the history of this work
     * @ORM\Column(type="text", options={"default":""})
     */
    public $history = '';

    /*
     * TODO: bibliografia
     */

    public function __construct() {
        $this->expressions = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
