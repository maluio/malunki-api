<?php
namespace AppBundle\Action;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use \AppBundle\ReviewUtil\ReviewQualitiesProvider;

class CardList
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

        foreach ($data as $card) {
            $card->setReviewQualities(
                $this->reviewQualitiesProvider->get()
            );
        }

        return $data;
    }




}
