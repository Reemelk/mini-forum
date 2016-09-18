<?php

    namespace ForumBundle\Controller;


    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class TwigController extends Controller
    {
        public function BoardStatisticsAction()
        {
            $em = $this->getDoctrine()->getManager();
            $users_active = $em->getRepository('ForumBundle:User')->findOnlineUsers();
            $total_user = $em->getRepository('ForumBundle:User')->findTotalUser();
            $last_registered = $em->getRepository('ForumBundle:User')->findLastUserRegistered();


            return $this->render(':default/render:forum_info.html.twig', [
                'users' => $users_active,
                'total_user' => $total_user,
                'last_registered' => $last_registered
            ]);
        }
    }