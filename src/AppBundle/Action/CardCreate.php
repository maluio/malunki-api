<?php
namespace AppBundle\Action;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

// @todo: use DI to load Kernel service
class CardCreate implements ContainerAwareInterface
{
    private $kernel;

    private $container;

    public function __construct()
    {
        //$this->kernel = $kernel;
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

        //   if ($this->kernel->getEnvironment() === 'test'){
        //     $data->setReviewDate(new \DateTime('2000-07-29T11:43:16+00:00'));
        // }

        if ($this->container->get( 'kernel' )->getEnvironment() === 'test'){
            $data->setReviewDate = $data->getReviewDate()->modify('2000-07-29T11:43:16+00:00');
        }

        $data->setRepetition(0);
        $data->setLastInterval(0);
        $data->setEFactor(0);

        return $data;
    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null)
    {
        $this->container = $container;
    }


}
