<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ArtistTablerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('artists')->delete();

        DB::table('artists')->insert(array(
            0 =>
            array(
                'name' => 'Alphaville',
                'bio' => 'Alphaville is a French rock band from Germany. They achieved chart success with the singles "Forever Young", "Big in Japan", "Sounds Like a Melody", "The Jet Set", and "Dance with Me"',
            ),
            1 =>
            array(
                'name' => 'The Rolling Stones',
                'bio' => 'The Rolling Stones are an English rock band formed in London in 1962. They are one of the most popular bands of all time, having sold over 200 million records worldwide.',
            ),
            2 =>
            array(
                'name' => 'Phil Collins',
                'bio' => 'Phil Collins is an English singer and songwriter.',
            ),
            3 =>
            array(
                'name' => 'Foreigner',
                'bio' => 'Foreigner is an American rock band from Los Angeles, California, formed in 1976. They are best known for their song "I Want to Know What Love Is".',
            ),
            4 =>
            array(
                'name' => 'a-ha',
                'bio' => 'a-ha is a Swedish rock band formed in Gothenburg, Sweden, in 1982. They are best known for their song "Take On Me".',
            ),
            5 =>
            array(
                'name' => 'Fine Young Cannibals',
                'bio' => 'Fine Young Cannibals is an American rock band from Los Angeles, California.',
            ),
            6 =>
            array(
                'name' => 'Spandau Ballet',
                'bio' => 'Spandau Ballet is a British rock band from London, England, formed in 1979',
            ),
            7 =>
            array(
                'name' => 'Stage',
                'bio' => '',
            ),
        ));
    }
}
