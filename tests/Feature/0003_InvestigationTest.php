<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvestigationTest extends TestCase
{
    use WithoutMiddleware;
    public function test_store()
    {
        $response = $this->postJson('/api/investigation',[
            'title' => 'test',
            'asignament_id' => 1,
            'line_id' => 1,
            'resolution' => 'test',
            'resolution_date' => '2023-01-01',
            'start' => '2023-01-01',
            'end' => '2023-01-01',
            'announcement_id' => 1,
            'impact_id' => 1,
            'general' => 'test',
            'specific' => null,
            'observation' => null,
            'lecturers' => [[
                'value' => 1,
                'label' => '',
            ],
            [
                'value' => 2,
                'label' => ''
            ]],
            'students' => null,
            'laboratories' => null,

        ])->dump();

        $response->assertStatus(200);
    }

    // public function test_update()
    // {
    //     $response = $this->putJson('investigation/1',[
    //         'title' => 'test2',
    //         'asignament_id' => 1,
    //         'line_id' => 1,
    //         'resolution' => 'test',
    //         'resolution_date' => '2023-01-01',
    //         'start' => '2023-01-01',
    //         'end' => '2023-01-01',
    //         'announcement_id' => 1,
    //         'impact_id' => 1,
    //         'general' => 'test',
    //         'specific' => null,
    //         'observation' => null,
    //         'lecturers' => [[
    //             'value' => 2,
    //             'label' => '',
    //         ],
    //         [
    //             'value' => 1,
    //             'label' => ''
    //         ]],
    //         'students' => null,
    //         'laboratories' => null,
    //         'status' => 1,
    //     ]);

    //     $response->assertStatus(200);
    // }
}
