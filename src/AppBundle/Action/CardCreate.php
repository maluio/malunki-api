<?php
namespace AppBundle\Action;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use AppBundle\Entity\Image;

class CardCreate
{
    private $kernel;
    protected $requestStack;

    public function __construct(KernelInterface $kernel, RequestStack $requestStack)
    {
        $this->kernel = $kernel;
        $this->requestStack = $requestStack;
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
        $request = $this->requestStack->getCurrentRequest();

        $content = json_decode($request->getContent(), true);

        if (isset($content['images'])){
            foreach ($content['images'] as $image){
                $imgNew = new Image();
                $imgNew->setUrl($image['url']);
                $data->addImage($imgNew);
            }
        }

        $data->setReviewDate(new \DateTime());

        if ($this->kernel->getEnvironment() === 'test'){
            $data->setReviewDate(
                $data->getReviewDate()->modify('2000-07-29T11:43:16+00:00')
            );
        }

        return $data;
    }

}
