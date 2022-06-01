<?php

namespace App\Http\Controllers;

use App\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function store()
    {
        Organization::create([
            'name' => request('name')
        ]);
        return redirect('/create');
    }
}

