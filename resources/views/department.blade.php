@extends('welcome')




@section('content')

    <div class="container mow">
        <div class="row">
            <div class="col-lg-10">

            </div>
            <div class="col-lg-2">
                <button href="" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Создать отдел</button>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Создание отдела</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('CreateDepartment')}}" method="get">
                                <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Название отдела"></div>
                                <div class="form-group"><input type="number" name="max_wage" class="form-control" placeholder="Максимальная зарплата"></div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Название отдела</th>
                <th>Максимальная зарплата</th>
                <th>Количество сотрудников</th>
                <th>Действия</th>

            </tr>
            </thead>
            <tbody>
            @foreach($departments as $department)
                <tr>
                    <td>{{$department->name}}</td>

                    <td>{{$department->max_wage}}</td>

                    <td>{{$department->quantity}}</td>

                    <td>
                        <button data-toggle="modal" data-target="#modal_{{$department->id}}" class="btn btn-primary">
                            Редактировать
                        </button>
                        <div class="modal fade" id="modal_{{$department->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Редактирование {{$department->name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('EditDepartment')}}" method="get">
                                            <input type="hidden" name="depart_id" value="{{$department->id}}">
                                            <div class="form-group"><input type="text" class="form-control" name="name" value="{{$department->name}}"></div>
                                            <div class="form-group"><input type="text" class="form-control" name="max_wage" value="{{$department->max_wage}}"></div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-danger">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('DeleteDepartment', $department->id)}}" class="btn btn-danger">
                            Удалить
                        </a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <style>

    </style>
@endsection
