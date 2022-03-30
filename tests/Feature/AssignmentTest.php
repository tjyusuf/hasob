<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Asset;
use App\Models\Assignment;

class AssignmentTest extends TestCase
{
    use WithFaker;

    public function testGetAllAssignments()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $this->getJson(route('assignments'))
            ->assertStatus(200);
    }

    public function testRequiredFieldsForAssignments()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $response = $this->postJson(route('assignments.create'))
            ->assertStatus(422)
            ->assertJson([
                "errors" => [
                    'assignment_date' => ["The assignment date field is required."],
                    'asset_id' => ["The asset id field is required."],
                    'assigned_by' => ["The assigned by field is required."],
                ]
            ]);
    }

    public function testSuccessfulAssignmentCreation()
    {

        $user = User::factory()->create();
        $asset = Asset::factory()->create();
        $this->actingAs($user, 'api');
        $assignment = [
            'assignment_date' => $this->faker->date(),
            'assigned_by' => $user->id,
            'asset_id' => $asset->id
        ];

        $response = $this->postJson(route('assignments.create'),$assignment)
                            ->assertStatus(201)
                            ->assertJson([
                                'data' => [
                                    'assignment_date' => $assignment['assignment_date'],
                                    'assigned_by' => $assignment['assigned_by'],
                                    'asset_id' => $assignment['asset_id'],
                                ],
                            ]);
    }


    public function testAssignmentRetrieval()
    {


        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $assignment = Assignment::factory()->create();

        $response = $this->getJson(route('assignments.show',['assignment'=>$assignment->id]))
                            ->assertStatus(200)
                            ->assertJson([
                                'data' => [
                                    'assignment_date' => $assignment['assignment_date'],
                                    'assigned_by' => $assignment['assigned_by'],
                                    'asset_id' => $assignment['asset_id'],
                                ],
                            ]);
    }

    public function testAssignmentDeletion()
    {

        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $assignment = Assignment::factory()->create();

        $this->json('delete', route('assignments.show',['assignment'=>$assignment->id]))
        ->assertNoContent();
        $this->assertDatabaseMissing('assignments', $assignment->getRawOriginal());        
    }

    public function testAssignmentUpdating()
    {

        $user = User::factory()->create();
        $asset = Asset::factory()->create();
        $this->actingAs($user, 'api');
        $assignment = Assignment::factory()->create();

        $update = [
            'assignment_date' => $this->faker->date(),
            'assigned_by' => $user->id,
            'asset_id' => $asset->id
        ];

        $response = $this->putJson(route('assignments.update',['assignment'=>$assignment->id]),$update)
                            ->assertStatus(200)
                            ->assertJson([
                                'data' => [
                                    'assignment_date' => $update['assignment_date'],
                                    'assigned_by' => $update['assigned_by'],
                                    'asset_id' => $update['asset_id'],
                                ],
                            ]);

    }


    public function testMissingAssignmentRetrieval()
    {

        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $assignment = Assignment::factory()->create();

        $response = $this->getJson(route('assignments.show',['assignment'=>0]))    
             ->assertStatus(404);
        
    }

}
