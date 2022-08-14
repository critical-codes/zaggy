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
                'articles.show' => [
                    'name' => 'articles.show',
                    'uri' => 'articles/{author}/{article}/{path}',
                    'methods' => [
                        'PUT',
                    ],
                    'defaults' => [
                        'author' => 'josh',
                    ],
                    'wheres' => [
                        'path' => '.*',
                    ],
                    'parameterNames' => [
                        'author',
                        'article',
                        'path',
                    ],
                    'bindingFields' => [
                        'article' => 'slug',
                    ],
                ],
            ],
        ], Router::fromIlluminateRouter($this->router())->toArray());
    }

    public function test_router_serialized_to_typescript()
    {
        file_put_contents(
            __DIR__.'/stubs/router.ts',
            Router::fromIlluminateRouter($this->router())->toTypescript()
        );

        $this->assertSame(
            file_get_contents(__DIR__.'/stubs/router.ts'),
            Router::fromIlluminateRouter($this->router())->toTypescript()
        );
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
