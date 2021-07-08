<?php

namespace App\Http\View\Composer;

use Illuminate\View\View;
use Symfony\Component\Yaml\Yaml;

class MenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $menu = Yaml::parse(file_get_contents(__DIR__."/../../../../resources/views/component/menu.yaml"));
        $view->with('menu', $menu["menu"]);
    }
}
