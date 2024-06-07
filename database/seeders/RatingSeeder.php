<?php

namespace Database\Seeders;

use App\Models\rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratingRecords = [
            ['id' => 1, 'users_id' => 1, 'bukus_id'=> 1, 'review' => 'gooooood', 'rating' => 4, 'status' => 0],
            ['id' => 2, 'users_id' => 1,  'bukus_id'=> 2, 'review' => 'gooooood', 'rating' => 4, 'status' => 0],
            ['id' => 2, 'users_id' => 1,  'bukus_id'=> 3, 'review' => 'gooooood', 'rating' => 4, 'status' => 0],
        ];

        rating::insert($ratingRecords);
    }
}
