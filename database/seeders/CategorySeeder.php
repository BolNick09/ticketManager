<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Техническая проблема',
                'description' => 'Ошибки, сбои, некорректная работа системы'
            ],
            [
                'name' => 'Вопрос по оплате',
                'description' => 'Проблемы с оплатой и счетами'
            ],
            [
                'name' => 'Общий вопрос',
                'description' => 'Прочие вопросы'
            ],
        ]);
    }
}