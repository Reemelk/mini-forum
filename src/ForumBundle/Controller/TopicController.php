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
    use ForumBundle\Form\Topic\TopicType;
    use ForumBundle\Form\Topic\ThreadType;
    use ForumBundle\Form\Thread\ReplyType;

    class TopicController extends Controller
    {
        /**
         * @Route("/forum/{category}/{subcategory}/create-topic", name="create_topic")
         * @Method("GET")
         * @Security("has_role('ROLE_USER')")
         */
        public function displayAction($category, $subcategory)
        {
            $create_topic = $this->createForm(ThreadType::class);

            return $this->render('default/create_topic.html.twig', ['create_topic' => $create_topic->createView()]);
        }

        /**
         * @Route("/forum/{category}/{subcategory}/create-topic")
         * @Method("POST")
         * @Security("has_role('ROLE_USER')")
         */
        public function createTopicAction($category, $subcategory, Request $request)
        {
            $data = $request->request->get('thread');
            $obj_subcategory = $this->getDoctrine()->getRepository('ForumBundle:Subcategory')->findOneBy(['hyphenation' => $subcategory]);
            $new_topic = new Topic();
            $topic_thread = new Thread();
            $new_topic->setUser($this->getUser())
                ->setSubcategory($obj_subcategory)
                ->setTitle($data['topic']['title'])
                ->setHyphenation(strtolower(str_replace([" ", "'"],"-",$data['topic']['title'])));
            $topic_thread->setUser($new_topic->getUser())
                ->setTopic($new_topic)
                ->setTopic($new_topic)
                ->setText($data['text']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($new_topic);
            $em->persist($topic_thread);
            $em->flush();

            return $this->redirectToRoute('forum_topic', [
                'category' => $category,
                'subcategory' => $subcategory,
                'topic' => $new_topic->getHyphenation()
            ]);
        }
    }
