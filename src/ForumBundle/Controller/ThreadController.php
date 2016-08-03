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
    use ForumBundle\Entity\Topic;
    use ForumBundle\Entity\Thread;
    use ForumBundle\Form\Subcategory\createSubcategoryType;
    use ForumBundle\Form\Subcategory\updateSubcategoryType;
    use ForumBundle\Form\Subcategory\deleteSubcategoryType;
    use ForumBundle\Form\Thread\ReplyType;

    class ThreadController extends Controller
    {
        /**
         * @Route("/forum/{category}/{subcategory}/{topic}", name="forum_topic")
         * Method("GET")
         * @Security("has_role('ROLE_USER')")
         */
        public function topicAction($category, $subcategory, $topic)
        {
            $em = $this->getDoctrine()->getManager();
            $threads = $em->getRepository('ForumBundle:Thread')->findAllThreads($subcategory, $topic);
            $topic = $em->getRepository('ForumBundle:Topic')->findOneBy(['hyphenation' => $topic]);
            $new_reply = $this->createForm(ReplyType::class);

            return $this->render('default/topic.html.twig', [
                'topic' => $topic,
                'threads' => $threads,
                'new_reply' => $new_reply->createView()
            ]);
        }

        /**
         * @Route("/forum/{category}/{subcategory}/{topic}", name="post_topic")
         * @Method("POST")
         * @Security("has_role('ROLE_USER')")
         */
        public function replyAction($category, $subcategory, $topic, Request $request)
        {
            $data = $request->request->get('reply');
            dump($data);
            $objTopic = $this->getDoctrine()->getRepository('ForumBundle:Topic')->findOneBy(['hyphenation' => $topic]);
            $new_thread = new Thread();
            $new_thread->setUser($this->getUser())
                ->setTopic($objTopic)
                ->setText($data['text']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($new_thread);
            $em->flush();

            return $this->render('default/forum.html.twig');
        }
    }
