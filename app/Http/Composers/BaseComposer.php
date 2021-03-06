<?php

namespace App\Http\Composers;

use App\Models\User;
use App\Services\BlackoutService;
use App\Utils\ConstantsUtils;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BaseComposer
{
    public function compose(View $view)
    {
        $user = Auth::user();
        $inAdmin = request()->route()->getPrefix() === 'admin';

        $view->with([
            'menu' => $this->getMenuView($user, $inAdmin),
            'hasTopbar' => $user && $inAdmin === false,
        ]);
    }

    protected function getMenuView($user, $inAdmin)
    {
        $userLevelMenuMap = [
            User::LEVEL_OPERATOR => 'admin.partials.menu_operator',
            User::LEVEL_SUPER_OPERATOR => 'admin.partials.menu_super_operator',
            User::LEVEL_ADMIN => 'admin.partials.menu',
        ];

        if (!$user) {
            return null;
        }

        if ($inAdmin) {
            $viewName = $userLevelMenuMap[$user->authlevel];
        } else {
            $viewName = 'partials.menu';
        }

        return view($viewName, [
            'forum_url' => config('blackout.forum_url'),
            'info' => [
                'fleet' => config('blackout.fleet_speed') / 2500,
                'game' => config('blackout.game_speed') / 2500,
                'resources' => config('blackout.resource_multiplier'),
                'queue' => ConstantsUtils::MAX_FLEET_OR_DEFS_PER_ROW,
            ],
            'servername' => config('blackout.game_name'),
            'user' => $user,
            'version' => BlackoutService::VERSION,
        ]);
    }
}
