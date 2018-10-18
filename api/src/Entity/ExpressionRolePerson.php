<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is the Material class.
 *
 * @ApiResource
 * @ORM\Entity
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
