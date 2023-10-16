<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new DatabaseSeeder())->seedTableFromJsonFile('nodes');
    }

    protected function getItems()
    {
        return [
            [
                'title' => 'Главное меню',
                'page_id' => null,
                'path' => '1',
                'parent_path' => null,
                'order' => 1,
                'href' => null
            ],
            [
                'title' => 'Ремонт квартир',
                'page_id' => 1,
                'path' => '1.1',
                'parent_path' => '1',
                'order' => 1,
                'href' => null
            ],
            [
                'title' => 'Цены',
                'page_id' => null,
                'path' => '1.1.1',
                'parent_path' => '1.1',
                'order' => 1,
                'href' => '/price'
            ],
            [
                'title' => 'Этапы ремонта',
                'page_id' => null,
                'path' => '1.1.2',
                'parent_path' => '1.1',
                'order' => 2,
                'href' => null
            ],
            [
                'title' => 'Демонтажные работы',
                'page_id' => null,
                'path' => '1.1.2.1',
                'parent_path' => '1.1.2',
                'order' => 1,
                'href' => null
            ],
            [
                'title' => 'Устройство перегородок',
                'page_id' => null,
                'path' => '1.1.2.2',
                'parent_path' => '1.1.2',
                'order' => 2,
                'href' => null
            ],
            [
                'title' => 'Портфолио',
                'page_id' => null,
                'path' => '1.1.3',
                'parent_path' => '1.1',
                'order' => 3,
                'href' => '/portfolio'
            ],
            [
                'title' => 'Отделка коттеджей',
                'page_id' => 2,
                'path' => '1.2',
                'parent_path' => '1',
                'order' => 2,
                'href' => null
            ],
            [
                'title' => 'Стоимость',
                'page_id' => null,
                'path' => '1.2.1',
                'parent_path' => '1.2',
                'order' => 1,
                'href' => '/otdelka_price'
            ],
            [
                'title' => 'Дизайн интерьера',
                'page_id' => 3,
                'path' => '1.3',
                'parent_path' => '1',
                'order' => 3,
                'href' => null
            ],
            [
                'title' => 'Инженерные системы',
                'page_id' => 4,
                'path' => '1.4',
                'parent_path' => '1',
                'order' => 4,
                'href' => null
            ],
            [
                'title' => 'Компания',
                'page_id' => null,
                'path' => '1.5',
                'parent_path' => '1',
                'order' => 5,
                'href' => null
            ],
        ];
    }

}
