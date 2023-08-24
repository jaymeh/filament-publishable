<?php

namespace Jaymeh\FilamentPublishable;

use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Jaymeh\FilamentPublishable\Testing\TestsFilamentPublishable;
use Livewire\Features\SupportTesting\Testable;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

/**
 * Service provider for registering package.
 */
class FilamentPublishableServiceProvider extends PackageServiceProvider
{
    /**
     * Name of package.
     *
     * @var string
     */
    public static string $name = 'filament-publishable';

    /**
     * Namespace for views in package.
     *
     * @var string
     */
    public static string $viewNamespace = 'filament-publishable';

    /**
     * Handles setup and configuration of package.
     *
     * @param Package $package Package object used for registration.
     *
     * @return void
     */
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasInstallCommand(
                function (InstallCommand $command) {
                    $command
                        ->askToStarRepoOnGitHub('jaymeh/filament-publishable');
                }
            );

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    /**
     * Fire additional functionality after package has been registered.
     *
     * @return void
     */
    public function packageRegistered(): void
    {
    }

    /**
     * Handles additional setup after package has been booted.
     *
     * @return void
     */
    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        // Testing
        Testable::mixin(new TestsFilamentPublishable());
    }

    /**
     * Gets the name of the package for asset registration.
     *
     * @return string|null
     */
    protected function getAssetPackageName(): ?string
    {
        return 'jaymeh/filament-publishable';
    }

    /**
     * Gets any assets required for the plugin.
     *
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('filament-publishable', __DIR__ . '/../resources/dist/components/filament-publishable.js'),
            Css::make('filament-publishable-styles', __DIR__ . '/../resources/dist/filament-publishable.css'),
            Js::make('filament-publishable-scripts', __DIR__ . '/../resources/dist/filament-publishable.js'),
        ];
    }
}
