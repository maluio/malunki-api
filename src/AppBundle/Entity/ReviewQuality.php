<?php

namespace AppBundle\Entity;


/**
 * Class ReviewQuality
 * @package AppBundle\Entity
 */
class ReviewQuality
{
    /**
     * ReviewQuality constructor.
     * @param int $value
     * @param int $nextReviewInMinutes
     */
    public function __construct($value = 0, $nextReviewInMinutes = 0)
    {
        $this->value = $value;
        $this->nextReviewInMinutes = $nextReviewInMinutes;
    }

    /**
     * @var int
     */
    public $value;

    /**
     * @var int
     */
    public $nextReviewInMinutes;
}
