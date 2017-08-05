<?php
namespace AppBundle\Action;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardCreate
{
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Route(
     *     name="api_cards_post_collection",
     *     path="/cards",
     *     defaults={"_api_resource_class"="AppBundle\Entity\Card", "_api_collection_operation_name"="post"}
     * )
     * @Method("POST")
     * @param $data \AppBundle\Entity\Card
     * @return \AppBundle\Entity\Card
     */
    public function __invoke($data)
    {

        $data->setReviewDate(new \DateTime());

        if ($this->kernel->getEnvironment() === 'test'){
            $data->setReviewDate(
                $data->getReviewDate()->modify('2000-07-29T11:43:16+00:00')
            );
        }

        return $data;
    }

}
