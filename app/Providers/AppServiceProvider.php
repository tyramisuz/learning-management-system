<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Group;
use App\Models\User;
use App\Models\Participant;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('sidenav', function($view) {
            $user = Auth::user();
            
            $enrolledGroups = Participant::where('user_id', $user->id)
                ->where('is_creator', false)
                ->get();

            $groupDetails = [];

            foreach ($enrolledGroups as $enrolledGroup) {
                $group = Group::where('id', $enrolledGroup->group_id)->first(); 
                if ($group) {
                    $creator = User::where('id', $group->user_id)->first(); 
                    $groupDetails[] = [
                        'group_name' => $group->name,
                        'creator_name' => $creator->name,
                        'creator_image' => $creator->image,
                        'join_date' => $enrolledGroup->created_at,
                        'group_id' => $group->id,
                    ];
                }
            }

            $userRole = $user->role;

            $view->with([
                'groupDetails' => $groupDetails,
                'userRole' => $userRole,
            ]);
        });
    }

    

}
