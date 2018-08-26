<?php

namespace App\Services;

use App\Models\Planet;

class BlackoutService
{
    const VERSION = '0.6.1-dev';

    public function bootstrapGame()
    {
        // User can be unathenticated at this point since we have
        // to attempt game bootstrap on pages which are accessible
        // for both authenticated and unauthenticated pages such as
        // contact.
        if (auth()->check() === false) {
            return;
        }

        $fleetsService = new FleetService();
        $planetService = new PlanetService();

        // Handle flying fleets
        $fleetsService->handleFlying();

        // @todo handle rocket attacks

        /** @var \App\Models\User $user */
        $user = auth()->user();

        // Verify number of used fields on current planet
        $planetService->verifyUsedFields(Planet::find($user->current_planet));
    }
}
