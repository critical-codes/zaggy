<?php

namespace CriticalCodes\Zaggy;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Routing\Route as IlluminateRoute;

class Route implements Arrayable
{
    public function __construct(
        /**
         * The URI pattern the route responds to.
         *
         * @var string
         */
        readonly string $uri,

        /**
         * The HTTP methods the route responds to.
         *
         * @var array
         */
        readonly array $methods,

        /**
         * Indicates whether the route is a fallback route.
         *
         * @var bool
         */
        readonly bool $isFallback,

        /**
         * The default values for the route.
         *
         * @var array
         */
        readonly array $defaults,

        /**
         * The regular expression requirements.
         *
         * @var array
         */
        readonly array $wheres,

        /**
         * The parameter names for the route.
         *
         * @var array|null
         */
        readonly array|null $parameterNames,


        /**
         * The the binding fields for the route..
         *
         * @var array
         */
        readonly array $bindingFields,
    ) {
    }

    public static function fromIlluminateRoute(IlluminateRoute $route): self
    {
        return new self(
            $route->uri,
            $route->methods,
            $route->isFallback,
            $route->defaults,
            $route->wheres,
            $route->parameterNames(),
            $route->bindingFields()
        );
    }

    public function toArray(): array
    {
        return [
            'uri' => $this->uri,
            'methods' => $this->methods,
            'defaults' => $this->defaults,
            'wheres' => $this->wheres,
            'parameterNames' => $this->parameterNames,
            'bindingFields' => $this->bindingFields
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
