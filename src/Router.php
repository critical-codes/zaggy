<?php

namespace CriticalCodes\Zaggy;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Routing\Router as IlluminateRouter;
use JsonSerializable;

class Router implements Arrayable, Jsonable, JsonSerializable
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

    public static function typescriptInterface(): string
    {
        $routeInterface = Route::typescriptInterface();
        return <<<JAVASCRIPT
{$routeInterface}

interface Router {
    routes: { [key: string]: RouteDefinition }
}
JAVASCRIPT;
    }

    public function toTypescript(): string
    {
        $router = $this->toJson(JSON_PRETTY_PRINT);
        $interface = static::typescriptInterface();
        return <<<JAVASCRIPT
{$interface}

const router: Router = {$router}
JAVASCRIPT;
    }

    public function toArray(): array
    {
        return [
            'routes' => $this->routes->toArray(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @param integer $options
     * @return void
     */
    public function toJson($options = 0)
    {
        return json_encode($this, $options);
    }
}
