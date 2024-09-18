<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\SessiondocCategory;

class SessionDocCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $categories = [
      'Agenda',
      'Order of Business',
      'Questions Hour',
      'Committee Reports',
      'Acts',
      'Resolutions',
      'Bills',
      'Sitting Diagram',
      'Draft Resolution',
      'Videos',
      'Audios',
    ];

    foreach ($categories as $category) {
      SessiondocCategory::updateOrCreate(
        ['name' => $category],
      );
    }
    }
}
