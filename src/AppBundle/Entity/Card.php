<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 *  @ApiResource(
 *     attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}},
 *     }
 *   )
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Card
{
    /**
     * @var int The entity Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @var string front
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Groups({"read", "write"})
     */
    private $front = '';

    /**
     * @var string back
     *
     * @ORM\Column(type="text")
     * @Groups({"read", "write"})
     */
    private $back = '';

    /**
     * @var float
     *
     * @Groups({"read"})
     * @ORM\Column(type="float")
     */
    private $eFactor = '';

    /**
     * @var integer
     *
     * @Groups({"read"})
     * @ORM\Column(type="integer")
     */
    private $repetition = '';

    /**
     * @var integer
     *
     * @Groups({"read"})
     * @ORM\Column(type="integer")
     */
    private $lastInterval = '';

    /**
     * @var \DateTime
     *
     * @Groups({"read", "write"})
     * @ORM\Column(type="datetime")
     *
     */
    private $reviewDate = '';

    /**
     * @return int
     */
    public function getMinutesTilNextReview()
    {
        return $this->minutesTilNextReview;
    }

    /**
     * @param int $minutesTilNextReview
     */
    public function setMinutesTilNextReview($minutesTilNextReview)
    {
        $this->minutesTilNextReview = $minutesTilNextReview;
    }

    /**
     * @var integer
     *
     * @Groups({"write"})
     *
     */
    private $minutesTilNextReview = '';

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set front
     *
     * @param string $front
     *
     * @return Card
     */
    public function setFront($front)
    {
        $this->front = $front;

        return $this;
    }

    /**
     * Get front
     *
     * @return string
     */
    public function getFront()
    {
        return $this->front;
    }

    /**
     * Set back
     *
     * @param string $back
     *
     * @return Card
     */
    public function setBack($back)
    {
        $this->back = $back;

        return $this;
    }

    /**
     * Get back
     *
     * @return string
     */
    public function getBack()
    {
        return $this->back;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersistSetEFactor()
    {
        $this->eFactor = 0;
    }

    /**
     * Set eFactor
     *
     * @param float $eFactor
     *
     * @return Card
     */
    public function setEFactor($eFactor)
    {
        $this->eFactor = $eFactor;

        return $this;
    }

    /**
     * Get eFactor
     *
     * @return float
     */
    public function getEFactor()
    {
        return $this->eFactor;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersistSetRepetition()
    {
        $this->repetition = 0;
    }

    /**
     * Set repetition
     *
     * @param integer $repetition
     *
     * @return Card
     */
    public function setRepetition($repetition)
    {
        $this->repetition = $repetition;

        return $this;
    }

    /**
     * Get repetition
     *
     * @return integer
     */
    public function getRepetition()
    {
        return $this->repetition;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersistSetReviewDate()
    {
        $this->reviewDate = new \DateTime();
    }

    /**
     * Set reviewDate
     *
     * @param \DateTime $reviewDate
     *
     * @return Card
     */
    public function setReviewDate($reviewDate)
    {
        $this->reviewDate = $reviewDate;

        return $this;
    }

    /**
     * Get reviewDate
     *
     * @return \DateTime
     */
    public function getReviewDate()
    {
        return $this->reviewDate;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersistSetLastInterval()
    {
        $this->lastInterval = 0;
    }

    /**
     * Set lastInterval
     *
     * @param integer $lastInterval
     *
     * @return Card
     */
    public function setLastInterval($lastInterval)
    {
        $this->lastInterval = $lastInterval;

        return $this;
    }

    /**
     * Get lastInterval
     *
     * @return integer
     */
    public function getLastInterval()
    {
        return $this->lastInterval;
    }
}
