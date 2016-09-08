<?php

    namespace ForumBundle\Controller;

    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\Validator\Constraints\DateTime;
    use Symfony\Component\HttpFoundation\Request;
    use ForumBundle\Entity\Topic;
    use ForumBundle\Entity\Thread;
    use ForumBundle\Form\Thread\ReplyType;
    use ForumBundle\Form\Thread\EditType;

    class ThreadController extends Controller
    {
        /**
         * @Route("/forum/{category}/{subcategory}/{topic}", name="forum_topic")
         * @Method("GET")
         * @Security("has_role('ROLE_USER')")
         */
        public function topicAction($category, $subcategory, $topic)
        {
            $em = $this->getDoctrine()->getManager();
            $threads = $em->getRepository('ForumBundle:Thread')->findAllThreads($subcategory, $topic);
            $topic = $em->getRepository('ForumBundle:Topic')->findOneBy(['hyphenation' => $topic]);
            $new_reply = $this->createForm(ReplyType::class);

            return $this->render('default/topic.html.twig', [
                'category' => $category,
                'subcategory' => $subcategory,
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
            $objTopic = $this->getDoctrine()->getRepository('ForumBundle:Topic')->findOneBy(['hyphenation' => $topic]);
            $new_thread = new Thread();
            $new_thread->setUser($this->getUser())
                ->setTopic($objTopic)
                ->setText($data['reply']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($new_thread);
            $em->flush();

            return $this->redirectToRoute('forum_topic', [
                'category' => $category,
                'subcategory' => $subcategory,
                'topic' => $topic
            ]);
        }

        /**
         * @Route("/forum/{category}/{subcategory}/{topic}/{id}/edit", name="get_edit_message")
         * @Method("GET")
         * @Security("has_role('ROLE_USER')")
         */
        public function ThreadAction($category, $subcategory, $topic, $id)
        {

            $this_thread = $this->getDoctrine()->getRepository('ForumBundle:Thread')->find($id);
            $edit_message = $this->createForm(EditType::class);

            return $this->render('default/edit_message.html.twig', [
                'category' => $category,
                'subcategory' => $subcategory,
                'topic' => $topic,
                'id' => $id,
                'message' => $this_thread,
                'edit_message' => $edit_message->createView()
            ]);
        }

        /**
         * @Route("/forum/{category}/{subcategory}/{topic}/{id}/edit", name="put_edit_message")
         * @Method("PUT")
         * @Security("has_role('ROLE_USER')")
         */
        public function editAction($category, $subcategory, $topic, $id, Request $request)
        {
            $data = $request->request->get('edit');
            $this_thread = $this->getDoctrine()->getRepository('ForumBundle:Thread')->find($id);
            $this_thread->setLastUpdateBy($this->getUser())
                ->setText($data['edit'])
                ->setLastUpdateAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($this_thread);
            $em->flush();

            return $this->redirectToRoute('forum_topic', [
                'category' => $category,
                'subcategory' => $subcategory,
                'topic' => $topic
            ]);
        }
    }
