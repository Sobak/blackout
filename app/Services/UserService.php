<?php

namespace App\Services;

use App\Models\Alliance;
use App\Models\Announcement;
use App\Models\Fleet;
use App\Models\Friend;
use App\Models\Galaxy;
use App\Models\Message;
use App\Models\Moon;
use App\Models\Planet;
use App\Models\Report;
use App\Models\Stats;
use App\Models\User;

class UserService
{
    public function removeUser(User $user)
    {
        if ($user->ally_id != 0) {
            $ally = Alliance::find($user->ally_id);
            $ally->ally_members -= 1;

            if ($ally->ally_members > 0) {
                $ally->save();
            } else {
                $stats = Stats::where('stat_type', 2)->where('id_owner', $ally->id)->first();
                if ($stats) {
                    $stats->delete();
                }

                $ally->delete();
            }
        }

        $stats = Stats::where('stat_type', 1)->where('id_owner', $user->id);
        if ($stats) {
            $stats->delete();
        }

        $planets = Planet::where('id_owner', $user->id)->get();
        foreach ($planets as $planet) {
            if ($planet->planet_type == 1) {
                Galaxy::where('galaxy', $planet->galaxy)->where('system', $planet->system)->where('planet', $planet->planet)->delete();
            } elseif ($planet->planet_type = 3) {
                Moon::where('galaxy', $planet->galaxy)->where('system', $planet->system)->where('lunapos', $planet->planet)->delete();
            }
            $planet->delete();
        }

        Message::where('message_sender', $user->id)->orWhere('message_owner', $user->id)->delete();
        Fleet::where('owner', $user->id)->delete();
        Report::where('id_owner1', $user->id)->orWhere('id_owner2', $user->id)->delete();
        Friend::where('sender', $user->id)->orWhere('owner', $user->id)->delete();
        Announcement::where('user', $user->id)->delete();

        $user->delete();
    }
}
