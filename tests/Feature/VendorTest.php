<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Vendor;

class VendorTest extends TestCase
{
    use WithFaker;

    public function testGetAllVendors()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $this->getJson(route('vendors'))
            ->assertStatus(200);
    }

    public function testRequiredFieldsForVendors()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $response = $this->postJson(route('vendors.create'))
            ->assertStatus(422)
            ->assertJson([
                "errors" => [
                    'name' => ["The name field is required."],
                    'category' => ["The category field is required."],
                ]
            ]);
    }

    public function testSuccessfulVendorCreation()
    {

        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $vendor = [
            'name' => $this->faker->word(),
            'category' => $this->faker->word()
        ];

        $response = $this->postJson(route('vendors.create'),$vendor)
                            ->assertStatus(201)
                            ->assertJson([
                                'data' => [
                                    'name' => $vendor['name'],
                                    'category' => $vendor['category'],
                                ],
                            ]);
    }


    public function testAssetRetrieval()
    {


        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $vendor = Vendor::factory()->create();

        $response = $this->getJson(route('vendors.show',['vendor'=>$vendor->id]))
                            ->assertStatus(200)
                            ->assertJson([
                                'data' => [
                                    'name' => $vendor['name'],
                                    'category' => $vendor['category'],
                                ],
                            ]);
    }

    public function testAssetDeletion()
    {

        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $vendor = Vendor::factory()->create();

        $this->json('delete', route('vendors.show',['vendor'=>$vendor->id]))
        ->assertNoContent();
        $this->assertDatabaseMissing('vendors', $vendor->getRawOriginal());        
    }

    public function testAssetUpdating()
    {

        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $vendor = Vendor::factory()->create();

        $update = [
            'name' => $this->faker->word(),
            'category' => $this->faker->randomNumber()
        ];

        $response = $this->putJson(route('vendors.update',['vendor'=>$vendor->id]),$update)
                            ->assertStatus(200)
                            ->assertJson([
                                'data' => [
                                    'name' => $update['name'],
                                    'category' => $update['category'],
                                ],
                            ]);

    }


    public function testMissingAssetRetrieval()
    {

        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $vendor = Vendor::factory()->create();

        $response = $this->getJson(route('vendors.show',['vendor'=>0]))    
             ->assertStatus(404);
        
    }
        
}