<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the Nickname class.
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
 *     attributes={"order"={"nickname": "ASC"}}
 * )
 * @ORM\Entity
 */
class Nickname
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
     * @var string The nickname
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $nickname;

    /**
     * @var The person who has this nickname
     * 
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="nicknames")
     * @ontology-range &biflow;Person
     */
    public $person;

    public function getId(): int
    {
        return $this->id;
    }
}
