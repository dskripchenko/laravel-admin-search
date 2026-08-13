<?php

declare(strict_types=1);

namespace Dskripchenko\LaravelAdminSearch;

use Dskripchenko\LaravelAdmin\Admin;
use Dskripchenko\LaravelAdmin\Plugin\AdminPlugin;

/**
 * AdminSearchPlugin is a placeholder, since the search pack introduces no
 * resources or permissions of its own. Registering the plugin in the config is
 * needed mostly for discovery (Admin::getPlugins() then shows that the pack is
 * installed).
 */
final class AdminSearchPlugin implements AdminPlugin
{
    public function name(): string
    {
        return 'search';
    }

    public function version(): string
    {
        return '0.1.0';
    }

    public function register(): void {}

    public function boot(Admin $admin): void
    {
        // No resources and no permissions — the search uses the existing
        // <resource>.view permissions through SearchService.
    }
}
