<?php

namespace App\Http\Controllers;

use App\Indoc;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $indocs = Indoc::orderBy('created_at')->take(8)->get();

        return view ('home.index',[
            'indocs' => $indocs
        ]);
    }
}
