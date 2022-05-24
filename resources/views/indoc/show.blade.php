@extends('layouts.main')

@section('content')
    <div class="page-container">
        <div class="page-content-wrapper animated fadeInRight">
            <div class="page-content">
                <div class="row wrapper border-bottom page-heading">
                    <div class="col-lg-12">
                        <h2>Просмотр/редактирование документа</h2>
                    </div>
                </div>
                <div class="wrapper-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ibox float-e-margins">
                                <div class="widgets-container">
                                    <h5>Входящий документ</h5>
                                    <hr>
                                        <div class="form-group">
                                            <label for="name">Наименование</label>
                                            <input class="form-control m-t-xxs" id="name" name="name"
                                                   placeholder="Введите наименование" value="1" type="text">
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

