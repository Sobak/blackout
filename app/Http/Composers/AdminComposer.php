<?php

namespace App\Http\Composers;

use App\Models\User;
use App\Services\Blackout;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminComposer
{
    protected $menusMap = [
        User::LEVEL_OPERATOR => 'admin.menu_operator',
        User::LEVEL_SUPER_OPERATOR => 'admin.menu_super_operator',
        User::LEVEL_ADMIN => 'admin.menu',
    ];

    public function compose(View $view)
    {
        /** @var User $user */
        $user = Auth::user();

        // Prevent attatching menu view to the menu itself...
        if (in_array($view->getName(), array_values($this->menusMap)) === false) {
            $view->with([
                'menu' => view($this->menusMap[$user->authlevel], [
                    'servername' => game_config('game_name'),
                    'version' => Blackout::VERSION,
                ]),
            ]);
        }
    }
}
