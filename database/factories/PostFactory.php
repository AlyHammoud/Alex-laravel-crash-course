<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Post::class;
    
    public function definition()
    { 
        //first
        //in sail artisan tinker
            //App\Models\Post->facotry()->times(200)->create(['user_id' => 2]);
            //means (add 200 fake value for user id 2)
        return [
            'body' => $this->faker->sentence(20),
        ];
    }
}
