<?php

namespace Ovesco\APMBSBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Ovesco\APMBSBundle\Form\CabaneType;
use Ovesco\APMBSBundle\Entity\Cabane;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RappelController
 * @package Ovesco\FacturationBundle\Controller
 * @Route("/cabane")
 */
class CabaneController extends AbstractController
{
    /**
     * @param Cabane $cabane
     * @Route("/view/{id}", name="ovesco_apmbs_cabane_page")
     */
    public function cabanePageAction(Cabane $cabane) {
        return $this->render('@OvescoAPMBS/cabane/cabane_page.html.twig', [
            'cabane' => $cabane,
            'cabaneForm' => $this->createForm(CabaneType::class, $cabane)->createView(),
        ]);
    }

    /**
     * @Route("/create", name="ovesco_apmbs_cabane_add")
     */
    public function addCabaneAction(Request $request, EntityManagerInterface $manager) {

        $cabane = new Cabane();
        $form = $this->createForm(CabaneType::class, $cabane);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($cabane);
            $manager->flush();
            $this->redirectToRoute('ovesco_apmbs_cabane_page', ['id' => $cabane->getId()]);
        }

        return $this->render('@NetBSCore/generic/form.generic.twig', [
            'header' => 'Nouvelle cabane',
            'form' => $form->createView()
        ]);
    }
}
