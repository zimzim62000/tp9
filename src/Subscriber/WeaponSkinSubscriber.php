<?php
/**
 * Created by PhpStorm.
 * User: maxime.maillot
 * Date: 18/12/17
 * Time: 17:21
 */

namespace App\Subscriber;


use App\AppEvent;
use App\Event\WeaponSkinEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class WeaponSkinSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManager
     */
    private $manager;
    /**
     * UserCardSubscriber constructor.
     * @param EntityManager $manager
     */
    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return array(
            AppEvent::NOTE_SKIN_ADD => 'add',
            AppEvent::NOTE_SKIN_EDIT => 'edit',
            AppEvent::NOTE_SKIN_DELETE => 'delete'
        );
    }

    public function add(WeaponSkinEvent $weaponSkinEvent)
    {
        $this->manager->persist($weaponSkinEvent->getWeaponSkin());
        $this->manager->flush();
    }
}