<?php

namespace CriticalCodes\Zaggy;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Routing\Route as IlluminateRoute;
use Illuminate\Routing\RouteCollection as IlluminateRouteCollection;
use Illuminate\Support\Collection;

class RouteCollection extends Collection
{
    /**
     * Create a RouteCollection from an Arrayable of Route
     *
     * @param  Arrayable<int, Route>|array<int, Route>  $routes
     */
    public function __construct(Arrayable|array $routes)
    {
        parent::__construct($routes);
    }

    /**
     * Create a RouteCollection of all the routes in an IlluminateRouteCollection
     *
     * @param  IlluminateRouteCollection  $routeCollection
     * @return self
     */
    public static function fromIlluminateRouteCollection(
        IlluminateRouteCollection $routeCollection
    ): self {
        return new self(
            collect($routeCollection->getRoutes())->map(
                fn (IlluminateRoute $route) => Route::fromIlluminateRoute($route)
            ),
        );
    }
}
