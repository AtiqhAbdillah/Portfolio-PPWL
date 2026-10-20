<?php

use App\Models\Project;
use Database\Seeders\ProjectTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('project listing supports page sizes and continuing row numbers', function () {
    foreach (range(1, 25) as $number) {
        Project::create([
            'title' => "Project {$number}",
            'description' => 'A sample project description.',
            'status' => 'published',
        ]);
    }

    foreach ([5, 10, 25] as $perPage) {
        $response = $this->get(route('projects', ['per_page' => $perPage]));

        $response->assertOk()
            ->assertSee('No. 1')
            ->assertSee("No. {$perPage}")
            ->assertSee("Data per halaman: {$perPage}");

        if ($perPage < 25) {
            $response->assertDontSee('No. '.($perPage + 1));
        }
    }

    $this->get(route('projects', ['per_page' => 5, 'page' => 2]))
        ->assertOk()
        ->assertSee('No. 6')
        ->assertSee('Project 6')
        ->assertDontSee('No. 5');
});

test('project search is retained while navigating pages', function () {
    foreach (range(1, 12) as $number) {
        Project::create([
            'title' => sprintf('Needle Project %02d', $number),
            'description' => 'A searchable sample project description.',
            'status' => 'published',
        ]);
    }

    Project::create([
        'title' => 'Unrelated Project',
        'description' => 'This project should not match the search.',
        'status' => 'published',
    ]);

    $this->get(route('projects', [
        'search' => 'Needle',
        'per_page' => 5,
        'page' => 2,
    ]))
        ->assertOk()
        ->assertSee('value="Needle"', false)
        ->assertSee('No. 6')
        ->assertSee('Needle Project 06')
        ->assertDontSee('Unrelated Project')
        ->assertSee('search=Needle')
        ->assertSee('per_page=5')
        ->assertSee('page=3');
});

test('project seeder creates 25 reproducible projects without adding duplicates', function () {
    $seeder = app(ProjectTableSeeder::class);

    $seeder->run();
    $seeder->run();

    expect(Project::count())->toBe(25);
});
