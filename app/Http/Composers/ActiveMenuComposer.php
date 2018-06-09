<?php

namespace App\Http\Composers;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\View\View;

class ActiveMenuComposer
{
    /**
     * @var Router
     */
    protected $router;


    public function __construct(Router $router)
    {
        $this->router = $router;

    }

    public function compose(View $view)
    {

        $list = [];
        $routes =
        [
            'HomeAdmin' => ['name' => 'Dashboard', 'icon' => 'dashboard', 'active' => false],
            'Skills' => ['name' => 'Skills', 'icon' => 'gear', 'active' => false],
            'Realisations' => ['name' => 'Realisations', 'icon' => 'picture-o', 'active' => false],
            'Levels' => ['name' => 'Levels', 'icon' => 'bar-chart', 'active' => false],
            'Categories' => ['name' => 'Categories', 'icon' => 'folder-open', 'active' => false],
            'Schools' => ['name' => 'Schools', 'icon' => 'graduation-cap', 'active' => false],
            'Medias' => ['name' => 'Medias', 'icon' => 'picture-o', 'active' => false],
            'Hobbies' => ['name' => 'Hobbies', 'icon' => 'picture-o', 'active' => false]
        ];

        foreach ($this->router->getRoutes() as $index => $route) {

            $routeName = $route->getName();

            if (array_key_exists($routeName, $routes)) {

                $list[$routeName] = $routes[$routeName];

                $list[$routeName]['active'] = (strpos(ucfirst($this->router->getCurrentRoute()->getName()), $routeName) !== false);
            }

        }

        $view->with('adminMenu', $list);
    }

}
