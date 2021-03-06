@extends('layouts.main')
@section('content')
    <div class="page-container">
        <div class="page-content-wrapper animated fadeInRight">
            <div class="page-content">
                <div class="row wrapper border-bottom page-heading">
                    <div class="panel-heading text-center"><h2>Список организаций</h2></div>
                    <div class="wrapper-content">
                        <div class=" pull-right">
                            <a href="{{url('/organizations/create')}}" class="btn btn-sm">Добавить</a>
                        </div>
                        <div class="row">
                            <table id="organizations-table" class="table table-bordered table-hover display">
                                <thead>
                                <tr>
                                    <th>Наименование</th>
                                    <th>Управление</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($organizations as $organization)
                                    <tr>
                                        <td>{{$organization->name}}</td>
                                        <td style="display: flex">
                                            <div>
                                            <a href="{{route('editOrganization',$organization->id)}}" class="btn btn-primary">изменить</a>
                                            </div>
                                            <div>
                                                <form action="{{url('/organizations/'.$organization->id)}}" method="post">
                                                    {{ method_field('DELETE') }}
                                                    {{csrf_field()}}
                                                    <button class="btn btn-danger" type="submit">удалить</button>
                                                </form>
                                            </div>
                                        </td>
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
