<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the Work Attribution class.
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
 * @UniqueEntity(fields={"attribution", "work"})
 * -ontology-ignore
 */
class WorkAttribution
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
     * @var The work
     * @ORM\ManyToOne(targetEntity="Work", inversedBy="attributions")
     * -ontology-range &biflow;Work
     */
    public $work;

    /**
     * @var The attribution
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="attributedWorks")
     * -ontology-range &biflow;Person
     */
    public $attribution;
    
    public function getId(): int
    {
        return $this->id;
    }
}
