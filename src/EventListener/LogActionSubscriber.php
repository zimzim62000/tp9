<?php
namespace App\EventListener;
use App\AppEvent;
use App\Entity\LogAction;
use App\Event\NoteSkinEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
class LogActionSubscriber implements EventSubscriberInterface
{
    private $em;
    private $logAction;
    private $token;
    public function __construct(EntityManagerInterface $entityManager, TokenStorageInterface $token, LogAction $logAction)
    {
        $this->em = $entityManager;
        $this->logAction = $logAction;
        $this->token = $token;
    }
    public static function getSubscribedEvents()
    {
        return [
            AppEvent::USER_NOTE_ADD => array('add', -255),
            AppEvent::USER_NOTE_EDIT => array('update', -255),
            AppEvent::USER_NOTE_DELETE => array('remove', -255),
        ];
    }
    public function add(NoteSkinEvent $noteSkinEvent)
    {
        $this->persist($noteSkinEvent, 'ADD');
    }
    public function update(NoteSkinEvent $noteSkinEvent)
    {
        $this->persist($noteSkinEvent, 'UPDATE');
    }
    public function remove(NoteSkinEvent $noteSkinEvent)
    {
        $this->persist($noteSkinEvent, 'DELETE');
    }
    public function persist(NoteSkinEvent $noteSkinEvent, $type)
    {
        $date = new \DateTime('now');
        $this->logAction->setLog($date->format('d/m/Y h:i:s') . ' : ' . $type . ' card ' .
            $noteSkinEvent->getUserCard()->getCard()->getName() . ' by '
            . $this->token->getToken()->getUser()->getEmail());
        $this->em->persist($this->logAction);
        $this->em->flush();
    }
}