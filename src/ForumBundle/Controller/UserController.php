<?php

    namespace ForumBundle\Controller;

    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\Validator\Constraints\DateTime;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use ForumBundle\Entity\User;


    class UserController extends Controller
    {
        /**
         * @Route("/forum/users/dashboard/administration", name="dashboard_users_put")
         * @Method("PUT")
         * @Security("has_role('ROLE_ADMIN')")
         */
        public function UserAction(Request $request)
        {
            $data = $request->request->get('update_user');
            $data2 = $request->request->get('ban_user');

            if (!empty($data)) {
                $user = $this->getDoctrine()->getRepository('ForumBundle:User')->find(intval($data['username']));
                $user->setUsername($data['new_username'])
                    ->setEmail($data['email'])
                    ->setEnabled($data['enabled']);
                $this->get('fos_user.user_manager')->updateCanonicalFields($user);
            } else {
                $user = $this->getDoctrine()->getRepository('ForumBundle:User')->find(intval($data2['username']));
                $user->setLocked($data2['locked'])
                    ->setLockedFor(new \DateTime($data2['locked_for'] . " minutes"))
                    ->setLockedMessage($data2['locked_message']);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->render('default/dashboard.html.twig');
        }
    }
