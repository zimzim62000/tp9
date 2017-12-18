<?php
namespace App\EventListener;
use App\AppEvent;
use App\Entity\NoteSkin;
use App\Event\NoteSkinEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class NoteSkinSubscriber implements EventSubscriberInterface
{
    private $em;
    private $session;
    private $nbMaxnote;
    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->em = $entityManager;
        $this->session = $session;
    }

    public static function getSubscribedEvents()
    {
        return [
            AppEvent::USER_NOTE_ADD => array('add', 0),
            AppEvent::USER_NOTE_EDIT => array('persist', 0),
            AppEvent::USER_NOTE_DELETE => array('remove', 0),
        ];
    }
    public function add(NoteSkinEvent $noteSkinEvent)
    {
        $entities = $this->em->getRepository(NoteSkin::class)->findBy(
            ['user' => $noteSkinEvent->getNote()->getUser()]
        );
        if(count($entities) < $this->nbMaxnote){
            $this->persist($noteSkinEvent);
        } else{
            $this->session->getFlashBag()->add('error', 'max note reached !');
            $noteSkinEvent->stopPropagation();
        }
    }
    public function persist(NoteSkinEvent $noteSkinEvent)
    {
        $this->em->persist($noteSkinEvent->getNote());
        $this->em->flush();
    }
    public function remove(NoteSkinEvent $noteSkinEvent)
    {
        $this->em->remove($noteSkinEvent->getNote());
        $this->em->flush();
    }
}