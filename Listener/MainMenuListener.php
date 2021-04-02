<?php

namespace Ovesco\APMBSBundle\Listener;

use Doctrine\ORM\EntityManagerInterface;
use NetBS\CoreBundle\Event\ExtendMainMenuEvent;
use NetBS\SecureBundle\Mapping\BaseUser;
use Ovesco\APMBSBundle\Entity\Cabane;
use Ovesco\APMBSBundle\Entity\Reservation;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MainMenuListener
{
    /**
     * @var TokenStorageInterface
     */
    private $storage;

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(TokenStorageInterface $storage, EntityManagerInterface $manager)
    {
        $this->storage = $storage;
        $this->manager = $manager;
    }

    public function onMenuConfigure(ExtendMainMenuEvent $event)
    {
        /** @var BaseUser $user */
        $menu       = $event->getMenu();
        $user       = $this->storage->getToken()->getUser();

        if($user->hasRole("ROLE_APMBS") || $user->hasRole('ROLE_ADMIN')) {

            $apmbsCat = $menu->registerCategory('apmbs', 'APMBS');
            $cabanSS = $apmbsCat->addSubMenu('cabanes', 'Cabanes', 'fas fa-laptop-house');

            /** @var Cabane $cabane */
            foreach ($this->manager->getRepository('OvescoAPMBSBundle:Cabane')->findAll() as $cabane) {
                $cabanSS->addSubLink($cabane->getNom(), 'ovesco_apmbs_cabane_page', ['id' => $cabane->getId()]);
            }

            $cabanSS->addSubLink('Ajouter une cabane', 'ovesco_apmbs_cabane_add');
            $cnt = count($this->manager->getRepository('OvescoAPMBSBundle:Reservation')->findBy(['status' => Reservation::TO_REVIEW]));
            $cnt = $cnt > 0 ? " ($cnt)" : "";
            $apmbsCat->addLink('reservations', "Réservations $cnt", 'fas fa-calendar-alt', 'ovesco_apmbs_reservations_show');
        }
    }
}
