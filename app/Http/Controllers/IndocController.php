<?php

namespace App\Http\Controllers;

use App\Organization;
use App\Indoc;
use Illuminate\Http\Request;

class IndocController extends Controller
{
    public function show($indoc_id){
        $indoc_item = Indoc::where('id',$indoc_id)->first();

        return view ('indoc.show',[
            'indoc_item' => $indoc_item
        ]);
    }
    public function edit($indoc_id)
    {
        $indoc = Indoc::find($indoc_id);
        $organizations = Organization::orderBy('name')->get();
        return view('indoc.edit',compact('indoc', 'organizations'));
    }
    public function update(Request $request, $indoc)
    {
        $input =$request->all();
        $indoc = Indoc::find($indoc);
        $indoc->num = $input['num'];
        $indoc->date = $input['date'];
        $indoc->outnum = $input['outnum'];
        $indoc->outdate = $input['outdate'];
        $indoc->text = $input['text'];
        $indoc->org_id = $input['org_id'];
        $indoc->save();

        return redirect('/');
    }
    public function create()
    {
        $organizations = Organization::orderBy('name')->get();
        return view('indoc.create', compact('organizations'));
    }
    public function store(Request $request)
    {
        $input =$request->all();
        Indoc::create($input);
        return redirect('/');
    }
}
