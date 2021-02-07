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
         * @Route("/admin/property/{id}", name="admin_property_edit", methods={"POST|GET"})
         * @param Property $property
         * @param Request  $request
         * @return Response
         */
        public function edit(Property $property, Request $request):Response{
            $form=$this->createForm(PropertyType::class,$property);
            $form->handleRequest($request);

            if($form->isSubmitted()&& $form->isValid()){
                $this->em->persist($property);
                $this->em->flush();
                $this->addFlash('success', 'Le bien à été modifié');
                return $this->redirectToRoute('admin_property_index');
            }
            return $this->render("admin/edit.html.twig",[
                    'property'=>$property,
                    'form'=>$form->createView(),
                    'current_menu'=>'property'
                ]);
        }

        /**
         * @Route("/admin/property/{id}", name="admin_property_delete", methods={"DELETE"})
         * @param Property $property
         * @param          $request
         *
         * @return Response
         */
        public function delete(Property $property, Request $request):Response{
            if($this->isCsrfTokenValid('delete'.$property->getId(), $request->get('_csrf'))){
            $this->em->remove($property);
            $this->em->flush();
            }
            $this->addFlash('success', 'Le bien à été supprimé!');
            return $this->redirectToRoute('admin_property_index');
        }

    }