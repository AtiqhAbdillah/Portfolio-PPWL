<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('published scope only returns published projects', function () {
    Project::create([
        'title' => 'A draft project',
        'description' => 'This project is still a draft.',
        'status' => 'draft',
    ]);
    $publishedProject = Project::create([
        'title' => 'A published project',
        'description' => 'This project is available to the public.',
        'status' => 'published',
    ]);

    expect(Project::published()->get()->modelKeys())->toBe([$publishedProject->id]);
});

test('trashed projects can be viewed and restored', function () {
    $project = Project::create([
        'title' => 'A project in trash',
        'description' => 'This project has been soft deleted.',
        'status' => 'published',
    ]);

    $this->delete(route('posts.destroy', $project))
        ->assertRedirect(route('posts.index'));

    $this->get(route('posts.index'))
        ->assertDontSee($project->title);
    $this->get(route('posts.trash'))
        ->assertOk()
        ->assertSee($project->title);

    $this->patch(route('posts.restore', $project->id))
        ->assertRedirect(route('posts.trash'));

    $this->assertDatabaseHas('projects', [
        'id' => $project->id,
        'deleted_at' => null,
    ]);
});

test('trashed projects can be permanently deleted', function () {
    $project = Project::create([
        'title' => 'A project to delete forever',
        'description' => 'This project will be permanently deleted.',
        'status' => 'draft',
    ]);
    $project->delete();

    $this->delete(route('posts.force-delete', $project->id))
        ->assertRedirect(route('posts.trash'));

    $this->assertDatabaseMissing('projects', ['id' => $project->id]);
});
