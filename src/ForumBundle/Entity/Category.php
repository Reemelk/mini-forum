<?php

    namespace ForumBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

    /**
     * @ORM\Entity(repositoryClass="ForumBundle\Entity\Repository\CategoryRepository")
     * @ORM\Table(name="category")
     * @UniqueEntity("title", message="This category name is already used !")
     */
    class Category
    {
        /**
         * @ORM\ManyToOne(targetEntity="ForumBundle\Entity\User")
         * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
         */
        private $user;

        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $id;

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

        /**
         * @ORM\Column(type="boolean")
         */
        private $isPosted;

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
         * @return Category
         */
        public function setTitle($title)
        {
            if (!empty($title))
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
         * Set isPosted
         *
         * @param boolean $isPosted
         *
         * @return Category
         */
        public function setIsPosted($isPosted)
        {
            $this->isPosted = $isPosted;

            return $this;
        }

        /**
         * Get isPosted
         *
         * @return boolean
         */
        public function getIsPosted()
        {
            return $this->isPosted;
        }

        /**
         * Set user
         *
         * @param \ForumBundle\Entity\User $user
         *
         * @return Category
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
         * Set timestamp
         *
         * @param \DateTime $timestamp
         *
         * @return Category
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

        public function __toString() 
        {
            return $this->title;
        }
    
    /**
     * Set hyphenation
     *
     * @param string $hyphenation
     *
     * @return Category
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
