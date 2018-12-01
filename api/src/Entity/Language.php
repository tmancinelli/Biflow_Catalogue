<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the Language class. The language of a Expression.
 *
 * @ApiResource(
 *     collectionOperations={
 *         "get",
 *         "post"={"access_control"="is_granted('ROLE_ADMIN')"},
 *         "put"={"access_control"="is_granted('ROLE_ADMIN')"},
 *         "delete"={"access_control"="is_granted('ROLE_ADMIN')"}
 *     },
 *      itemOperations={
 *         "get",
 *         "post"={"access_control"="is_granted('ROLE_ADMIN')"},
 *         "put"={"access_control"="is_granted('ROLE_ADMIN')"},
 *         "delete"={"access_control"="is_granted('ROLE_ADMIN')"}
 *     }
 * )
 * @ORM\Entity
 * @UniqueEntity("language")
 */
class Language
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
     * @var string The language
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $language;

    /**
     * @var expressions The list of expressions of this tradition.
     * @ORM\OneToMany(targetEntity="Expression", mappedBy="language")
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
