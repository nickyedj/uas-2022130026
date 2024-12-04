<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('songs')->delete();

        DB::table('songs')->insert(array (
            0 => array (
                'song_title' => 'Dance With Me',
                'artist_id' => 1,
                'album_id' => 1,
                'genre' => 'Synthpop',
                'description' => 'A rhythmic and dreamy track by Alphaville inviting listeners to join in a dance.',
                'audio' => 'audios/Alphaville_Dance_With_Me.mp3',
                'created_at' => '2024-12-04 00:00:00',
                'updated_at' => '2024-12-04 00:00:00',
            ),
            1 => array (
                'song_title' => 'Summer in Berlin',
                'artist_id' => 1,
                'album_id' => 2,
                'genre' => 'New Wave',
                'description' => 'A melancholic anthem describing the bittersweet vibes of summer in Berlin.',
                'audio' => 'audios/Alphaville_Summer_in_Berlin.mp3',
                'created_at' => '2024-12-04 00:00:00',
                'updated_at' => '2024-12-04 00:00:00',
            ),
            2 => array (
                'song_title' => 'To Germany with Love',
                'artist_id' => 1,
                'album_id' => 2,
                'genre' => 'Synthpop',
                'description' => 'A politically charged song about love and unity for Germany.',
                'audio' => 'audios/Alphaville_To_Germany_With_Love.mp3',
                'created_at' => '2024-12-04 00:00:00',
                'updated_at' => '2024-12-04 00:00:00',
            ),
            3 => array (
                'song_title' => 'Sun Always Shine on T.V.',
                'artist_id' => 5,
                'album_id' => 7,
                'genre' => 'Synthpop',
                'description' => 'An iconic track by a-ha blending emotional lyrics with powerful synths.',
                'audio' => 'audios/a-ha_The_Sun_Always_Shines_on_T.V..mp3',
                'created_at' => '2024-12-04 00:00:00',
                'updated_at' => '2024-12-04 00:00:00',
            ),
            4 => array (
                'song_title' => 'I Want To Know What Love Is',
                'artist_id' => 4,
                'album_id' => 8,
                'genre' => 'Rock Ballad',
                'description' => 'A heartfelt ballad by Foreigner about love and vulnerability.',
                'audio' => 'audios/Foreigner_I_Want_To_Know_What_Love_Is.mp3',
                'created_at' => '2024-12-04 00:00:00',
                'updated_at' => '2024-12-04 00:00:00',
            ),
            5 => array (
                'song_title' => 'In the Air Tonight',
                'artist_id' => 3,
                'album_id' => 4,
                'genre' => 'Soft Rock',
                'description' => 'A haunting and iconic song by Phil Collins known for its dramatic drum break.',
                'audio' => 'audios/Phil_Colins_In_the_Air_Tonight.mp3',
                'created_at' => '2024-12-04 00:00:00',
                'updated_at' => '2024-12-04 00:00:00',
            ),
            6 => array (
                'song_title' => 'Another Day in Paradise',
                'artist_id' => 3,
                'album_id' => 3,
                'genre' => 'Pop Rock',
                'description' => 'A socially conscious song highlighting the plight of the homeless.',
                'audio' => 'audios/Phil_Collins_Another_Day_in_Paradise.mp3',
                'created_at' => '2024-12-04 00:00:00',
                'updated_at' => '2024-12-04 00:00:00',
            ),
            7 => array (
                'song_title' => 'Sympathy For The Devil',
                'artist_id' => 2,
                'album_id' => 9,
                'genre' => 'Rock',
                'description' => 'A provocative and timeless rock classic by The Rolling Stones.',
                'audio' => 'audios/The_Rolling_Stones_Sympathy_For_The_Devil.mp3',
                'created_at' => '2024-12-04 00:00:00',
                'updated_at' => '2024-12-04 00:00:00',
            ),
            8 => array (
                'song_title' => 'Ocean of Crime',
                'artist_id' => 8,
                'album_id' => 6,
                'genre' => 'Synthpop',
                'description' => 'A dark, atmospheric track exploring themes of mystery and crime.',
                'audio' => 'audios/Stage_Ocean_Of_Crime.mp3',
                'created_at' => '2024-12-04 00:00:00',
                'updated_at' => '2024-12-04 00:00:00',
            ),
            9 => array (
                'song_title' => 'True',
                'artist_id' => 7,
                'album_id' => 5,
                'genre' => 'New Romantic',
                'description' => 'A romantic and soulful anthem by Spandau Ballet.',
                'audio' => 'audios/Spandau_Ballet_True.mp3',
                'created_at' => '2024-12-04 00:00:00',
                'updated_at' => '2024-12-04 00:00:00',
            ),
            10 => array (
                'song_title' => 'Johnny Come Home',
                'artist_id' => 6,
                'album_id' => 10,
                'genre' => 'Pop Rock',
                'description' => 'A dynamic track by Fine Young Cannibals addressing the struggles of youth.',
                'audio' => 'audios/Fine_Young_Cannibals_Johnny_Come_Home.mp3',
                'created_at' => '2024-12-04 00:00:00',
                'updated_at' => '2024-12-04 00:00:00',
            ),
        ));
    }
}
