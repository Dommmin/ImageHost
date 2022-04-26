<?php

namespace App\Event;

use JetBrains\PhpStorm\ArrayShape;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EventErrorSubscriber implements EventSubscriberInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[ArrayShape([LoginErrorEvent::NAME => "string"])]
    public static function getSubscribedEvents(): array
    {
        return [
          LoginErrorEvent::NAME => 'onLoginError'
        ];
    }

    public function onLoginError(LoginErrorEvent $event): void
    {
        $this->logger->info('Wrong username or password' . $event->getUser()->getUsername());
    }
}
