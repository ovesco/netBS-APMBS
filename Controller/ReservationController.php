<?php

namespace Ovesco\APMBSBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Ovesco\APMBSBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RappelController
 * @package Ovesco\FacturationBundle\Controller
 * @Route("/reservation")
 */
class ReservationController extends AbstractController
{
    /**
     * @Route("/review", name="ovesco_apmbs_reservations_show")
     */
    public function reviewReservations(Request $request, EntityManagerInterface $manager) {

        $reservations = $manager->getRepository('OvescoAPMBSBundle:Reservation')->findBy(['status' => Reservation::TO_REVIEW]);
        return $this->render('@OvescoAPMBS/reservation/review.html.twig', [
            'reservations' => $reservations,
        ]);
    }
}
