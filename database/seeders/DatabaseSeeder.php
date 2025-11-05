<?php

namespace Database\Seeders;

use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Menu;
use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use App\Models\Reservation;
use App\Models\Sheet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Breakshot Admin',
            'email' => 'breakshotbali@gmail.com',
        ]);

        $categories = ['Asian Food', 'Western Food', 'Sweeties', 'Snack Delights', 'Beer'];
        Category::insert(array_map(function($category) {
            return ['id' => str($category)->lower()->explode(' ')->implode('-'), 'name' => $category, 'created_at' => now(), 'updated_at' => now()];
        }, $categories));

        Menu::factory()->create(['label' => 'Best Seller']);
        Menu::factory()->create(['name' => 'Mie Goreng', 'price' => 20000]);

        Event::factory()->create([
            'name' => 'DJ Performances',
            'weekly_day' => 5,
            'weekly_hour' => "21:00:00",
        ]);
        Event::factory()->create([
            'name' => 'Live Music',
            'weekly_day' => 6,
            'weekly_hour' => "21:00:00",
        ]);
        Event::factory()->create();
        Event::factory()->create([
            'name' => 'Event Dangdut 2',
            'start' => Carbon::parse('2025-09-21'),
            'end' => Carbon::parse('2025-09-21')
        ]);
        $sheet = Sheet::create([
            'year' => 2025,
            'link' => 'https://docs.google.com/spreadsheets/d/1qS6l1ZxqRH8QNJNjXorSloKCu2u34okoDYnck7pjevI/edit?gid=0#gid=0',
            'file_id' => '1qS6l1ZxqRH8QNJNjXorSloKCu2u34okoDYnck7pjevI'
        ]);
        Reservation::create([
            'name' => 'Aditya',
            'group' => 'Grup Jaya',
            'start' => Carbon::parse('2025-08-22, 18:00:00'),
            'end' => Carbon::parse('2025-08-22, 21:00:00'),
            'agenda' => 'Arisan',
            'phone' => '+628973891362',
            'count' => 20,
            'type' => 'Karaoke',
            'menu_type' => 'A la carte',
            'sheet_id' => $sheet->id
        ]);
    }
}
