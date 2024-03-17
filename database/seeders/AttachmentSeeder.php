<?php

namespace Database\Seeders;

use App\Models\Attachment;
use App\Models\Incoming;
use Illuminate\Database\Seeder;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attachment::factory()->count(1)->for(
            Incoming::factory(), 'attachmentable'
        )->create();
    }
}
