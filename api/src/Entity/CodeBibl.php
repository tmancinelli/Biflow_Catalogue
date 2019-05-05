<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the Identifier class of each bibliography reference.
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
 *     attributes={"order"={"codeBibl": "ASC"}}
 * )
 * @ORM\Entity
 * @UniqueEntity("codeBibl")
 */
class CodeBibl
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
     * @var string The codeBibl
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $codeBibl;

    /**
     * @var Bibliography: the reference linked to this code
     * @ORM\OneToMany(targetEntity="Bibliography", mappedBy="codeBibl")
     */
    public $bibliographies;
    
    public function __construct() {
        $this->bibliography = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
