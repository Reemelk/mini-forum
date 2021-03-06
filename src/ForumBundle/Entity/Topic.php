<?php

    namespace ForumBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

    /**
     * @ORM\Entity(repositoryClass="ForumBundle\Entity\Repository\TopicRepository")
     * @ORM\Table(name="topic",options={"engine"="InnoDB"})
     * @UniqueEntity("title", message="This topic is already used.")
     */
    class Topic
    {
        /**
         * @ORM\ManyToOne(targetEntity="ForumBundle\Entity\User")
         * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
         */
        private $user;

        /**
         * @ORM\ManyToOne(targetEntity="ForumBundle\Entity\Subcategory")
         * @ORM\JoinColumn(name="subcategory_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
         */
        private $subcategory;

        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $id;

        /**
         * @ORM\Column(type="string", unique=true)
         */
        private $title;

        /**
         * @ORM\Column(type="string")
         */
        private $hyphenation;

        /**
         * @ORM\Column(type="datetime")
         */
        private $timestamp;

        //////////////////////////////////////////////
        ////////////Setters & Getters/////////////////
        //////////////////////////////////////////////
        
        public function __construct()
        {
            $this->timestamp = new \DateTime();
        }
    
        /**
         * Get id
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set title
         *
         * @param string $title
         *
         * @return Topic
         */
        public function setTitle($title)
        {
            $this->title = $title;

            return $this;
        }

        /**
         * Get title
         *
         * @return string
         */
        public function getTitle()
        {
            return $this->title;
        }

        /**
         * Set timestamp
         *
         * @param \DateTime $timestamp
         *
         * @return Topic
         */
        public function setTimestamp($timestamp)
        {
            $this->timestamp = $timestamp;

            return $this;
        }

        /**
         * Get timestamp
         *
         * @return \DateTime
         */
        public function getTimestamp()
        {
            return $this->timestamp;
        }

        /**
         * Set user
         *
         * @param \ForumBundle\Entity\User $user
         *
         * @return Topic
         */
        public function setUser(\ForumBundle\Entity\User $user)
        {
            $this->user = $user;

            return $this;
        }

        /**
         * Get user
         *
         * @return \ForumBundle\Entity\User
         */
        public function getUser()
        {
            return $this->user;
        }

        /**
         * Set subcategory
         *
         * @param \ForumBundle\Entity\Subcategory $subcategory
         *
         * @return Topic
         */
        public function setSubcategory(\ForumBundle\Entity\Subcategory $subcategory)
        {
            $this->subcategory = $subcategory;

            return $this;
        }

        /**
         * Get subcategory
         *
         * @return \ForumBundle\Entity\Subcategory
         */
        public function getSubcategory()
        {
            return $this->subcategory;
        }
    
    /**
     * Set hyphenation
     *
     * @param string $hyphenation
     *
     * @return Topic
     */
    public function setHyphenation($hyphenation)
    {
        $this->hyphenation = $hyphenation;

        return $this;
    }

    /**
     * Get hyphenation
     *
     * @return string
     */
    public function getHyphenation()
    {
        return $this->hyphenation;
    }
}
