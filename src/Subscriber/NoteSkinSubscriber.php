<?php
namespace App\Subscriber;
use App\Event\AppEvent;
use App\Event\SkinNoteEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
class NoteSkinSubscriber implements EventSubscriberInterface
{
    private $manager;
    public function __construct(\Doctrine\ORM\EntityManagerInterface $manager) // Il faut typer !!
    {
        $this->manager = $manager;
    }
    public static function getSubscribedEvents()
    {
        return array(
            AppEvent::SKIN_NOTE_ADD => 'skinNoteAdd',
            AppEvent::SKIN_NOTE_EDIT => 'skinNoteEdit',
            AppEvent::SKIN_NOTE_DELETE => 'skinNoteDelete',
        );
    }
    public function skinNoteAdd(SkinNoteEvent $skinNoteEvent){

        mail('admin@admin.fr',"Ajout d'une note","Une note viens d'etre ajouter !");

        $skinNoteEvent = $skinNoteEvent->getSkinnote();
        $this->manager->persist($skinNoteEvent);
        $this->manager->flush();
    }
    public function skinNoteEdit(SkinNoteEvent $skinNoteEvent){
        $skinNoteEvent = $skinNoteEvent->getSkinnote();
        $this->manager->persist($skinNoteEvent);
        $this->manager->flush();
    }
    public function skinNoteDelete(SkinNoteEvent $skinNoteEvent){
        $skinNoteEvent = $skinNoteEvent->getSkinnote();
        $this->manager->remove($skinNoteEvent);
        $this->manager->flush();
    }
}