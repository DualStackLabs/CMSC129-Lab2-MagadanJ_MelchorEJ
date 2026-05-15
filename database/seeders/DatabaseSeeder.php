<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Entry;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create our required Category first (so the foreign key doesn't break)
        $category = Category::create([
            'name' => 'General Vibes',
        ]);

        // 2. Create some sample journal entries
        Entry::create([
            'title' => 'First Day of Vibecoding',
            'content' => 'Honestly, Laravel felt overwhelming at first, but the MVC structure is starting to click. I successfully set up my controllers and views today!',
            'mood' => 'Focused',
            'location' => 'Computer Lab',
            'is_favorite' => true,
            'category_id' => $category->id,
        ]);

        Entry::create([
            'title' => 'Stressed about finals',
            'content' => 'So many projects due this week. I need to make sure my F2F defense for this journal app goes perfectly.',
            'mood' => 'Stressed',
            'location' => 'Library',
            'is_favorite' => false,
            'category_id' => $category->id,
        ]);

        Entry::create([
            'title' => 'We fixed the PostgreSQL Error!',
            'content' => 'Turns out PHP just needed me to uncomment the pdo_pgsql extension in the php.ini file. We are back in business.',
            'mood' => 'Happy',
            'location' => 'My Desk',
            'is_favorite' => true,
            'category_id' => $category->id,
        ]);
    }
}