<?php

use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('an administrator sees edit and delete actions in the user list', function () {
    $admin = User::factory()
        ->has(Profile::factory()->admin(), 'profile')
        ->create();
    $user = User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.users.index'));

    $response->assertSee(route('admin.users.edit', $user))
        ->assertSee(route('admin.users.destroy', $user))
        ->assertSee('Editar')
        ->assertSee('Excluir');
});

test('an administrator can open the user edit form', function () {
    $admin = User::factory()
        ->has(Profile::factory()->admin(), 'profile')
        ->create();
    $user = User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.users.edit', $user));

    $response->assertSee('Editar usuário')
        ->assertSee($user->email);
});

test('an administrator can edit a user name and email', function () {
    $admin = User::factory()
        ->has(Profile::factory()->admin(), 'profile')
        ->create();
    $user = User::factory()
        ->has(Profile::factory(), 'profile')
        ->create();

    $response = $this->actingAs($admin)->put(route('admin.users.update', $user), [
        'name' => 'Nome atualizado',
        'email' => 'atualizado@example.com',
    ]);

    $response->assertRedirect(route('admin.users.index'))
        ->assertSessionHas('status', 'Usuário atualizado com sucesso.');
    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Nome atualizado',
        'email' => 'atualizado@example.com',
    ]);
});

test('an administrator cannot assign another user email to an account', function () {
    $admin = User::factory()
        ->has(Profile::factory()->admin(), 'profile')
        ->create();
    $user = User::factory()->create();
    $anotherUser = User::factory()->create();

    $response = $this->actingAs($admin)->put(route('admin.users.update', $user), [
        'name' => 'Nome atualizado',
        'email' => $anotherUser->email,
    ]);

    $response->assertSessionHasErrors(['email']);
    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
    ]);
});

test('an administrator can delete a user and the associated profile', function () {
    $admin = User::factory()
        ->has(Profile::factory()->admin(), 'profile')
        ->create();
    $user = User::factory()
        ->has(Profile::factory(), 'profile')
        ->create();
    $profile = $user->profile;

    $response = $this->actingAs($admin)->delete(route('admin.users.destroy', $user));

    $response->assertRedirect(route('admin.users.index'))
        ->assertSessionHas('status', 'Usuário excluído com sucesso.');
    $this->assertModelMissing($user);
    $this->assertModelMissing($profile);
});

test('an administrator cannot delete their own account', function () {
    $admin = User::factory()
        ->has(Profile::factory()->admin(), 'profile')
        ->create();

    $response = $this->actingAs($admin)->delete(route('admin.users.destroy', $admin));

    $response->assertRedirect(route('admin.users.index'))
        ->assertSessionHas('error', 'Você não pode excluir sua própria conta.');
    $this->assertModelExists($admin);
});

test('a regular user cannot use the administrator user management endpoints', function () {
    $user = User::factory()
        ->has(Profile::factory(), 'profile')
        ->create();
    $target = User::factory()->create();

    $response = $this->actingAs($user)->delete(route('admin.users.destroy', $target));

    $response->assertForbidden();
    $this->assertModelExists($target);
});

test('a guest cannot delete a user', function () {
    $user = User::factory()->create();

    $response = $this->delete(route('admin.users.destroy', $user));

    $response->assertRedirect(route('login'));
    $this->assertModelExists($user);
});
