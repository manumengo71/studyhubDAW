<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::factory()->count(25)->create();

        $courses = Course::all();

        $urls = [
            'https://i.postimg.cc/RFZSnrXf/anh-nguyen-kc-A-c3f-3-FE-unsplash.jpg',
            // 'https://i.postimg.cc/LXQHtybW/blake-connally-IKUYGCFmfw4-unsplash.jpg',
            'https://i.postimg.cc/Hkbsq9rJ/max-duzij-q-Aj-Jk-un3-BI-unsplash.jpg',
            'https://i.postimg.cc/zX6Ft8hz/anna-pelzer-IGf-IGP5-ONV0-unsplash.jpg',
            'https://i.postimg.cc/fLCvBdcp/campaign-creators-ykt-K2qai-VHI-unsplash.jpg',
            'https://i.postimg.cc/ryhJ4SFt/chad-montano-Mq-T0asuo-Ic-U-unsplash.jpg',
            'https://i.postimg.cc/GhHjxHHg/victoria-shes-UC0-HZd-Uit-WY-unsplash.jpg',
            'https://i.postimg.cc/CLBjfXQW/diego-ph-f-Iq0t-ET6llw-unsplash.jpg',
            'https://i.postimg.cc/bN710LXd/fotis-fotopoulos-LJ9-KY8p-IH3-E-unsplash.jpg',
            'https://i.postimg.cc/qBZsq4js/michael-dziedzic-Vl-ZYu3n-ZIRI-unsplash.jpg',
            'https://i.postimg.cc/vmJWhzx0/alex-kotliarskyi-our-QHRTE2-IM-unsplash.jpg',
            'https://i.postimg.cc/rFjNTx7p/hitesh-choudhary-D9-Zow2-REm8-U-unsplash.jpg',
            'https://i.postimg.cc/BZxChdgH/jackson-sophat-t-l5-FFH8-VA-unsplash.jpg',
            'https://i.postimg.cc/K8Yr84yD/kobu-agency-ip-ARHax-ETRk-unsplash.jpg',
            'https://i.postimg.cc/VNrqXTvS/michiel-leunens-0w-IHsm2-1fc-unsplash.jpg',
            'https://i.postimg.cc/HWNC2vpw/luis-villasmil-ITFw-Hd-PEED0-unsplash.jpg'
        ];

        foreach ($courses as $course) {
            $course->addMediaFromUrl($urls[array_rand($urls)])->toMediaCollection('courses_images');
        }
    }
}
