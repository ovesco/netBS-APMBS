<?php

namespace Ovesco\APMBSBundle\Security;

use NetBS\SecureBundle\Mapping\BaseUser;
use NetBS\SecureBundle\Voter\NetBSVoter;
use Ovesco\APMBSBundle\Entity\Cabane;
use Ovesco\APMBSBundle\Entity\Reservation;

class CabaneVoter extends NetBSVoter {

    protected function supportClass()
    {
        return [
            Cabane::class,
            Reservation::class
        ];
    }

    protected function accept($operation, $subject, BaseUser $user)
    {
        return $user->hasRole("ROLE_APMBS");
    }
}