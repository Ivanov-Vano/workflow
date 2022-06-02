<?php

namespace App\Http\Controllers;

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
    public function edit($indoc)
    {
        $indoc = Indoc::find($indoc)->get();
        return view('indoc.edit',compact('indoc'));
    }
}
