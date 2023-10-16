<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new DatabaseSeeder())->seedTableFromJsonFile('items');
    }

    protected function getItems()
    {
        return [
            [
                'title' => 'Ремонт квартир',
                'page_id' => 1,
                'parent_id' => null,
                'order' => 1,
                'href' => null
            ],
                [
                    'title' => 'Цены',
                    'page_id' => null,
                    'parent_id' => 1,
                    'order' => 1,
                    'href' => '/price'
                ],
                [
                    'title' => 'Этапы ремонта',
                    'page_id' => null,
                    'parent_id' => 1,
                    'order' => 2,
                    'href' => null
                ],
                    [
                        'title' => 'Демонтажные работы',
                        'page_id' => null,
                        'parent_id' => 3,
                        'order' => 1,
                        'href' => null
                    ],
                    [
                        'title' => 'Устройство перегородок',
                        'page_id' => null,
                        'parent_id' => 3,
                        'order' => 2,
                        'href' => null
                    ],
                [
                    'title' => 'Портфолио',
                    'page_id' => null,
                    'parent_id' => 1,
                    'order' => 3,
                    'href' => '/portfolio'
                ],
            [
                'title' => 'Отделка коттеджей',
                'page_id' => 2,
                'parent_id' => null,
                'order' => 2,
                'href' => null
            ],
                [
                    'title' => 'Стоимость',
                    'page_id' => null,
                    'parent_id' => 7,
                    'order' => 1,
                    'href' => '/otdelka_price'
                ],
            [
                'title' => 'Дизайн интерьера',
                'page_id' => 3,
                'parent_id' => null,
                'order' => 3,
                'href' => null
            ],
            [
                'title' => 'Инженерные системы',
                'page_id' => 4,
                'parent_id' => null,
                'order' => 4,
                'href' => null
            ],
            [
                'title' => 'Компания',
                'page_id' => null,
                'parent_id' => null,
                'order' => 5,
                'href' => null
            ],
        ];
    }
}
