<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware; 
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use App\Models\Device;
use App\Models\User;

class DevicesTest extends TestCase
{
    use RefreshDatabase;
    //use DatabaseMigrations;
    
    /** @test */
    public function can_device_can_be_instantiated()
    {
        $device = Device::factory()->make();

        $this->assertNotNull($device->model);
    }

    /** @test */
    public function a_user_can_read_all_devices()
    {
        //When user visit the tasks page
        $response = $this->get('/api/devices');

        //He should be able to read the task
        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_create_a_device()
    {
        $response = $this->postJson('/api/devices', [
            'model' => 'Apple 12',
            'brand' => 'Apple',
            'release_date' => '2022/06',
            'os' => 'Montana',
            'is_new' => true,
            'received_datatime' => now(),
            'created_datetime' => now(),
            'updated_datetime' => now()
        ]);
 
        $response
            ->assertStatus(201)
            ->assertSee(["New Device added"]);
    }

    /** @test */
    public function a_user_can_read_single_device()
    {
        $device = Device::factory()->make();

        $this->get('/api/devices/'. $device->id_site)
        ->assertStatus(200)
        ->assertSee($device->name)
        ->assertSee($device->address);

    }

    /** @test */
    public function a_user_can_update_single_device()
    {
		$newDevice = Device::factory()->create([
            'id' => '024834c0-b25c-4aa8-bd69-1b7e12cfcbaa',
            'brand' => 'changed brand name',
            'model' => 'Newly update mode'
        ]); 


        $this->json('PATCH', 'api/devices', $newDevice->toArray())
            ->assertStatus(200)
            ->assertJson([
                'original' => 'Device updated',
            ]);
    }

    public function testDeleteCEO()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $device = Device::factory()->create([
            'id' => '024834c0-b25c-4aa8-bd69-1b7e12cfcbaa',
            'brand' => 'changed brand name',
            'model' => 'Newly update mode'
        ]); 

        $this->json('DELETE', 'api/devices/' . $device->id, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson(
                ['original'  => 'Device deleted']
            );
    }

}