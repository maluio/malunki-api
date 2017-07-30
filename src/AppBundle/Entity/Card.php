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
     * @var string The word
     * @Assert\NotBlank
     * @ORM\Column(type="string")
     * @Groups({"read", "write"})
     */
    private $word;

    /**
     * @var array
     * @Groups({"read"})
     */
    private $reviewQualities;

    /**
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * @return array
     */
    public function getReviewQualities()
    {
        return $this->reviewQualities;
    }

    /**
     * @param array $reviewQualities
     */
    public function setReviewQualities($reviewQualities)
    {
        $this->reviewQualities = $reviewQualities;
    }

    /**
     * @param string $word
     */
    public function setWord($word)
    {
        $this->word = $word;
    }

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
     * @ORM\Column(type="float")
     */
    private $eFactor = '';

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $repetition = '';

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $lastInterval = '';

    /**
     * @var \DateTime
     *
     * @Groups({"read"})
     * @ORM\Column(type="datetime")
     *
     */
    private $reviewDate = '';

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
