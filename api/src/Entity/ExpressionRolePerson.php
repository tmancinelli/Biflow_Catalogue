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
 * @UniqueEntity(fields = {"expression", "role", "person"})
 */
class ExpressionRolePerson
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
     * @ORM\ManyToOne(targetEntity="Expression", inversedBy="people")
     */
    public $expression;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="expressions")
     */
    public $role;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="roles")
     */
    public $person;

    public function getId(): int
    {
        return $this->id;
    }
}
