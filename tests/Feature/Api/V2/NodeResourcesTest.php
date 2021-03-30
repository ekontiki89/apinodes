<?php

namespace Tests\Feature\Api\V2;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use  Illuminate\Testing\TestResponse;

use Tests\TestCase;

class NodeResourcesTest extends TestCase
{

    public function test_success_with_200_if_asserting_an_json_structure(){
        $node_id =  8;
        $response =  $this->getJson("/api/v2/nodes/$node_id/parents");
        $response->assertStatus(200)
        ->assertJsonStructure(
            [
                'data' => [
                '*' => ['id', 'parent_id', 'name']
                ],
                'links' => ['first', 'last', 'prev', 'next'],
                'meta' => [
                'current_page', 'last_page', 'from', 'to',
                'path', 'per_page', 'total'
                    ]
            ]

        );
    }

    public function test_success_with_a_200_if_node_is_not_child(){
        $node_id =  1;
        $response =  $this->getJson("/api/v2/nodes/$node_id/parents");
        $response->assertStatus(200)
            ->assertExactJson([
                'exception'=> 'ParentException',
                'message'=> 'No hay un padre',
                'code'=> 200
            ]);
    }

    public function test_success_with_a_200_if_node_is_not_parent(){
        $node_id =  19;
        $response =  $this->getJson("/api/v2/nodes/$node_id/children");
        $response->assertStatus(200)
            ->assertExactJson([
                'exception'=> 'ChildException',
                'message'=> 'No hay hijos',
                'code'=> 200
            ]);
    }

    public function test_failed_with_a_404_if_node_is_not_found()
    {
        $node_id =  100;
        $response =  $this->getJson("/api/v2/nodes/$node_id/parents");
        $response->assertStatus(404)
            ->assertExactJson([
                'exception'=> 'ModelNotFoundException',
                'message'=> 'Nodo no encontrado id: '.$node_id,
                'code'=> 404
        ]);

    }
    public function test_failed_with_a_404_route_not_found(){
        $node_id =  19;
        $response =  $this->getJson("/api/v2/nodes/$node_id/childrens");
        $response->assertStatus(404)
            ->assertExactJson([
                'exception'=> 'NotFoundHttpException',
                'message'=> 'Ruta no encontrada',
                'code'=> 404
            ]);
    }
}
