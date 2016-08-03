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
    use ForumBundle\Form\Category\createCategoryType;
    use ForumBundle\Form\Category\deleteCategoryType;
    use ForumBundle\Form\Category\updateCategoryType;

    class CategoryController extends Controller
    {
        /**
         * @Route("/forum/dashboard/category/administration", name="dashboard_category")
         * @Method("GET")
         * @Security("has_role('ROLE_ADMIN')")
         */
        public function displayFormsCategoryAction()
        {
            $create_category = $this->createForm(createCategoryType::class);
            $update_category = $this->createForm(updateCategoryType::class);
            $delete_category = $this->createForm(deleteCategoryType::class);

            return $this->render('default/dashboard_category.html.twig', [
                'create_category' => $create_category->createView(),
                'update_category' => $update_category->createView(),
                'delete_category' => $delete_category->createView()
            ]);
        }

        /**
         * @Route("/forum/dashboard/category/administration", name="dashboard_category_post")
         * @Method("POST")
         * @Security("has_role('ROLE_ADMIN')")
         */
        public function createAction(Request $request)
        {
            $data = $request->request->get('create_category');
            $category = new Category();
            $category->setUser($this->getUser())
                ->setTitle($data['title'])
                ->setHyphenation(strtolower(str_replace([" ", "'"],"-",$data['title'])))
                ->setIsPosted($data['isPosted']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('forum');
        }

        /**
         * @Route("/forum/dashboard/category/administration", name="dashboard_category_put")
         * @Method("PUT")
         * @Security("has_role('ROLE_ADMIN')")
         */
        public function updateAction(Request $request)
        {
            $data = $request->request->get('update_category');
            $em = $this->getDoctrine()->getManager();
            $update_category = $em->getRepository('ForumBundle:Category')->findOneBy(['id' => $data['title']]);
            $update_category->setUser($this->getUser())
                ->setTitle($data['new_name'])
                ->setHyphenation(strtolower(str_replace([" ", "'"],"-",$data['new_name'])))
                ->setIsPosted($data['isPosted']);
            $em->persist($update_category);
            $em->flush();

            return $this->redirectToRoute('forum');
        }

        /**
         * @Route("/forum/dashboard/category/administration", name="dashboard_category_delete")
         * @Method("DELETE")
         * @Security("has_role('ROLE_ADMIN')")
         */
        public function deleteAction(Request $request)
        {
            $data = $request->request->get('delete_category');
            $em = $this->getDoctrine()->getManager();
            $delete_category = $em->getRepository('ForumBundle:Category')->findOneBy(['id' => $data['title']]);
            $em->remove($delete_category);
            $em->flush();

            return $this->redirectToRoute('forum');
        }
    }
