<?php
    namespace  App\Controller;

    use App\Entity\Property;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class PropertyController extends AbstractController {


        /**
         * @Route("/bien", name="property_index", methods={"GET"})
         * @return Response
         */
        public function index ():Response
        {
            $property=new Property();
            $property->setAddress('lorem ipsum')
                ->setBedrooms(3)
                ->setCity('Kébili')
                ->setDescription('description ...........')
                ->setFloor(3)
                ->setRooms(3)
                ->setSurface(200)
                ->setHeat(2)
                ->setPostalCode('4230 SK ')
                ->setTitle('property 1');

            $em = $this->getDoctrine()->getManager();
            $em->persist($property);
            $em->flush();

            return $this->render("property/index.html.twig", [
                'current_menu'=>'property'
            ]);
        }

    }