<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the Library class.
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
 * @UniqueEntity("libraryName")
 * @UniqueEntity("libraryCode")
 */
class Library
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
     * @var string The city where the library is
     *
     * @ORM\Column
     * @Assert\NotNull
     */
    public $city;

    /**
     * @var string The library name
     *
     * @ORM\Column
     * @Assert\NotNull
     */
    public $libraryName;

    /**
     * @var string The library identification number
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $libraryCode;

    /**
     * @var Manuscripts the list of the manuscripts in this library
     * @ORM\OneToMany(targetEntity="Manuscript", mappedBy="library")
     */
    public $manuscripts;
    
    public function __construct() {
        $this->manuscripts = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
