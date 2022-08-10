<?php

namespace CriticalCodes\Zaggy;

use CriticalCodes\Zaggy\Commands\ZaggyCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ZaggyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('zaggy')
            ->hasConfigFile()
            ->hasCommand(ZaggyCommand::class);
    }
}
