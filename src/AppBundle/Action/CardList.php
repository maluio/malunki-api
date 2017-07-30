<?php
namespace AppBundle\Action;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\ReviewQuality;

class CardList
{

    /**
     * @Route(
     *     name="api_cards_get_collection",
     *     path="/cards",
     *     defaults={"_api_resource_class"="AppBundle\Entity\Card", "_api_collection_operation_name"="get"}
     * )
     * @Method("GET")
     * @param $data array \AppBundle\Entity\Card
     * @return array \AppBundle\Entity\Card
     */
    public function __invoke($data)
    {
        $reviewQualities =  array (
            (array) new ReviewQuality(0),
            (array) new ReviewQuality(1),
            (array) new ReviewQuality(2),
            (array) new ReviewQuality(3),
            (array) new ReviewQuality(4),
            (array) new ReviewQuality(5),
        );

        foreach ($data as $card) {
            $card->setReviewQualities(
                $reviewQualities
            );
        }

        return $data;
    }




}
