<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the Material class.
 *
 * @ApiResource
 * @ORM\Entity
 * @UniqueEntity("role")
 */
class Role
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
     * @var string, The role.
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $role;

    /**
     * @var the expressions made by a person with this role.
     *
     * @ORM\OneToMany(targetEntity="ExpressionRolePerson", mappedBy="role")
     */
    public $expressions;

    public function __construct() {
        $this->expressions = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
