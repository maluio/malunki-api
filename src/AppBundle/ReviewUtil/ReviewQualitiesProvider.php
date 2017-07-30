<?php

namespace AppBundle\ReviewUtil;

use AppBundle\Entity\ReviewQuality;

class ReviewQualitiesProvider
{
    public function get() {
        return $reviewQualities =  array (
            (array) new ReviewQuality(0),
            (array) new ReviewQuality(1),
            (array) new ReviewQuality(2),
            (array) new ReviewQuality(3),
            (array) new ReviewQuality(4),
            (array) new ReviewQuality(5),
        );

    }
}
