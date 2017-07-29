<?php
namespace AppBundle\Action;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
//use AppBundle\Calculator;

class CardUpdate
{
    //private $calculator;

/*    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }*/

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
        // dump($data);
        //$data->setEFactor($this->calculator->calcNewEFactor());

      //  if ($data->getMinutesTilNextReview()) {
            // seems like you need to create a new \DateTime, otherwise changes are not detected?!
       //     $newDate = new \DateTime();
       //     $newDate->setTimestamp($newDate->getTimestamp() + ($data->getMinutesTilNextReview() * 60));
       //     $data->setReviewDate($newDate);
      //  }


        return $data;
    }


}
