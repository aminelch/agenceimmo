<?php
    namespace  App\Controller;

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

    }