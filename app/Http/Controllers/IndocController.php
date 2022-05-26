<?php

namespace App\Http\Controllers;

use App\Indoc;
use App\Organization;
use Illuminate\Http\Request;

class IndocController extends Controller
{
    public function show($indoc_id){
        $indoc_item = Indoc::where('id',$indoc_id)->first();

        return view ('indoc.show',[
            'indoc_item' => $indoc_item
        ]);
    }
    public function showOrganization($org_id){
        $org = Organization::where('id',$org_id)->first();

        return view ('settings.organization.index');
    }
}
