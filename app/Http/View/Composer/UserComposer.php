<?php

namespace App\Http\View\Composer;

use Illuminate\Foundation\Auth\User;
use Illuminate\View\View;
use Symfony\Component\Yaml\Yaml;

class UserComposer
{
    protected $user;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('username', $this->user->username);
    }

}
