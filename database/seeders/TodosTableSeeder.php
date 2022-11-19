<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Todo;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'task' => 'テスト1',
            'tag_id' => '1',
            'user_id' => '1'
        ];
        Todo::create($param);
        $param = [
            'task' => 'テスト2',
            'tag_id' => '2',
            'user_id' => '1'
        ];
        Todo::create($param);
        $param = [
            'task' => 'テスト3',
            'tag_id' => '3',
            'user_id' => '1'
        ];
        Todo::create($param);
    }
}
