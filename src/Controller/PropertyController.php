<?php
    namespace  App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class PropertyController extends AbstractController {


        /**
         * @Route("/bien", name="property_index", methods={"GET"})
         * @return Response
         */
        public function show ():Response
        {
            return $this->render("property/index.html.twig", [
                'current_menu'=>'property'
            ]);
        }

    }