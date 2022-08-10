<?php

use CriticalCodes\Zaggy\Router;
use CriticalCodes\Zaggy\Tests\TestCase;
use Illuminate\Routing\Router as IlluminateRouter;

class RouterTest extends TestCase
{
    public function test_router_has_expected_properties()
    {
        $this->assertSame([
            'routes' => [
                [
                    'uri' => 'articles/{author}/{article}/{path}',
                    'methods' => [
                        'PUT',
                    ],
                    'defaults' => [
                        'author' => 'josh'
                    ],
                    'wheres' => [
                        'path' => '.*',
                    ],
                    'parameterNames' => [
                        'author',
                        'article',
                        'path'
                    ],
                    'bindingFields' => [
                        'article' => 'slug'
                    ]
                ],
            ],
        ], Router::fromIlluminateRouter($this->router())->toArray());
    }

    protected function router(): IlluminateRouter
    {
        return $this->app->make('router');
    }

    protected function defineRoutes($router)
    {
        $router->put('/articles/{author}/{article:slug}/{path}')
            ->name('articles.show')
            ->where('path', '.*')
            ->defaults('author', 'josh');
    }
}
