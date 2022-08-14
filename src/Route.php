<?php

namespace CriticalCodes\Zaggy;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Routing\Route as IlluminateRoute;

class Route implements Arrayable
{
    public function __construct(
        /**
         * The name of the route.
         */
        readonly string $name,

        /**
         * The URI pattern the route responds to.
         */
        readonly string $uri,

        /**
         * The HTTP methods the route responds to.
         */
        readonly array $methods,

        /**
         * Indicates whether the route is a fallback route.
         */
        readonly bool $isFallback,

        /**
         * The default values for the route.
         */
        readonly array $defaults,

        /**
         * The regular expression requirements.
         */
        readonly array $wheres,

        /**
         * The parameter names for the route.
         */
        readonly array $parameterNames,

        /**
         * The the binding fields for the route.
         */
        readonly array $bindingFields,
    ) {
    }

    public static function fromIlluminateRoute(IlluminateRoute $route): self
    {
        return new self(
            $route->getName(),
            $route->uri,
            $route->methods,
            $route->isFallback,
            $route->defaults,
            $route->wheres,
            $route->parameterNames() ?? [],
            $route->bindingFields()
        );
    }

    public static function typescriptInterface(): string
    {
        return <<<'JAVASCRIPT'
interface RouteDefinition<ParameterName extends string = string> {
    // The name of the route
    // For example `articles.show`
    name: string;
    // The uri of the route
    // For example `/articles/{author}`
    uri: string;
    // An array of methods the route accepts
    methods: ReadonlyArray<'GET' |'HEAD' | 'POST' | 'PUT' | 'PATCH' | 'DELETE'>;
    // Default values for the route parameters if set
    defaults: Partial<{ [K in ParameterName]: unknown }>;
    // Regex patterns for any path parameters that should match a regex
    wheres: Partial<{ [K in ParameterName]: string }>;
    // The names of the route parameters in the url in order of appearance
    parameterNames: ReadonlyArray<ParameterName>;
    // For route model binding, if a different query key has been set.
    bindingFields: Partial<{ [K in ParameterName]: string }>;
}
JAVASCRIPT;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'uri' => $this->uri,
            'methods' => $this->methods,
            'defaults' => $this->defaults,
            'wheres' => $this->wheres,
            'parameterNames' => $this->parameterNames,
            'bindingFields' => $this->bindingFields,
        ];
    }
}
