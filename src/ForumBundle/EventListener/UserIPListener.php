<?php

    namespace ForumBundle\EventListener;

    use FOS\UserBundle\FOSUserEvents;
    use FOS\UserBundle\Event\UserEvent;
    use FOS\UserBundle\Model\UserManagerInterface;
    use FOS\UserBundle\Model\UserInterface;
    use Symfony\Component\EventDispatcher\EventSubscriberInterface;
    use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
    use Symfony\Component\Security\Http\SecurityEvents;
    use Symfony\Component\HttpFoundation\RequestStack;

    class UserIPListener implements EventSubscriberInterface
    {
        private $userManager;
        private $requestStack;

        public function __construct(UserManagerInterface $userManager, RequestStack $requestStack)
        {
            $this->userManager = $userManager;
            $this->requestStack = $requestStack;
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

            $ip[] = $this->requestStack->getCurrentRequest()->getClientIp();
            $user->setUserIP($ip);
            $this->userManager->updateUser($user);
        }

        public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
        {
            $user = $event->getAuthenticationToken()->getUser();

            if ($user instanceof UserInterface) {
                $ip[] = $this->requestStack->getCurrentRequest()->getClientIp();
                $user->setUserIP($ip);
                $this->userManager->updateUser($user);
            }
        }
    }