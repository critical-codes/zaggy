<?php

namespace CriticalCodes\Zaggy;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Routing\Router as IlluminateRouter;

class Router implements Arrayable
{
    public function __construct(
        readonly RouteCollection $routes
    ) {
    }

    /**
     * Create a Router from an IlluminateRouter
     *
     * @param  IlluminateRouter  $router
     * @return self
     */
    public static function fromIlluminateRouter(IlluminateRouter $router): self
    {
        return new self(
            RouteCollection::fromIlluminateRouteCollection($router->getRoutes())
        );
    }

    public function toArray(): array
    {
        return [
            'routes' => $this->routes->toArray(),
        ];
    }
}
