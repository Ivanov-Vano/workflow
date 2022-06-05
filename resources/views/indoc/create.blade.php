@extends('layouts.main')

@section('content')
    <div class="page-container">
        <div class="page-content-wrapper animated fadeInRight">
            <div class="page-content">
                <div class="row wrapper border-bottom page-heading">
                    <div class="col-lg-12">
                        <h2>Новый документ</h2>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Главная</a></li>
                            <li class="active">
                                <strong>Добавление</strong>
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
                                    <form>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputNum">Номер</label>
                                                <input type="text" class="form-control" id="inputNum">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputDate">Дата</label>
                                                <input type="date" class="form-control" id="inputDate">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputOutnum">Номер исходящего</label>
                                                <input type="text" class="form-control" id="inputOutnum">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputOutdate">Дата исходящего</label>
                                                <input type="date" class="form-control" id="inputOutdate">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputText">Содержание</label>
                                            <input type="text" class="form-control" id="inputText" placeholder="О чем документ">
                                        </div>
                                            <div class="form-group">
                                                <label for="inputState">Отправитель</label>
                                                <select id="inputState" class="form-control">
                                                    <option selected>Выберите организацию...</option>
                                                    @foreach ($organizations as $organization)
                                                        <option value="{{$organization->id}}">{{$organization->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
                                    </form>                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

