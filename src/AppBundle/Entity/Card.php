<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

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
    const GENDER_MALE = "male", GENDER_FEMALE = "female";

    /**
     * Card constructor.
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

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
     * @var string $gender
     *
     * @ORM\Column(name="gender", type="string", length=50, nullable=true)
     * @Assert\Choice(
     *      choices = {
     *          Card::GENDER_FEMALE: "female",
     *          Card::GENDER_MALE: "male"
     *      }
     * )
     * @Groups({"read", "write"})
     */
    private $gender;

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="card", cascade={"persist"})
     * @Groups({"read", "write"})
     */
    private $images;

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param $image
     */
    public function addImage($image)
    {
        $this->images->add($image);
        $image->setCard($this);
    }

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

}
