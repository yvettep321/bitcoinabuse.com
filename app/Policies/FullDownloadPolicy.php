<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FullDownloadPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function can_download_full()
    {
        $allowed = (
            auth()->user() &&
            !!auth()->user()->user_can_access_full_download
        );
        return $allowed;
    }
}
