<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = \Faker\Factory::create();

    	for ($i=0; $i < 4; $i++) { 
    		$title=$faker->sentence();
    		DB::table('articles')->insert([
    			'category_id'=>rand(1,4),
    			'title'=>$title,
    			'image'=>$faker->imageUrl(360, 360, 'cats',true,'Faker'),
    			'content'=>$faker->paragraph(6),

    			'slug'=>Str::slug($title,'-'),
    			'created_at'=>now(),
    			'updated_at'=>now(),
                
    		]);
    	}

    }
}
