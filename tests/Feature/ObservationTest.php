<?php

use App\Models\Observation;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can_get_observations', function () {

    Observation::factory()->count(5)->create();

    $observations = Observation::orderBy('observed_at', 'DESC')->with(['capybara:id,name', 'city:id,name'])
        ->get();

    $response = $this->getJson('/api/observations');

    expect($response->content())
        ->json()
        ->toHaveCount(5)
        ->toMatchArray($observations->toArray());

    expect($response->status())->toBe(200);
});


test('can_see_validation_errors_for_duplicate_observations', function () {
    $observation = Observation::factory()->create();

    $response = $this->postJson('/api/observations', $observation->toArray());

    expect($response->content())
        ->json()
        ->toHaveKeys(['message'])
        ->message
        ->toContain('This capybara has already been recorded in this city on this date.');

    $this->assertDatabaseCount('observations', 1);

    expect($response->status())->toBe(422);
});

test('can_create_unique_observations', function () {
    $observation = Observation::factory()->create([
        'observed_at' => now()
    ]);

    $observation->observed_at = now()->subDays(2)->toDateTimeString();
    $response = $this->postJson('/api/observations', $observation->toArray());

    $this->assertDatabaseCount('observations', 2);

    expect($response->status())->toBe(201);
});

test('can_only_update_to_unique_observations', function () {

    $observation = Observation::factory()->create([
        'capybara_id' => 1,
        'city_id' => 1,
        'observed_at' => now()->format('Y-m-d')
    ]);

    $updatedObservation = [
        ...$observation->toArray(),
        'capybara_id' => 1,
        'city_id' => 2,
        'observed_at' => now()->format('Y-m-d')
    ];

    $response = $this->putJson("/api/observations/{$observation->id}", $updatedObservation);

    expect($response->content())
        ->json()
        ->toMatchArray([$updatedObservation]);

    expect($response->status())->toBe(200);
});
