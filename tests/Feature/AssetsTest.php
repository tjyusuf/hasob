<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Asset;

class AssetsTest extends TestCase
{
    use WithFaker;

    public function testGetAllAssets()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $this->getJson(route('assets'))
            ->assertStatus(200);
    }

    public function testRequiredFieldsForAssets()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $response = $this->postJson(route('assets.create'))
            ->assertStatus(422)
            ->assertJson([
                "errors" => [
                    'type' => ["The type field is required."],
                    'serial' => ["The serial field is required."],
                    'purchase' => ["The purchase field is required."],
                    'start_use' => ["The start use field is required."],
                    'warranty_expiry' => ["The warranty expiry field is required."],
                    'degradation_in_years' => ["The degradation in years field is required."],
                    'purchase_price' => ["The purchase price field is required."],
                    'current_value' => ["The current value field is required."],
                    'location' => ["The location field is required."],
                ]
            ]);
    }

    public function testSuccessfulAssetCreation()
    {

        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $asset = [
            'type' => $this->faker->word(),
            'serial' => $this->faker->randomNumber(),
            'purchase' => $this->faker->date(),
            'start_use' => $this->faker->date(),
            'warranty_expiry' => $this->faker->date(),
            'degradation_in_years' => $this->faker->randomDigit(),
            'purchase_price' => 50.5,
            'current_value' => 55.55,
            'location' => $this->faker->word()
        ];

        $response = $this->postJson(route('assets.create'),$asset)
                            ->assertStatus(201)
                            ->assertJson([
                                'data' => [
                                    'type' => $asset['type'],
                                    'serial' => $asset['serial'],
                                    'purchase' => $asset['purchase'],
                                    'start_use' => $asset['start_use'],
                                    'warranty_expiry' => $asset['warranty_expiry'],
                                    'degradation_in_years' => $asset['degradation_in_years'],
                                    'purchase_price' => $asset['purchase_price'],
                                    'current_value' => $asset['current_value'],
                                    'location' => $asset['location'],
                                ],
                            ]);
    }


    public function testAssetRetrieval()
    {


        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $asset = Asset::factory()->create();

        $response = $this->getJson(route('assets.show',['asset'=>$asset->id]))
                            ->assertStatus(200)
                            ->assertJson([
                                'data' => [
                                    'type' => $asset['type'],
                                    'serial' => $asset['serial'],
                                    'purchase' => $asset['purchase'],
                                    'start_use' => $asset['start_use'],
                                    'warranty_expiry' => $asset['warranty_expiry'],
                                    'degradation_in_years' => $asset['degradation_in_years'],
                                    'purchase_price' => $asset['purchase_price'],
                                    'current_value' => $asset['current_value'],
                                    'location' => $asset['location'],
                                ],
                            ]);
    }

    public function testAssetDeletion()
    {

        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $asset = Asset::factory()->create();

        $this->json('delete', route('assets.show',['asset'=>$asset->id]))
        ->assertNoContent();
        $this->assertDatabaseMissing('assets', $asset->getRawOriginal());        
    }

    public function testAssetUpdating()
    {

        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $asset = Asset::factory()->create();

        $update = [
            'type' => $this->faker->word(),
            'serial' => $this->faker->randomNumber()
        ];

        $response = $this->putJson(route('assets.update',['asset'=>$asset->id]),$update)
                            ->assertStatus(200)
                            ->assertJson([
                                'data' => [
                                    'type' => $update['type'],
                                    'serial' => $update['serial'],
                                ],
                            ]);

    }


    public function testMissingAssetRetrieval()
    {

        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $asset = Asset::factory()->create();

        $response = $this->getJson(route('assets.show',['asset'=>0]))    
             ->assertStatus(404);
        
    }
        
}
