<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stats;
use App\Models\User;
use App\Services\BlackoutService;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('onlinetime', '>=', (time() - 15 * 60));

        if ($request->has('sort')) {
            $users->orderBy($request->get('sort'), 'asc');
        }

        $users = $users->get();

        foreach ($users as $user) {
            $user->points = Stats::where('stat_type', 1)
                                 ->where('stat_code', 1)
                                 ->where('id_owner', $user->id)
                                 ->first()
                                 ->total_points ?? 0;

            $user->ip_color = (isset($previousIP) && $previousIP == $user->user_lastip) ? 'red' : 'lime';

            $previousIP = $user->user_lastip;
        }

        return view('admin.overview.index', [
            'title' => trans('admin/overview.index.title'),
            'users' => $users,
            'version' => colorRed(BlackoutService::VERSION),
        ]);
    }
}
