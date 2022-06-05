@extends('layouts.main')
@section('content')
    <div class="page-container">
        <div class="page-content-wrapper animated fadeInRight">
            <div class="page-content">
                <div class="row wrapper border-bottom page-heading">
                    <div class="col-lg-12">
                        <h2>Просмотр документа</h2>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Главная</a></li>
                            <li class="active">
                                <strong>Редактирование</strong>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="wrapper-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ibox float-e-margins">
                                <div class="widgets-container">
                                    <h5>Входящий документ</h5>
                                    <hr>
                                    <form method="post" action="{{ url('/edit-indoc/'.$indoc->id) }}">
                                        {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="name">Номер документа</label>
                                        <input class="form-control m-t-xxs" id="num" name="num"
                                               placeholder="Номер" value="{{old('num') ?? $indoc->num}}" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Дата документа</label>
                                        <input class="form-control m-t-xxs" id="date" name="date"
                                               placeholder="Дата" value="{{old('date') ?? $indoc->date}}" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Номер исходящего документа</label>
                                        <input class="form-control m-t-xxs" id="outnum" name="outnum"
                                               placeholder="Номер" value="{{old('outnum') ?? $indoc->outnum}}" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Дата исходящего документа</label>
                                        <input class="form-control m-t-xxs" id="outdate" name="outdate"
                                               placeholder="Дата" value="{{old('outdate') ?? $indoc->outdate}}" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Отправитель</label>
                                        <select class="form-control m-t-xxs" id="org_id" name="org_id" placeholder="Наименование">
                                            @foreach ($organizations as $organization)
                                                <option value="{{$organization->id}}">{{$organization->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Содержание</label>
                                        <input class="form-control m-t-xxs" id="text" name="text"
                                               placeholder="Наименование" value="{{old('text') ?? $indoc->text}}" type="text">
                                    </div>
                                        <button type="submit" class="btn btn-primary margin-top-30">Сохранить</button>
                                    </form>
                                    <div class="form-group">
                                         @if(count($indoc->exemplars) > 0)
                                            <span>
                                                @foreach($indoc->exemplars as $exemplar_item)

                                                    @if($loop->last)
                                                        {{$exemplar_item['num']}}
                                                    @else
                                                        {{$exemplar_item['num']}},
                                                    @endif
                                                @endforeach
                                            </span>
                                        @else
                                            <span>нет экземпляров</span>
                                        @endif
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('MainMenu')
    <div class="main-menu-container">
        <nav class="navbar control-toolbar navbar-mode- flex" role="navigation">
            <div class="toolbar-item">
                <div data-control="toolbar" data-vertical="true">
                    <ul class="mainmenu-items mainmenu-general" data-main-menu>
                        <li>Организации</li>
                    </ul>
                </div>
@endsection

