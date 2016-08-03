<?php

    namespace ForumBundle\Entity;

    use FOS\UserBundle\Model\User as BaseUser;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity
     * @ORM\Table(name="fos_user")
     */
    class User extends BaseUser
    {
        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $id;

        /**
         * @ORM\Column(type="datetime", nullable=true)
         */
        protected $locked_for;
        
        /**
         * @ORM\Column(type="string", nullable=true)
         */
        protected $locked_message;




        public function __construct()
        {
            parent::__construct();
        }

        public function setEmail($email)
        {   
            if(!empty($email))
                $this->email = $email;

            return $this;
        }

        public function setUsername($username)
        {
            if(!empty($username))
                $this->username = $username;

            return $this;
        }
        
        /**
         * Set lockedFor
         *
         * @param \DateTime $lockedFor
         *
         * @return User
         */
        public function setLockedFor($lockedFor = null)
        {
            $this->locked_for = $lockedFor;

            return $this;
        }

        /**
         * Get lockedFor
         *
         * @return \DateTime
         */
        public function getLockedFor()
        {
            return $this->locked_for;
        }

        /**
         * Set lockedMessage
         *
         * @param string $lockedMessage
         *
         * @return User
         */
        public function setLockedMessage($lockedMessage = null)
        {
            $this->locked_message = $lockedMessage;

            return $this;
        }

        /**
         * Get lockedMessage
         *
         * @return string
         */
        public function getLockedMessage()
        {
            return $this->locked_message;
        }
    }
