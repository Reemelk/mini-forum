<?php

    namespace ForumBundle\Controller;

    use ForumBundle\Entity\Thread;
    use ForumBundle\Form\Thread\ReplyType;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\Validator\Constraints\DateTime;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use ForumBundle\Entity\Category;
    use ForumBundle\Entity\Subcategory;
    use ForumBundle\Form\Category\createCategoryType;
    use ForumBundle\Form\Category\updateCategoryType;
    use ForumBundle\Form\Category\deleteCategoryType;
    use ForumBundle\Form\Subcategory\createSubcategoryType;
    use ForumBundle\Form\Subcategory\updateSubcategoryType;
    use ForumBundle\Form\Subcategory\deleteSubcategoryType;
    use ForumBundle\Form\User\updateUserType;
    use ForumBundle\Form\User\banUserType;

    class DisplayController extends Controller
    {
        /**
         * @Route("/", name="homepage")
         */
        public function indexAction()
        {
            return $this->render('default/index.html.twig');
        }

        /**
         * @Route("/forum", name="forum")
         * @Security("has_role('ROLE_USER')")
         */
        public function forumAction()
        {
            $em = $this->getDoctrine()->getManager();
            $categories = $em->getRepository('ForumBundle:Category')->findAllCategories();
            $subcategories = $em->getRepository('ForumBundle:Subcategory')->findAllSubcategories();
            $users = $em->getRepository('ForumBundle:User')->findOnlineUsers();
            $last_topics = $em->getRepository('ForumBundle:Thread')->findLastTopics();

            return $this->render('default/forum.html.twig', [
                'categories' => $categories,
                'subcategories' => $subcategories,
                'users' => $users,
                'last_topics' => $last_topics
            ]);
        }

        /**
         * @Route("/forum/dashboard", name="dashboard")
         * @Security("has_role('ROLE_ADMIN')")
         */
        public function dashboardAction()
        {
            return $this->render('default/dashboard.html.twig');
        }

        /**
         * @Route("/forum/dashboard/subcategory-administration", name="dashboard_subcategory")
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
         * @Route("/forum/{category}/{subcategory}", name="forum_topics")
         * @Method("GET")
         * @Security("has_role('ROLE_USER')")
         */
        public function forumTopicsAction($category, $subcategory)
        {
            $em = $this->getDoctrine()->getManager();
            $topics = $em->getRepository('ForumBundle:Topic')->findAllTopics($category, $subcategory);

            return $this->render('default/topics.html.twig', [
                'topics' => $topics,
                'category' => $category,
                'subcategory' => $subcategory
            ]);
        }

        /**
         * @Route("/forum/users/dashboard/administration", name="dashboard_users")
         * @Method("GET")
         * @Security("has_role('ROLE_ADMIN')")
         */
        public function displayFormsUserAction()
        {
            $update_user = $this->createForm(updateUserType::class);
            $ban_user = $this->createForm(banUserType::class);

            return $this->render('default/dashboard_user.html.twig', [
                'update_user' => $update_user->createView(),
                'ban_user' => $ban_user->createView()
            ]);
        }
    }
