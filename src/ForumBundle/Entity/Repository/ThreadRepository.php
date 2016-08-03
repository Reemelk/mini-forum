<?php

    namespace ForumBundle\Entity\Repository;

    /**
     * ThreadRepository
     *
     * This class was generated by the Doctrine ORM. Add your own custom
     * repository methods below.
     */
    class ThreadRepository extends \Doctrine\ORM\EntityRepository
    {
        public function findAllThreads($subcategory, $topic)
        {
            return $this->getEntityManager()
                ->createQuery('SELECT tr, to, s FROM ForumBundle:Thread tr JOIN tr.topic to JOIN to.subcategory s WHERE s.hyphenation = :subcategory AND to.hyphenation = :topic')
                ->setParameter('subcategory', $subcategory)
                ->setParameter('topic', $topic)
                ->getResult();
        }
    }
