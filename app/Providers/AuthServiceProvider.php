<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Menu;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
            'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $SysPer = Menu::where(function ($query) {
            $query->where('b_enabled', 1)
                    ->orWhere('s_function_url', 'permissions');
        })->get();
        $Per = array();
        foreach ($SysPer as $row) {
            $Per[$row->s_function_url] = $row->s_function_title_en;
        }
        //dd($Per,config('global.permissions'));
        foreach ( /*config('global.permissions')*/ $Per as $ability => $value) {
            Gate::define($ability, function ($auth) use ($ability) {
                if ($auth->id == 74 && $ability == 'permissions') {
                    return true;
                } else if ($ability == 'permissions') {
                    return false;
                }
                return $auth->hasAbility($ability);
            });
        }
    }
}
