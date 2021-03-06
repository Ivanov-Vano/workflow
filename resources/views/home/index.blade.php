@extends('layouts.main')
@section('content')
    <div class="page-container">
        <div class="page-content-wrapper animated fadeInRight">
            <div class="page-content">
                <div class="row wrapper border-bottom page-heading">
                     <div class="panel-heading text-center"><h2>Документооборот</h2></div>
                    <div class="d-flex justify-content-md-end">
                        <select name="orderby" class="form-control text-gray-soft" id="inlineFormCustomSelect">
                            <option class="item" value="popularity">По умолчанию</option>
                            <option value="date">Сортировка по новизне</option>
                            <option value="price" selected="selected">Sort by price: low to high</option>
                            <option value="price-desc">Sort by price: high to low</option>
                        </select>
                    </div>
                    <div class="wrapper-content">
                        <div class=" pull-right">
                            <a class="btn btn-sm blue" role="button" data-toggle="collapse" href="#filter-form" aria-expanded="false" aria-controls="filter-form">
                                <span class="glyphicon glyphicon-filter"></span>
                            </a>
                            <a href="{{url('/add-indoc')}}" class="btn btn-sm">Добавить</a>
                            <button class="btn btn-sm green" id="deselect-all">Убрать выделение</button>
                            <button class="btn btn-sm blue" id="select-all">Выделить все</button>
                            <button class="btn btn-sm red" id="multiple-delete">Удалить выделенные</button>
                        </div>

                        <div class="row">
                            <table id="indocs-table" class="table table-bordered table-hover display">
                                <thead>
                                <tr>
                                    <th class="font-bold text-center"></th>
                                    <th>Вх. №<br> (при наличии)</th>
                                    <th>Дата Вх. № </th>
                                    <th>Исх. №</th>
                                    <th>Дата Исх. №</th>
                                    <th>Отправитель</th>
                                    <th>Содержание документа</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($indocs as $indoc)
                                <!-- All indocs -->
                                @php
                                    $exemplar = '';
                                    if(count($indoc->exemplars) > 0){
                                        foreach ($indoc->exemplars as $exemplar_item){
                                            if(!next($indoc->exemplars)){
                                              $exemplar = $exemplar.$exemplar_item['num'].',';
                                            }
                                            else {
                                              $exemplar = $exemplar.$exemplar_item['num'];
                                            }
                                        }
//                                        $exemplar = $indoc->exemplars[0]['num'];
                                    } else {
                                        $exemplar = 'нет экземпляров';
                                    }
                                @endphp
                                <tr>
                                    <td>{{$exemplar}}</td>
                                    <td>{{$indoc->num}}</td>
                                    <td>{{$indoc->date}}</td>
                                    <td>{{$indoc->outnum}}</td>
                                    <td>{{$indoc->outdate}}</td>
                                    <td>{{$indoc->organization['name']}}</td>
                                    <td>{{$indoc->text}}</td>
                                    <td><a href="{{route('editIndoc',$indoc->id)}}" class="btn btn-primary">изменить</a></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom.js')
    <script>
        $(document).ready(function (){
            $('.btn btn-sm green').click(function ()
            {
                console.log('hello')
            })
        })
    </script>
@endsection
@section('MainMenu')
    <div class="main-menu-container">
        <nav class="navbar control-toolbar navbar-mode- flex" role="navigation">
            <div class="toolbar-item">
                <div data-control="toolbar" data-vertical="true">
                    <ul class="mainmenu-items mainmenu-general" data-main-menu>
                        <li><a href="{{url('/organizations')}}">Организации</a></li>
                    </ul>
                </div>
@endsection
