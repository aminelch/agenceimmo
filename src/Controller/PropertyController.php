<?php
    namespace  App\Controller;

    use App\Entity\Property;
    use App\Repository\PropertyRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class PropertyController extends AbstractController {
        /**
         * @var EntityManagerInterface
         */
        private $em;


        public function __construct(EntityManagerInterface $em)
        {
            $this->em= $em;
        }

        /**
         * @Route("/bien", name="property_index", methods={"GET"})
         * @param PropertyRepository $repository
         *
         * @return Response
         */
        public function index (PropertyRepository $repository):Response
        {

            return $this->render("property/index.html.twig", [
                'current_menu'=>'property'
            ]);
        }

        /**
         * @Route("/biens/{slug}-{id}", name="property_show", requirements={"slug" : "[a-z0-9\-]*", "id":"[0-9]*" } )
         * @param Property $property
         * @param string   $slug
         *
         * @return Response
         */
        public function show (Property $property, string $slug):Response
        {
            if($property->getSlug() !== $slug){
                return $this->redirectToRoute("property_show",[
                    'id'=>$property->getId(),
                    'slug'=>$property->getSlug()
                ],301);
            }
            return $this->render('property/show.html.twig',[
                'property'=>$property,
                'current_menu'=>'property'
            ]);
        }

    }