<?php

namespace App\Policies;

use App\Models\OrderTemplate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class OrderTemplatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if (Auth::guest()) return false;
        if ($user->hasRole('ROLE_GESTIONNAIRE')) return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderTemplate  $orderTemplate
     * @return mixed
     */
    public function view(User $user, OrderTemplate $orderTemplate)
    {
        if (Auth::guest()) return false;
        if ($user->hasRole('ROLE_GESTIONNAIRE') and $user->id == $orderTemplate->brand->manager->id) return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if (Auth::guest()) return false;
        if ($user->hasRole('ROLE_GESTIONNAIRE')) return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderTemplate  $orderTemplate
     * @return mixed
     */
    public function update(User $user, OrderTemplate $orderTemplate)
    {
        if (Auth::guest()) return false;
        if ($user->id == $orderTemplate->brand->manager->id) return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderTemplate  $orderTemplate
     * @return mixed
     */
    public function delete(User $user, OrderTemplate $orderTemplate)
    {
        if (Auth::guest()) return false;
        if ($user->id == $orderTemplate->brand->manager->id) return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderTemplate  $orderTemplate
     * @return mixed
     */
    public function restore(User $user, OrderTemplate $orderTemplate)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderTemplate  $orderTemplate
     * @return mixed
     */
    public function forceDelete(User $user, OrderTemplate $orderTemplate)
    {
        if (Auth::guest()) return false;
        if ($user->id == $orderTemplate->brand->manager->id) return true;
    }


    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $orderTemplate
     * @return bool
     */
    public function update_for_user(User $user, OrderTemplate $orderTemplate)
    {
        if (Auth::guest()) return false;
        if ($orderTemplate->status == 'Ouverte') return true;
        return false;
    }

    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $orderTemplate
     * @return bool
     */
    public function show_for_user(User $user, OrderTemplate $orderTemplate)
    {
        if (Auth::guest()) return false;
        if ($orderTemplate->status == 'Brouillon') return false;
        return true;
    }

}
