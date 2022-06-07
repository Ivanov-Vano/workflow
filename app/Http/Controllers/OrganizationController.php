<?php

namespace App\Http\Controllers;

use App\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index(){
        $organizations = Organization::orderBy('name')->get();
         return view ('settings.organization.index',[
            'organizations' => $organizations
        ]);
    }
    public function create()
    {
        return view('settings.organization.create');
    }
    public function store(Request $request)
    {
        $input = $request->all();

        Organization::create($input);
        return redirect('/organizations');
    }

    public function show($org_id){
        $organization_item = Organization::where('id',$org_id)->first();

        return view ('settings.organization.edit', compact('organization_item'));
    }
    public function edit($org_id)
    {
        $organization = Organization::find($org_id);
        return view('settings.organization.edit',compact('organization'));
    }
    public function update(Request $request, $organization)
    {
        $input =$request->all();
        $organization = Organization::find($organization);
        $organization->name = $input['name'];
        $organization->save();

        return redirect('/organizations');
    }

    public function destroy($organization)
    {

        Organization::find($organization)->delete();
        return redirect()->back();
    }
/*    public function store()
    {
        Organization::create([
            'name' => request('name')
        ]);
        return redirect('/organization');
    }*/

    /*    public function showOrganization($org_id){
        $org = Organization::where('id',$org_id)->first();

        return view ('settings.organization.index');
    }*/

}

