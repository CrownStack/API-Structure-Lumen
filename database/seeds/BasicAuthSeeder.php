<?php
use Illuminate\Database\Seeder;
use App\Model\BasicAuth;
class BasicAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BasicAuth::insert([
            'id' => \Faker\Provider\Uuid::uuid(),
            'name' => 'Flaer Project',
            'email' => 'info@flaer.com',
            'password' => sha1('password'),
            'user_agent' => 'Opera/8.55 (Windows NT 5.0; en-US) Presto/2.12.223 Version/12.00',
            'access_token' => '4f7a94f9cf36efa1b5d4167106d76023154704ea1d4035e874a1ae06f946dhc9',
            'refresh_token' => '8ee56fd8c6d612c2250d76b40b1455b0423068c9',
            'expire' => '52941443',
            'app_id' => 'qMreNqzjGieLP1WG'
        ]);
        BasicAuth::insert([
            'id' => \Faker\Provider\Uuid::uuid(),
            'name' => 'Basic Auth',
            'email' => 'token@crownstack.com',
            'password' => sha1('password'),
            'user_agent' => 'Opera/8.55 (Windows NT 5.0; en-US) Presto/2.12.223 Version/12.00',
            'access_token' => '4f7a94f9cf36efa1b5d4167106d76023154704ea1d4035e874z1ae06f956dhd9',
            'refresh_token' => '8ee56fd8c6d612c2250d76b40b1455b0423068c0',
            'expire' => '52941443',
            'app_id' => 'qMreNqzjGieLP1WH'
        ]);
    }
}