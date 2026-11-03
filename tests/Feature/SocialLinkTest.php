<?php

namespace Tests\Feature;

use App\Models\SocialLink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class SocialLinkTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $permission = Permission::query()->firstOrCreate([
            'name' => config('menu_permissions.resources.social-links'),
            'guard_name' => 'web',
        ]);

        return tap(User::factory()->create())->givePermissionTo($permission);
    }

    public function test_user_without_permission_cannot_open_page(): void
    {
        Permission::query()->firstOrCreate([
            'name' => config('menu_permissions.resources.social-links'),
            'guard_name' => 'web',
        ]);

        $this->actingAs(User::factory()->create())
            ->get(route('admin.social-links.edit'))
            ->assertForbidden();
    }

    public function test_admin_can_open_empty_form(): void
    {
        $this->actingAs($this->admin())
            ->get(route('admin.social-links.edit'))
            ->assertOk()
            ->assertSee('name="telegram_url"', false);
    }

    public function test_repeated_updates_keep_single_row(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)
            ->put(route('admin.social-links.update'), ['telegram_url' => 'https://t.me/first'])
            ->assertRedirect(route('admin.social-links.edit'));

        $this->actingAs($admin)
            ->put(route('admin.social-links.update'), [
                'telegram_url' => 'https://t.me/second',
                'youtube_url' => 'https://www.youtube.com/@institut',
            ])
            ->assertRedirect(route('admin.social-links.edit'));

        $this->assertSame(1, SocialLink::query()->count());
        $this->assertSame('https://t.me/second', SocialLink::query()->first()->telegram_url);
    }

    public function test_cleared_field_is_removed(): void
    {
        $admin = $this->admin();
        SocialLink::query()->create(['facebook_url' => 'https://www.facebook.com/institut']);

        $this->actingAs($admin)
            ->put(route('admin.social-links.update'), ['facebook_url' => ''])
            ->assertSessionHasNoErrors();

        $this->assertNull(SocialLink::query()->first()->facebook_url);
    }

    public function test_invalid_url_is_rejected(): void
    {
        $this->actingAs($this->admin())
            ->put(route('admin.social-links.update'), ['instagram_url' => 'javascript:alert(1)'])
            ->assertSessionHasErrors('instagram_url');

        $this->assertSame(0, SocialLink::query()->count());
    }

    public function test_api_returns_links_as_single_object(): void
    {
        SocialLink::query()->create([
            'youtube_url' => 'https://www.youtube.com/@institut',
            'telegram_url' => 'https://t.me/institut',
        ]);

        $this->getJson('/api/social-links')
            ->assertOk()
            ->assertJsonPath('status', true)
            ->assertJsonPath('data.youtube_url', 'https://www.youtube.com/@institut')
            ->assertJsonPath('data.telegram_url', 'https://t.me/institut')
            ->assertJsonPath('data.instagram_url', null)
            ->assertJsonPath('data.facebook_url', null);
    }

    public function test_api_returns_not_found_when_empty(): void
    {
        $this->getJson('/api/social-links')
            ->assertNotFound()
            ->assertJsonPath('status', false);
    }
}
