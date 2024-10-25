<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\SectionItem;
use Faker\Factory as Faker;

class SectionSeeder extends Seeder
{
    // init faker
    private $faker;
    function __construct()
    {
        $this->faker = Faker::create();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = $this->getSections(5);
        foreach ($sections as $section) {
            $section = Section::create($section);
            $items = $this->getRandomItems($section->id);
            foreach ($items as $item) {
                SectionItem::create($item);
            }
        }
    }

    private function getRandomItems($sectionId, $count = 6)
    {
        $items = [];
        for ($i = 1; $i <= $count; $i++) {
            $colStart = $i % 3 == 0 ? 3 : $i % 3;
            $rowStart = $i > 3 ? 2 : 1;

            $items[] = [
                'section_id' => $sectionId,
                'title' => $this->faker->sentence(3),
                'animation' => $this->getAvaliableAnimations($colStart, $rowStart),
                'mobileAnimation' => $this->getAvailableMobileAnimations($i),
                'bgColor' => $this->faker->hexColor(),
                'textColor' => '#000000',
                'colSpan' => 1,
                'rowSpan' => 1,
                'colStart' => $colStart,
                'rowStart' => $rowStart,
                'isCarousel' => $this->faker->boolean(),
                'images' => $this->getImages($this->faker->numberBetween(2, 5)),
                'description' => 'This is item ' . $i . ', ' . $this->faker->sentence(10),
            ];
        }

        return $items;
    }

    private function getSections($count)
    {
        $sections = [];
        for ($i = 1; $i <= $count; $i++) {
            $name = $this->faker->sentence(3);
            $name = substr($name, 0, -1);
            $slug = strtolower(str_replace(' ', '-', $name));
            $sections[] = [
                'name' => $name,
                'slug' => $slug,
                'description' => $this->faker->sentence(10),
            ];
        }

        return $sections;
    }

    private function getAvaliableAnimations($colStart, $rowStart)
    {
        $rowAnimationMap = [
            1 => 'grid-to-bottom',
            2 => 'grid-to-top',
        ];

        $colAnimationMap = [
            1 => ['grid-to-right'],
            2 => ['grid-to-left', 'grid-to-right'],
            3 => ['grid-to-left'],
        ];

        return $this->faker->randomElement([
            $rowAnimationMap[$rowStart],
            ...$colAnimationMap[$colStart]
        ]);
    }

    private function getAvailableMobileAnimations($index)
    {
        $animations = [
            "mobile-grid-to-top",
            "mobile-grid-to-bottom",
        ];

        if ($index == 0) {
            return $animations[0];
        } else if ($index == 5) {
            return $animations[1];
        }

        return $this->faker->randomElement($animations);
    }

    private function getImages($count = 5)
    {
        $images = [];
        for ($i = 1; $i <= $count; $i++) {
            $images[] = 'https://placehold.co/400x400?text=Slide+' . $i;
        }

        return $images;
    }
}
