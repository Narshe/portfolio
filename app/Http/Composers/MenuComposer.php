<?php

namespace App\Http\Composers;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\View\View;

use App\Contact;

class MenuComposer
{
    /**
     * @var Router
     */
    protected $router;

    protected $routes;


    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->routes = [];
    }

    private function addRoute($key, $name, $icon)
    {
        $this->routes[$key] = [
            'name' => $name,
            'icon' => $icon,
            'active' => false
        ];
    }

    public function compose(View $view)
    {

        $menu = [];


        $this->addRoute('HomeAdmin', 'Dashboard', 'dashboard');
        $this->addRoute('Skills', 'Skills', 'gear');
        $this->addRoute('Realisations', 'Realisations', 'picture-o');
        $this->addRoute('Levels', 'Levels', 'bar-chart');
        $this->addRoute('Categories', 'Categories', 'folder-open');
        $this->addRoute('Schools', 'Schools', 'graduation-cap');
        $this->addRoute('Medias', 'Medias', 'picture-o');
        $this->addRoute('Hobbies', 'Hobbies', 'gamepad');
        $this->addRoute('Contacts', 'Contacts', 'envelope');


        foreach ($this->router->getRoutes() as $index => $route) {

            $routeName = $route->getName();

            if (array_key_exists($routeName, $this->routes)) {

                $menu[$routeName] = $this->routes[$routeName];

                $menu[$routeName]['active'] = (strpos(ucfirst($this->router->getCurrentRoute()->getName()), $routeName) !== false);
            }

        }

        $view->with('adminMenu', $menu);
        $view->with('unreadCount', Contact::countUnread());
    }

}
