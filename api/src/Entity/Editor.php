<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the Editor class.
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
 *     attributes={"order"={"editor": "ASC"}}
 * )
 * @ORM\Entity
 * @UniqueEntity("editor")
 */
class Editor
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
     * @var string The editor
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $editor;

    /**
     * @var Editors the list of the works
     * @ORM\OneToMany(targetEntity="Work", mappedBy="editor")
     */
    public $works;

    /**
     * @var Editors the list of the manuscripts
     * @ORM\OneToMany(targetEntity="Manuscript", mappedBy="editor")
     */
    public $manuscripts;

    public function __construct() {
        $this->works = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
