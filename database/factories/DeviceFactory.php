<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'model' => Str::random(15),
            'brand' => Str::random(15),
            'release_date' => Carbon::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'))->format('Y/m'),
            'os' => Str::random(20),
            'is_new' => $this->faker->boolean(),
            'received_datatime' => now(),
            'created_datetime' => now(),
            'update_datetime' => now()
        ];
    }
}
