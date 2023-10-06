<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Capybara;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\DataProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CapybaraTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_capybaras(): void
    {
        $capybaras = Capybara::orderBy('created_at', 'DESC')->get();
        $firstCapybara = $capybaras->first();

        $response = $this->getJson('/api/capybaras');

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has($capybaras->count())
                ->first(
                    fn (AssertableJson $json) =>
                    $json->where('id', $firstCapybara->id)
                        ->where('name', $firstCapybara->name)
                        ->etc()
                )
        );


        $response->assertStatus(200);
    }

    public function test_capybara_name_must_be_unique(): void
    {
        $capybara = Capybara::factory()->create();
        $response = $this->postJson('/api/capybaras', $capybara->toArray());

        $response->assertJsonValidationErrors(['name']);
        $response->assertJson(['message' => 'The name has already been taken.']);
        $response->assertStatus(422);
    }

    public function test_can_create_capybara(): void
    {
        $capybara = Capybara::factory()->make();
        $response = $this->postJson('/api/capybaras', $capybara->toArray());

        $this->assertDatabaseHas('capybaras', $capybara->toArray());
        $response->assertJsonFragment(['name' => $capybara->name]);
        $response->assertStatus(201);
    }

    #[DataProvider('invalidData')]
    public function test_capybara_invalid_input_has_validation_errors($input, $validationKeys): void
    {
        $response = $this->postJson('/api/capybaras', $input);

        $response->assertJsonValidationErrors($validationKeys);

        $response->assertStatus(422);
    }

    public function test_can_update_capybara(): void
    {
        $capybaraInput = [
            'name' => 'New Name',
            'hex_color' => '#000000',
            'height_inches' => 22,
            'length_inches' => 42,
        ];
        $capybara = Capybara::factory()->create();

        $this->assertDatabaseMissing('capybaras', $capybaraInput);

        $response = $this->putJson("/api/capybaras/{$capybara->id}", $capybaraInput);

        $this->assertDatabaseHas('capybaras', $capybaraInput);

        $response->assertStatus(200);
    }

    public function test_can_delete_capybara(): void
    {
        $capybara = Capybara::factory()->create();
        $response = $this->deleteJson("/api/capybaras/{$capybara->id}");

        $this->assertDatabaseMissing('capybaras', $capybara->toArray());

        $response->assertJson(['message' => 'deleted']);
        $response->assertStatus(200);
    }

    public static function invalidData(): array
    {
        return [
            'invalid data types' => [
                [
                    'name' => 12,
                    'hex_color' => 'invalid',
                    'height_inches' => 'twenty',
                    'length_inches' => '30.0',
                ],
                [
                    'name',
                    'hex_color',
                    'height_inches',
                    'length_inches'
                ]
            ],
            'missing required fields' => [
                [
                    'name' => '',
                    'hex_color' => '',
                    'height_inches' => '',
                    'length_inches' => '',
                ],
                [
                    'name',
                    'hex_color',
                    'height_inches',
                    'length_inches'
                ]
            ],
            'too big' => [
                [
                    'name' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris fermentum arcu urna, ut lacinia libero faucibus sodales. Proin quis sagittis massa, ut fermentum ex. Pellentesque nulla nulla, porta eget quam id, maximus faucibus magna. Curabitur malesuada, velit nec egestas accumsan, ipsum risus mollis tortor.',
                    'hex_color' => '#ffffffff',
                    'height_inches' => '102',
                    'length_inches' => '300',
                ],
                [
                    'name',
                    'hex_color',
                    'height_inches',
                    'length_inches'
                ]
            ]
        ];
    }

    /* public function test_can_paginate_capybaras(): void
    {
        $capybara = Capybara::limit(3)->get();
        $response = $this->getJson('/api/capybaras');

        $response->assertJsonFragment(['data' => $capybara->toArray()]);
        
        $response->assertJsonStructure(['current_page', 'links', 'last_page', 'total']);

        $response->assertStatus(200);
    } */
}
