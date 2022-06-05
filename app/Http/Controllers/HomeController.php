<?php

namespace App\Http\Controllers;

use App\Indoc;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $indocs = Indoc::orderBy('created_at')->get();

        return view ('home.index',[
            'indocs' => $indocs
        ]);
    }
}
