<?php
namespace App\Controller;

use App\Entity\WeaponSkin;
use App\WeaponSkinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class PlayerController
 * @package App\Controller
 * @Route("/skin")
 */
class SkinController extends Controller
{
    /**
     *  @Route("/new", name="entity_weaponskin_new")
     */
    public function newPlayer(Request $request){

        $weaponskin = new WeaponSkin();
        $form = $this->createForm(WeaponSkinType::class, $weaponskin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($weaponskin);
            $em->flush();
            return $this->redirect($this->generateUrl('entity_weaponskin_index'));
        }
        return $this->render('entity/weaponskin/index.html.twig', array('form' => $form->createView()));
    }

    /**
     *  @Route("/index", name="entity_weaponskin_index")
     */
    public function index(){
        $em = $this->getDoctrine()->getManager();
        $weaponskins = $em->getRepository(WeaponSkin::class)->findAll();

        return $this->render('entity/weaponskin/weaponskin.html.twig', array("weaponskin" => $weaponskins));
    }
    /**
     * @return Response
     * @Route("/show/{id}", name="entity_weaponskin_show")
     */
    public function show($id){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(WeaponSkin::class);
        $weaponskin = $repo->find($id);
        return $this->render('entity/weaponskin/show.html.twig', array('weaponskin' => $weaponskin));
    }

}