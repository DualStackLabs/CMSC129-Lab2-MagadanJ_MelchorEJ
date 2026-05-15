<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Entry;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $school = Category::create(['name' => 'School', 'color_theme' => 'emerald']); 
        $work = Category::create(['name' => 'Work', 'color_theme' => 'blue']);
        $personal = Category::create(['name' => 'Personal', 'color_theme' => 'pink']);
        // 2. Create some sample journal entries assigned to these categories
        Entry::create([
            'title' => 'First Day of Vibecoding',
            'content' => 'Honestly, Laravel felt overwhelming at first, but the MVC structure is starting to click. I successfully set up my controllers and views today!',
            'mood' => 'Focused',
            'location' => 'Computer Lab',
            'is_favorite' => true,
            'category_id' => $school->id, // Assigned to School
        ]);

        Entry::create([
            'title' => 'We fixed the PostgreSQL Error!',
            'content' => 'Turns out PHP just needed me to uncomment the pdo_pgsql extension in the php.ini file. We are back in business.',
            'mood' => 'Happy',
            'location' => 'My Desk',
            'is_favorite' => true,
            'category_id' => $work->id, // Assigned to Work
        ]);

        Entry::create([
            'title' => 'Weekend Vibes',
            'content' => 'Finally got some time to relax, watch movies, and just disconnect for a bit. Much needed rest.',
            'mood' => 'Happy',
            'location' => 'Home',
            'is_favorite' => false,
            'category_id' => $personal->id, // Assigned to Personal
        ]);
    }
}