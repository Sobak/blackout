<?php

namespace App\Services;

use App\Models\Planet as PlanetModel;

class Blackout
{
    const VERSION = '0.6.0-dev';

    public function bootstrapGame()
    {
        // User can be unathenticated at this point since we have
        // to attempt game bootstrap on pages which are accessible
        // for both authenticated and unauthenticated pages such as
        // contact.
        if (auth()->check() === false) {
            return;
        }

        $fleetsService = new Fleets();
        $planetService = new Planet();

        // Handle flying fleets
        $fleetsService->handleFlying();

        // @todo handle rocket attacks

        /** @var \App\Models\User $user */
        $user = auth()->user();

        // Verify number of used fields on current planet
        $planetService->verifyUsedFields(PlanetModel::find($user->current_planet));
    }
}
