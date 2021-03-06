<?php

    namespace ForumBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

    /**
     * @ORM\Entity(repositoryClass="ForumBundle\Entity\Repository\ThreadRepository")
     * @ORM\Table(name="thread",options={"engine"="InnoDB"})
     */
    class Thread
    {
        /**
         * @ORM\ManyToOne(targetEntity="ForumBundle\Entity\User")
         * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
         */
        private $user;

        /**
         * @ORM\ManyToOne(targetEntity="ForumBundle\Entity\Topic")
         * @ORM\JoinColumn(name="topic_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
         */
        private $topic;

        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $id;

        /**
         * @ORM\Column(type="text")
         */
        private $text;

        /**
         * @ORM\Column(type="datetime")
         */
        private $timestamp;

        /**
         * @ORM\ManyToOne(targetEntity="ForumBundle\Entity\User")
         * @ORM\JoinColumn(name="user_id_update", referencedColumnName="id")
         */
        private $lastUpdateBy;

        /**
         * @ORM\Column(type="datetime", nullable=true)
         */
        private $lastUpdateAt;

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
         * Set text
         *
         * @param string $text
         *
         * @return Thread
         */
        public function setText($text)
        {
            $this->text = $text;

            return $this;
        }

        /**
         * Get text
         *
         * @return string
         */
        public function getText()
        {
            return $this->text;
        }

        /**
         * Set timestamp
         *
         * @param \DateTime $timestamp
         *
         * @return Thread
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
         * @return Thread
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
         * Set topic
         *
         * @param \ForumBundle\Entity\Topic $topic
         *
         * @return Thread
         */
        public function setTopic(\ForumBundle\Entity\Topic $topic)
        {
            $this->topic = $topic;

            return $this;
        }

        /**
         * Get topic
         *
         * @return \ForumBundle\Entity\Topic
         */
        public function getTopic()
        {
            return $this->topic;
        }

        public function __toString()
        {
            return $this->text;
        }
    
        /**
         * Set lastUpdateAt
         *
         * @param \DateTime $lastUpdateAt
         *
         * @return Thread
         */
        public function setLastUpdateAt($lastUpdateAt)
        {
            $this->lastUpdateAt = $lastUpdateAt;

            return $this;
        }

        /**
         * Get lastUpdateAt
         *
         * @return \DateTime
         */
        public function getLastUpdateAt()
        {
            return $this->lastUpdateAt;
        }

        /**
         * Set lastUpdateBy
         *
         * @param \ForumBundle\Entity\User $lastUpdateBy
         *
         * @return Thread
         */
        public function setLastUpdateBy(\ForumBundle\Entity\User $lastUpdateBy = null)
        {
           if (($this->user != $lastUpdateBy && $this->lastUpdateBy == null) || ($this->user == $lastUpdateBy && $this->lastUpdateBy != null))
               $this->lastUpdateBy = $lastUpdateBy;

            return $this;
        }

        /**
         * Get lastUpdateBy
         *
         * @return \ForumBundle\Entity\User
         */
        public function getLastUpdateBy()
        {
            return $this->lastUpdateBy;
        }
    }
