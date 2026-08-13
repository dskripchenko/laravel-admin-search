<?php

declare(strict_types=1);

namespace Dskripchenko\LaravelAdminSearch\Tests\Feature;

use Dskripchenko\LaravelAdmin\Admin;
use Dskripchenko\LaravelAdmin\Resource\Resource;
use Dskripchenko\LaravelAdmin\Table\TableColumn;
use Dskripchenko\LaravelAdminSearch\AdminSearchPlugin;
use Dskripchenko\LaravelAdminSearch\Concerns\Searchable;
use Dskripchenko\LaravelAdminSearch\SearchService;
use Dskripchenko\LaravelAdminSearch\Tests\TestCase;
use Dskripchenko\LaravelAdminSearch\Tests\Unit\TestSearchUser;

final class TestSearchableUserResource extends Resource
{
    use Searchable;

    public static string $model = TestSearchUser::class;

    public static string $icon = 'user';

    public static function slug(): string
    {
        return 'test-users';
    }

    public static function permission(): string
    {
        return 'admin.test-users';
    }

    public function fields(): array
    {
        return [];
    }

    public function columns(): array
    {
        return [TableColumn::make('id'), TableColumn::make('name')->search()];
    }

    public function searchableFields(): array
    {
        return ['name', 'email'];
    }

    public function searchTitle(): string
    {
        return 'name';
    }

    public function searchSubtitle(): ?string
    {
        return 'email';
    }
}

final class SearchServiceTest extends TestCase
{
    public function test_plugin_in_admin_plugins_config(): void
    {
        $this->assertContains(AdminSearchPlugin::class, (array) config('admin.plugins', []));
    }

    public function test_search_returns_groups_with_permitted_resources(): void
    {
        TestSearchUser::create(['name' => 'Alice', 'email' => 'alice@example.com']);
        TestSearchUser::create(['name' => 'Bob', 'email' => 'bob@example.com']);

        /** @var Admin $admin */
        $admin = app(Admin::class);
        $admin->resources([TestSearchableUserResource::class]);

        /** @var SearchService $service */
        $service = app(SearchService::class);
        $groups = $service->search('Alice', fn () => true);

        $this->assertCount(1, $groups);
        $this->assertSame('test-users', $groups[0]['resource']);
        $this->assertCount(1, $groups[0]['items']);
        $this->assertSame('Alice', $groups[0]['items'][0]['title']);
        $this->assertSame('alice@example.com', $groups[0]['items'][0]['subtitle']);
    }

    public function test_search_filters_out_resources_without_view_permission(): void
    {
        TestSearchUser::create(['name' => 'Carol', 'email' => 'carol@a.com']);

        /** @var Admin $admin */
        $admin = app(Admin::class);
        $admin->resources([TestSearchableUserResource::class]);

        /** @var SearchService $service */
        $service = app(SearchService::class);
        // hasPermission is always false, so nothing comes back
        $groups = $service->search('Carol', fn () => false);

        $this->assertSame([], $groups);
    }

    public function test_search_short_query_returns_empty(): void
    {
        /** @var SearchService $service */
        $service = app(SearchService::class);
        // min_length = 2 and we pass a single character
        $this->assertSame([], $service->search('a', fn () => true));
    }

    public function test_search_endpoint_registered(): void
    {
        // The endpoint exists (it is not a 404). Unauthenticated, so a 401 is
        // the normal answer from the admin web-auth middleware.
        $response = $this->getJson('/api/admin/system/search?q=Alice');
        $this->assertNotSame(404, $response->status());
    }
}
