<?php
namespace AppBundle\Action;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use \AppBundle\ReviewUtil\ReviewQualitiesProvider;

class CardUpdate
{

    /**
     * @var \AppBundle\ReviewUtil\ReviewQualitiesProvider
     */
    private $reviewQualitiesProvider;

    /**
     * CardList constructor.
     * @param \AppBundle\ReviewUtil\ReviewQualitiesProvider $reviewQualitiesProvider
     */
    public function __construct(ReviewQualitiesProvider $reviewQualitiesProvider)
    {
        $this->reviewQualitiesProvider = $reviewQualitiesProvider;
    }

    /**
     * @Route(
     *     name="api_cards_put_item",
     *     path="/cards/{id}",
     *     defaults={"_api_resource_class"="AppBundle\Entity\Card", "_api_item_operation_name"="put"}
     * )
     * @Method("PUT")
     * @param $data \AppBundle\Entity\Card
     * @return \AppBundle\Entity\Card
     */
    public function __invoke($data)
    {

        $data->setReviewQualities(
            $this->reviewQualitiesProvider->get()
        );

        if ($data->getMinutesTilNextReview()) {
            // seems like you need to create a new \DateTime, otherwise changes are not detected?!
            $newDate = new \DateTime();
            $newDate->setTimestamp($newDate->getTimestamp() + ($data->getMinutesTilNextReview() * 60));
            $data->setReviewDate($newDate);
        }

        return $data;
    }


}
