<?php


namespace App\Form;

use App\Entity\Card;
use App\Entity\UserCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


class UserCardType extends AbstractType
{
    private $token;

    /**
     * UserCardType constructor.
     * @param $token
     */
    public function __construct(TokenStorage $token)
    {
        $this->token = $token;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UserCard::class,
            'card' => null));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->card = $options['card'];
        $builder
            ->add("actionPoint")
            ->add("attack")
            ->add('defence')
            ->addEventListener(FormEvents::PRE_SET_DATA,
                array($this, 'onPreSetData'));
    }

    public function onPreSetData(FormEvent $event)
    {
        $userCard = $event->getData();
        $form = $event->getForm();
        if ($userCard->getId() !== null) {

        }
        $userCard->setUser($this->token->getToken()->getUser());
        $form->add('submit', SubmitType::class);
    }

    public function newUserCard(Request $request, Card $card)
    {
        $userCard = new UserCard();
        $userCard->setCard($card);
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(UserCardType::class, $userCard, ['card' => $card->getId()]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($userCard);
            $em->flush();
            return $this->redirectToRoute("userCard_index");
        }
        return $this->render('UserCard/new.html.twig', array('form' => $form->createView()));
    }



}
