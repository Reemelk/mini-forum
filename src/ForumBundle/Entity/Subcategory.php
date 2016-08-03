<?php

    namespace ForumBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

    /**
     * @ORM\Entity(repositoryClass="ForumBundle\Entity\Repository\SubcategoryRepository")
     * @ORM\Table(name="subcategory")
     * @UniqueEntity("title", message="This subcategory name is already used !")
     */
    class Subcategory
    {
        /**
         * @ORM\ManyToOne(targetEntity="ForumBundle\Entity\User")
         * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
         */
        private $user;

        /**
         * @ORM\ManyToOne(targetEntity="ForumBundle\Entity\Category")
         * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
         */
        private $category;

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
         * @ORM\Column(type="string")
         */
        private $description;

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
         * @return Subcategory
         */
        public function setTitle($title)
        {
            if(!empty($title))
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
         * Set description
         *
         * @param string $description
         *
         * @return Subcategory
         */
        public function setDescription($description)
        {
            if (!empty($description))
                $this->description = $description;

            return $this;
        }

        /**
         * Get description
         *
         * @return string
         */
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * Set isPosted
         *
         * @param boolean $isPosted
         *
         * @return Subcategory
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
         * @return Subcategory
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
         * Set category
         *
         * @param \ForumBundle\Entity\Category $category
         *
         * @return Subcategory
         */
        public function setCategory(\ForumBundle\Entity\Category $category)
        {
            $this->category = $category;

            return $this;
        }

        /**
         * Get category
         *
         * @return \ForumBundle\Entity\Category
         */
        public function getCategory()
        {
            return $this->category;
        }
    
        /**
         * Set timestamp
         *
         * @param \DateTime $timestamp
         *
         * @return Subcategory
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
            return '[' . $this->getCategory() . '] ' . $this->title;
        }

        public function getSubcategory()
        {
            $this->title;
        }

    /**
     * Set hyphenation
     *
     * @param string $hyphenation
     *
     * @return Subcategory
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
