<?php

namespace Tests\Feature\Controllers;

use App\Models\Group;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexMethodWithExpectedAllResults()
    {
        Group::factory(10)->create();
        $response = $this->get('/api/groups');
        $response->assertStatus(200);
        $response->assertJsonCount(10);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'cnpj',
                'type',
                'active',
                'created_at',
                'updated_at'
            ]

        ]);
    }

    public function testSotreMethodWithExpectedSuccessResult()
    {
      $data = [
            'code' => 200,
            'name' => 'FBS Sistemas',
            'cnpj' => '86.714.220/0001-00',
            'type' => 1,
            'active' => 1
      ];

      $response = $this->post('api/groups',$data);
      $response->assertStatus(201);
    }
}
