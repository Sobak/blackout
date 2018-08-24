<?php

namespace App\Http\Composers;

use App\Models\Planet as PlanetModel;
use App\Models\User;
use App\Services\Planet;
use Illuminate\View\View;

class TopbarComposer
{
    public function compose(View $view)
    {
        /** @var User $user */
        $user = auth()->user();
        $planet = PlanetModel::find($user->current_planet);

        $planetService = new Planet();

        $planetService->updateResources($user, $planet, time());

        // Create HTML for planet list
        $planetList = '';
        foreach ($planetService->getSortedList($user, true) as $planetOption) {
            $planetList .= '<option ';
            if ($planetOption->id == $user->current_planet) {
                $planetList .= 'selected="selected" ';
            }
            $planetList .= 'value="?cp=' . $planetOption->id;
            $planetList .= '&amp;mode=' . request()->query('mode');
            $planetList .= '&amp;re=0">';

            $planetList .= $planetOption->name . '&nbsp;';
            $planetList .= coordinates($planetOption);
            $planetList .= '&nbsp;&nbsp;</option>';
        }

        // Resources numbers
        $energy = pretty_number($planet->energy_max + $planet->energy_used) . "/" . pretty_number($planet->energy_max);
        if (($planet->energy_max + $planet->energy_used) < 0) {
            $energy = colorRed($energy);
        }

        $metal = pretty_number($planet->metal);
        if ($planet->metal > $planet->metal_max) {
            $metal = colorRed($metal);
        }

        $crystal = pretty_number($planet->crystal);
        if ($planet->crystal > $planet->crystal_max) {
            $crystal = colorRed($crystal);
        }

        $deuterium = pretty_number($planet->deuterium);
        if ($planet->deuterium > $planet->deuterium_max) {
            $deuterium = colorRed($deuterium);
        }

        if ($user->unread_messages_count > 0) {
            $messages = '<a href="messages.php">[ ' . $user->unread_messages_count . ' ]</a>';
        } else {
            $messages = 0;
        }

        $view->with([
            'crystal' => $crystal,
            'deuterium' => $deuterium,
            'energy' => $energy,
            'messages' => $messages,
            'metal' => $metal,
            'planet' => $planet,
            'planetList' => $planetList,
        ]);
    }
}
