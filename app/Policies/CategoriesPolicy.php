<?php

namespace App\Policies;

use App\Models\Categories;
use App\Models\Users;
use Illuminate\Auth\Access\Response;

class CategoriesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Users $users)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Users $users)
    {
        return $users->checkPermissionAsscess("list_categoryy");
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Users $users)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Users $users, Categories $categories)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Users $users, Categories $categories)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Users $users, Categories $categories)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Users $users, Categories $categories)
    {
        //
    }
}
