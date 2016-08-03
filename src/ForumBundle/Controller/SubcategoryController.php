<?php

    namespace ForumBundle\Controller;
    
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\Validator\Constraints\DateTime;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use ForumBundle\Entity\Category;
    use ForumBundle\Entity\Subcategory;
    use ForumBundle\Form\Subcategory\createSubcategoryType;
    use ForumBundle\Form\Subcategory\updateSubcategoryType;
    use ForumBundle\Form\Subcategory\deleteSubcategoryType;
    use ForumBundle\Form\Topic\ThreadType;

    
    class SubcategoryController extends Controller
    {
        /**
         * @Route("/forum/dashboard/subcategory/administration", name="dashboard_subcategory")
         * @Method("GET")
         * @Security("has_role('ROLE_ADMIN')")
         */
        public function displayFormsSubcategoryAction()
        {
            $create_subcategory = $this->createForm(createSubcategoryType::class);
            $update_subcategory = $this->createForm(updateSubcategoryType::class);
            $delete_subcategory = $this->createForm(deleteSubcategoryType::class);

            return $this->render('default/dashboard_subcategory.html.twig', [
                'create_subcategory' => $create_subcategory->createView(),
                'update_subcategory' => $update_subcategory->createView(),
                'delete_subcategory' => $delete_subcategory->createView()
            ]);
        }

        /**
         * @Route("/forum/dashboard/subcategory/administration")
         * @Method("POST")
         * @Security("has_role('ROLE_ADMIN')")
         */
        public function createAction(Request $request)
        {
            $data = $request->request->get('create_subcategory');
            $em = $this->getDoctrine()->getManager();
            $category = $em->getRepository('ForumBundle:Category')->findOneBy(['id' => $data['category']]);
            $subcategory = new Subcategory();
            $subcategory->setUser($this->getUser())
                ->setTitle($data['title'])
                ->setHyphenation(strtolower(str_replace([" ", "'"],"-",$data['title'])))
                ->setCategory($category)
                ->setDescription($data['description'])
                ->setIsPosted($data['isPosted']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($subcategory);
            $em->flush();
    
            return $this->redirectToRoute('forum');
        }
    
        /**
         * @Route("/forum/dashboard/subcategory/administration")
         * @Method("PUT")
         * @Security("has_role('ROLE_ADMIN')")
         */
        public function updateAction(Request $request)
        {
            $data = $request->request->get('update_subcategory');
            $em = $this->getDoctrine()->getManager();
            $category = $em->getRepository('ForumBundle:Category')->findOneBy(['id' => $data['category']]);
            $update_subcategory = $em->getRepository('ForumBundle:Subcategory')->findOneBy(['id' => $data['subcategory']]);
            $update_subcategory->setUser($this->getUser())
                ->setTitle($data['new_title'])
                ->setHyphenation(str_replace([" ", "'"],"-",$data['new_title']))
                ->setCategory($category)
                ->setDescription($data['new_description'])
                ->setIsPosted($data['isPosted']);
            $em->persist($update_subcategory);
            $em->flush();
    
            return $this->redirectToRoute('forum');
        }
    
        /**
         * @Route("/forum/dashboard/subcategory/administration")
         * @Method("DELETE")
         * @Security("has_role('ROLE_ADMIN')")
         */
        public function deleteAction(Request $request)
        {
            $data = $request->request->get('delete_subcategory');
            $em = $this->getDoctrine()->getManager();
            $delete_category = $em->getRepository('ForumBundle:Subcategory')->findOneBy(['id' => $data['title']]);
            $em->remove($delete_category);
            $em->flush();
    
            return $this->redirectToRoute('forum');
        }
    }
