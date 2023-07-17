<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function helloWorld($id) {
        return view('about.hello', [
            'id' => $id,
            'info' => [
                'name' => 'Peter',
                'address' => 'Bangkok'
            ]
        ]);
    }
}
