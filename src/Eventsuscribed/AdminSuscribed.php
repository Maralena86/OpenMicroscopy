<?php

declare(strict_types=1);

namespace App\Eventsuscribed;

use App\Model\TimestampableInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AdminSuscribed implements EventSubscriberInterface
{
    public static function getSubscribedEvents():array
    {
        return [
            BeforeEntityPersistedEvent::class =>['setEntityCreatedAt'],
            BeforeEntityUpdatedAtEvent::class =>['setEntityUpdatedAt']
        ];
    }
    public function setEntityCreatedAt(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();
        if(!$entity instanceof TimestampableInterface){
            return;
        }
        $entity->setCreatedAt(new \DateTime());
        
    }
    public function setEntityUpdatedAt(BeforeEntityUpdatedEvent $event): void
    {
        $entity = $event->getEntityInstance();
        if(!$entity instanceof TimestampableInterface){
            return;
        }
        $entity->setUpdatedAt(new \DateTime());
        
    }
    
}
