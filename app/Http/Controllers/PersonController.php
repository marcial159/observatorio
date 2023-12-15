<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;

class PersonController extends Controller
{
    public function search( $document )
    {
        $person = Person::where('document',$document)->firstOrFail();
        return response()->json($person);
    }
}
