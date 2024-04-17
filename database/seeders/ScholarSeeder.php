<?php
namespace Database\Seeders; // Ensure this is immediately after the opening PHP tag.

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Scholar;

class ScholarSeeder extends Seeder
{
    public function run(): void
    {
        Scholar::factory()->count(5000)->create();
    }
}
