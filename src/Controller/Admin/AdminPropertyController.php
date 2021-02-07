<?php
    namespace App\Controller\Admin ;

    use App\Entity\Property;
    use App\Form\PropertyType;
    use App\Repository\PropertyRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class AdminPropertyController extends AbstractController
    {
        /**
         * @var PropertyRepository
         */
        private $repository;
        /**
         * @var EntityManagerInterface
         */
        private $em;

        public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
        {
            $this->repository=$repository;
            $this->em = $em;
        }

        /**
         * @Route("/admin", name="admin_property_index", methods={"GET"})
         * @return Response
         */
        public function index():Response{
            $properties = $this->repository->findAll();
            $current_menu='property';
            return $this->render('admin/index.html.twig', [
                'properties'=>$properties,
                'current_menu'=>$current_menu
            ]);
        }


        /**
         * @Route("/admin/property/create", name="admin_property_new", methods={"POST|GET"})
         * @param Request $request
         *
         * @return Response
         */
        public function new (Request $request): Response
        {
            $property=new Property();
            $form = $this->createForm(PropertyType::class, $property);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $this->em->persist($property);
                $this->em->flush();
                return $this->redirectToRoute('admin_property_index');
            }
            
            return $this->render('admin/new.html.twig', [
                'form'=>$form->createView()
            ]);
        }

        /**
         * @Route("/admin/property/{id}", name="admin_property_edit")
         * @param Property $property
         * @param Request  $request
         *
         * @return Response
         */
        public function edit(Property $property, Request $request):Response{
            $form= $this->createForm(PropertyType::class, $property);
            $form->handleRequest($request);
            if($form->isSubmitted()){
                $this->em->flush();
//              dd('form submitted');
                $this->addFlash('success', 'Le bien à été modifié');
                return $this->redirectToRoute('admin_property_index');
            }

            $current_menu='property';
            return $this->render("admin/edit.html.twig",[
                    'property'=>$property,
                    'current_menu'=>$current_menu,
                    'form'=>$form->createView()
                ]);
        }


    }