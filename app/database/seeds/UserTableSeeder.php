<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 19/04/14
 * Time: 16:47
 */

class UserTableSeeder extends Seeder {

    public function run() {
        User::truncate();
        User::create(array('username' => "test", "password" => Hash::make("foo")));
    }

} 