<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the Repository class, which is the library where the manuscript is preserved.
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
 * @UniqueEntity("repository")
 */

class Repository
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
     * @var string The repository which is the library where the manuscript is preserved.
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $repository;

    /**
     * @var The city where the repository is
     * @Assert\NotNull
     * @ORM\Column(type="text", options={"default":""})
     */
    public $city;

    /**
     * @var Manuscripts the list of the manuscripts for this repository
     * @ORM\OneToMany(targetEntity="Manuscript", mappedBy="repository")
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
