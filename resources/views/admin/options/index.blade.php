@extends('base')
@section('content')
    <br><br>
    <h2>@lang('admin/options.title')</h2>
    <form action="{{ route('admin.options') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="opt_save" value="1">
        <table width="519" style="color:#FFFFFF">
            <tbody>
            <tr>
                <td class="c" colspan="2">@lang('admin/options.section.game')</td>
            </tr><tr>
                <th>@lang('admin/options.game_name')</th>
                <th><input name="game_name" size="20" value="{{ $config['game_name'] }}" type="text"></th>
            </tr><tr>
                <th>@lang('admin/options.game_speed')</th>
                <th><input name="game_speed" size="20" value="{{ $config['game_speed'] }}" type="text"></th>
            </tr><tr>
                <th>@lang('admin/options.fleet_speed')</th>
                <th><input name="fleet_speed" size="20" value="{{ $config['fleet_speed'] }}" type="text"></th>
            </tr><tr>
                <th>@lang('admin/options.production_speed')</th>
                <th><input name="resource_multiplier" maxlength="80" size="10" value="{{ $config['resource_multiplier'] }}" type="text"></th>
            </tr><tr>
                <th>@lang('admin/options.vacations_disabled')</th>
                <th>{{ checkbox('urlaubs_modus_erz', $config['umodus']) }}</th>
            </tr><tr>
                <th>@lang('admin/options.forum_url')<br></th>
                <th><input name="forum_url" size="40" maxlength="254" value="{{ $config['forum_url'] }}" type="text"></th>
            </tr><tr>
                <th>@lang('admin/options.maintenance_enabled')<br></th>
                <th>{{ checkbox('closed', $config['game_disable']) }}</th>
            </tr><tr>
                <th>@lang('admin/options.maintenance_text')<br></th>
                <th><textarea name="close_reason" cols="80" rows="5" size="80" >{!! $config['close_reason'] !!}</textarea></th>
            </tr><tr>
                <td class="c" colspan="2">@lang('admin/options.section.planet')</td>
            </tr><tr>
                <th>@lang('admin/options.initial_fields')</th>
                <th><input name="initial_fields" maxlength="80" size="10" value="{{ $config['initial_fields'] }}" type="text"> @lang('admin/options.fields')</th>
            </tr><tr>
                <th>@lang('admin/options.basic_income_metal')</th>
                <th><input name="metal_basic_income" maxlength="80" size="10" value="{{ $config['metal_basic_income'] }}" type="text"> @lang('admin/options.per_hour')</th>
            </tr><tr>
                <th>@lang('admin/options.basic_income_crystal')</th>
                <th><input name="crystal_basic_income" maxlength="80" size="10" value="{{ $config['crystal_basic_income'] }}" type="text"> @lang('admin/options.per_hour')</th>
            </tr><tr>
                <th>@lang('admin/options.basic_income_deuterium')</th>
                <th><input name="deuterium_basic_income" maxlength="80" size="10" value="{{ $config['deuterium_basic_income'] }}" type="text"> @lang('admin/options.per_hour')</th>
            </tr><tr>
                <th>@lang('admin/options.basic_income_energy')</th>
                <th><input name="energy_basic_income" maxlength="80" size="10" value="{{ $config['energy_basic_income'] }}" type="text"> @lang('admin/options.per_hour')</th>
            </tr><tr>
                <td class="c" colspan="2">@lang('admin/options.section.other')</td>
            </tr><tr>
                <th>@lang('admin/options.news_enabled')<br></th>
                <th>{{ checkbox('newsframe', $config['OverviewNewsFrame']) }}</th>
            </tr><tr>
                <th colspan="2"><textarea name="NewsText" cols="80" rows="5" size="80" >{!! $config['OverviewNewsText'] !!}</textarea></th>
            </tr><tr>
                <th>@lang('admin/options.external_chat_enabled')</th>
                <th>{{ checkbox('chatframe', $config['OverviewExternChat']) }}</th>
            </tr><tr>
                <th colspan="2"><textarea name="ExternChat" cols="80" rows="5" size="80" >{!! $config['OverviewExternChatCmd']  !!}</textarea></th>
            </tr><tr>
                <th>@lang('admin/options.google_ads_enabled')</th>
                <th>{{ checkbox('googlead', $config['OverviewBanner']) }}</th>
            </tr><tr>
                <th colspan="2"><textarea name="GoogleAds" cols="80" rows="5" size="80" >{!! $config['OverviewClickBanner'] !!}</textarea></th>
            </tr><tr>
                <th>@lang('admin/options.debug')</a></th>
                <th>{{ checkbox('debug', $config['debug']) }}</th>
            </tr><tr>
                <th colspan="2"><input value="@lang('admin/options.submit')" type="submit"></th>
            </tr>
            </tbody>
        </table>
    </form>
@endsection