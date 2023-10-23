<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PageSeeder::class,
            ComponentSeeder::class,
            GallerySeeder::class,
            BlockSeeder::class,
            ImageSeeder::class,
            NodeSeeder::class,
            BidSeeder::class,
        ]);
    }

    protected function seedTables(): void
    {
        $tables = ['pages', 'components', 'galleries', 'blocks', 'images', 'nodes', 'bids'];

        foreach ($tables as $table){
            $this->seedTableFromJsonFile($table);
        }
    }

    public function seedTableFromJsonFile(string $table): void
    {
        $items = json_decode(file_get_contents(database_path("seeders/src/$table.json")), 1);

        clearDbTable($table);

        DB::table($table)->upsert($items, ['id']);
    }

    /**
     * Save json files from db tables
     */
    public function reverse(): void
    {
        $tables = ['pages', 'components', 'galleries', 'blocks', 'images', 'nodes', 'bids'];

        foreach ($tables as $table){
            $keys = Schema::getColumnListing($table);
            $keys = array_filter($keys, fn($v) => ! in_array($v, ['level']));

            $items = DB::table($table)->get($keys);

            file_put_contents(database_path("seeders/src/$table.json"), json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }
}
