<?php

namespace Database\Seeders;

use App\Models\Node;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nodes = [
            ['id' => 1, 'name' => 'Organization','parent_id' => null],
            ['id' => 2, 'name' => 'School A',   'parent_id' => 1],
            ['id' => 3, 'name' => 'Classroom A','parent_id' => 2],
            ['id' => 4, 'name' => 'Family AA',  'parent_id' => 3],
            ['id' => 5, 'name' => 'Family AB',  'parent_id' => 3],
            ['id' => 6, 'name' => 'Node AAA',   'parent_id' => 4],
            ['id' => 7, 'name' => 'Node AAB',   'parent_id' => 6],
            ['id' => 8, 'name' => 'Node ABA',   'parent_id' => 5],
            ['id' => 9, 'name' => 'Node ABB',   'parent_id' => 8],

            ['id' => 10, 'name' => 'School B',   'parent_id' => 1],
            ['id' => 11, 'name' => 'Classroom BA','parent_id' => 10],
            ['id' => 12, 'name' => 'Family BA',  'parent_id' => 11],
            ['id' => 13, 'name' => 'Family BB',  'parent_id' => 11],
            ['id' => 14, 'name' => 'Classroom BB',   'parent_id' => 10],

            ['id' => 15, 'name' => 'School C',   'parent_id' => 1],
            ['id' => 16, 'name' => 'Classroom CA','parent_id' => 15],
            ['id' => 17, 'name' => 'Family CA',  'parent_id' => 16],
            ['id' => 18, 'name' => 'Family CB',  'parent_id' => 16],
            ['id' => 19, 'name' => 'Classroom CB',   'parent_id' => 15]
        ];

        foreach ($nodes as $node)
        {
            Node::create($node);
        }


    }
}
