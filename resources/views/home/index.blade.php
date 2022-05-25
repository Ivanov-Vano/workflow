@extends('layouts.main')
@section('content')
    <div class="page-container">
        <div class="page-content-wrapper animated fadeInRight">
            <div class="page-content">
                <div class="row wrapper border-bottom page-heading">
                     <div class="panel-heading text-center"><h2>Документооборот</h2></div>
                    <div class="wrapper-content">
                            <i class="fas fa-columns"></i> Выбрать отображаемые колонки
                        <div class=" pull-right">
                            <a class="btn btn-sm blue" role="button" data-toggle="collapse" href="#filter-form" aria-expanded="false" aria-controls="filter-form">
                                <span class="glyphicon glyphicon-filter"></span>
                            </a>
                            <button class="btn btn-sm green" id="deselect-all">Убрать выделение</button>
                            <button class="btn btn-sm blue" id="select-all">Выделить все</button>
                            <button class="btn btn-sm red" id="multiple-delete">Удалить выделенные</button>
                        </div>
                        <div class="row">
                            <table id="indocs-table" class="table table-bordered table-hover display">
                                <thead>
                                <tr>
                                    <th class="font-bold text-center"></th>
                                    <th></th>
                                    <th>Вх. №<br> (при наличии)</th>
                                    <th>Дата Вх. № </th>
                                    <th>Исх. №</th>
                                    <th>Дата Исх. №</th>
                                    <th>Отправитель</th>
                                    <th>Содержание документа</th>
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
                                    <td><a href="{{route('showIndoc',$indoc->id)}}" >просмотр</a></td>
                                    <td>{{$exemplar}}</td>
                                    <td>{{$indoc->num}}</td>
                                    <td>{{$indoc->date}}</td>
                                    <td>{{$indoc->outnum}}</td>
                                    <td>{{$indoc->outdate}}</td>
                                    <td>{{$indoc->sender}}</td>
                                    <td>{{$indoc->text}}</td>
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