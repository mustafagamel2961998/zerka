<?php

namespace Database\Seeders\About;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\About;
class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $about = About::create();
        $about->translations()->create([
            'locale' => 'ar',
            'content'   => 'من نحن',
        ]);
        $about->translations()->create([
            'locale' => 'en',
            'content'   => 'About Us',
        ]);
    }
}
