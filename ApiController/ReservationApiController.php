<?php

namespace Ovesco\APMBSBundle\ApiController;

use Doctrine\ORM\EntityManagerInterface;
use Ovesco\APMBSBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ReservationApiController
 * @package Ovesco\APMBSBundle\ApiController
 * @Route("/reservation")
 */
class ReservationApiController extends AbstractController
{
    /**
     * @Route("/reserve", name="ovesco_apmbs_api_reservation_reserve", methods={"POST"})
     */
    public function makeReservationAction(Request $request, EntityManagerInterface $manager, ValidatorInterface $validator)
    {
        $content = json_decode($request->getContent(), 10);
        $errors = [];
        $reservation = new Reservation();

        $keys = [
            'prenom' => function($param) use ($reservation) { $reservation->setPrenom($param); },
            'nom' => function($param) use ($reservation) { $reservation->setNom($param); },
            'email' => function($param) use ($reservation) { $reservation->setEmail($param); },
            'telephone' => function($param) use ($reservation) { $reservation->setPhone($param); },
            'groupe' => function($param) use ($reservation) { $reservation->setUnite($param); },
            'activite' => function($param) use ($reservation) { $reservation->setDescription($param); },
            'start' => function($param) use ($reservation) { $reservation->setStart(new \DateTime($param)); },
            'end' => function($param) use ($reservation) { $reservation->setEnd(new \DateTime($param)); },
            'cabane' => function($param) use ($reservation, $manager, $errors) {
                $cabane = $manager->getRepository('OvescoAPMBSBundle:Cabane')->findOneBy(['nom' => $param]);
                if (!$cabane) {
                    $errors[] = "Aucune cabane trouvée avec le nom [$param]";
                } else {
                    $reservation->setCabane($cabane);
                }
            }
        ];

        foreach($keys as $key => $lambda) {
            if (!isset($content[$key])) {
                $errors[] = "Le champ [$key] est obligatoire.";
            } else {
                $lambda($content[$key]);
            }
        }

        if (count($errors) > 0) {
            return new JsonResponse($errors, 400);
        }

        $validationErrors = $validator->validate($reservation);
        if (count($validationErrors) > 0) {
            return new JsonResponse([(string)$validationErrors], 400);
        }

        $reservation->setStatus(Reservation::TO_REVIEW);

        $manager->persist($reservation);
        $manager->flush();

        return new Response();
    }
}
