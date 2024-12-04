<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('albums')->delete();

        DB::table('albums')->insert(array(
            0 =>
            array(
                'album_title' => 'Afternoons in Utopia',
                'artist_id' => 1,
                'release_date' => '1985-06-05',
                'image' => 'album_images/album1.jpg',
            ),
            1 =>
            array(
                'album_title' => 'Forever Young',
                'artist_id' => 1,
                'release_date' => '1984-09-27',
                'image' => 'album_images/album2.jpg',
            ),
            2 =>
            array(
                'album_title' => '...But Seriously',
                'artist_id' => 3,
                'release_date' => '1989-11-07',
                'image' => 'album_images/album3.jpg',
            ),
            3 =>
            array(
                'album_title' => 'Face Value',
                'artist_id' => 3,
                'release_date' => '1981-02-13',
                'image' => 'album_images/album4.jpg',
            ),
            4 =>
            array(
                'album_title' => 'True',
                'artist_id' => 7,
                'release_date' => '1983-03-04',
                'image' => 'album_images/album5.jpg',
            ),
            5 =>
            array(
                'album_title' => 'Ocean of Crime',
                'artist_id' => 8,
                'release_date' => '1985-01-01',
                'image' => 'album_images/album6.jpg',
            ),
            6 =>
            array(
                'album_title' => 'Hunting High and Low',
                'artist_id' => 5,
                'release_date' => '1985-06-01',
                'image' => 'album_images/album7.jpg',
            ),
            7 =>
            array(
                'album_title' => 'Agent Provocateur',
                'artist_id' => 4,
                'release_date' => '1984-12-07',
                'image' => 'album_images/album8.jpg',
            ),
            8 =>
            array(
                'album_title' => 'Beggars Banquet',
                'artist_id' => 2,
                'release_date' => '1968-12-06',
                'image' => 'album_images/album9.jpg',
            ),
            9 =>
            array(
                'album_title' => 'Fine Young Cannibals',
                'artist_id' => 6,
                'release_date' => '1985-12-10',
                'image' => 'album_images/album10.jpg',
            ),
        ));
    }
}
