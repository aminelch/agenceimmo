<?php
    namespace App\Controller\Admin ;

    use App\Entity\Property;
    use App\Form\PropertyType;
    use App\Repository\PropertyRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class AdminPropertyController extends AbstractController
    {
        /**
         * @var PropertyRepository
         */
        private $repository;

        public function __construct(PropertyRepository $repository)
        {
            $this->repository=$repository;
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
         * @Route("/admin/{id}", name="admin_property_edit")
         * @param Property $property
         *
         * @return Response
         */
        public function edit(Property $property):Response{
            $form= $this->createForm(PropertyType::class, $property);

            $current_menu='property';
                return $this->render("admin/edit.html.twig",[
                    'property'=>$property,
                    'current_menu'=>$current_menu,
                    'form'=>$form->createView()
                ]);
        }

    }