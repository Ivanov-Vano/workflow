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
    /*    public function showOrganization($org_id){
        $org = Organization::where('id',$org_id)->first();

        return view ('settings.organization.index');
    }*/

}

