<?php

    namespace ForumBundle\EventListener;

    use ForumBundle\Entity\User;
    use FOS\UserBundle\FOSUserEvents;
    use FOS\UserBundle\Event\UserEvent;
    use FOS\UserBundle\Model\UserManagerInterface;
    use FOS\UserBundle\Model\UserInterface;
    use Symfony\Component\EventDispatcher\EventSubscriberInterface;
    use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
    use Symfony\Component\Security\Http\SecurityEvents;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;


    class BanUserListener implements EventSubscriberInterface
    {
        protected $userManager;
        protected $session;

        public function __construct(UserManagerInterface $userManager)
        {
            $this->userManager = $userManager;
        }

        public static function getSubscribedEvents()
        {
            return array(
                FOSUserEvents::SECURITY_IMPLICIT_LOGIN => 'onImplicitLogin',
                SecurityEvents::INTERACTIVE_LOGIN => 'onSecurityInteractiveLogin',
            );
        }

        public function onImplicitLogin(UserEvent $event)
        {
            $user = $event->getUser();
            if ($user instanceof User) {
                $time_atm = new \DateTime();
                if ($user->isLocked() && $user->getLockedTime() > $time_atm) {
                    $this->addFlash('warning', 'You have been banned.');
                    return $this->redirectToRoute('logout');
                }
            }
        }

        public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
        {
            $user = $event->getAuthenticationToken()->getUser();
            if ($user instanceof UserInterface) {
                //////
            }
        }
    }
