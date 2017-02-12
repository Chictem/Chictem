<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $this->call(DataTypesTableSeeder::class);
	    $this->call(DataRowsTableSeeder::class);
	    $this->call(CategoriesTableSeeder::class);
	    $this->call(MenuItemsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(BannersTableSeeder::class);
        $this->call(BannerItemsTableSeeder::class);
        $this->call(ExpertsTableSeeder::class);
    }
}
