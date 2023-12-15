<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Headquarter;

class HeadquarterTest extends TestCase
{    
    public function test_show()
    {
        // Crear una nueva sede
        $headquarter =  Headquarter::factory()->times( 1 )->create();
        
        // Peticionar a la api esa sede
        $response = $this->getJson( '/api/headquarter/'.$headquarter[0]->id );

        // Comprobar la devolución
        $response->assertStatus(200);
    }
}
