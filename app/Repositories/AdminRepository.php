<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

use App\Models\Admin;

class AdminRepository extends  AbstractRepository
{
    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    /**
     * Get Auth Admin.
     * 
     * @return Admin
     */
    public function getAuthUser(): Admin
    {
        $AdminId = Auth::guard('admin')->id();

        return $this->getById($AdminId);
    }
}
