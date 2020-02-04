@extends('welcome')




@section('content')

	<div class="container mow">
		<div class="row">
			<div class="col-lg-10">

			</div>
			<div class="col-lg-2">
				<button href="" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Добавить сотрудника</button>
			</div>
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Создание работника</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <form action="{{route('CreateWorker')}}" method="get">
			        	<div class="form-group"><input type="text" name="name" placeholder="Имя" class="form-control"></div>
			        	<div class="form-group"><input type="text" name="last_name" placeholder="Фамилия" class="form-control"></div>
			        	<div class="form-group"><input type="text" name="middle_name" placeholder="Отчество" class="form-control"></div>
			        	<div class="form-group"><input type="number" name="wage" placeholder="Зарплата" class="form-control"></div>
			        	<div class="form-group">
                            <label for="gender">Пол: </label>
                            <select name="gender" id="gender">
                                <option value="male">Мужчина</option>
                                <option value="female">Женщина</option>
                            </select>
                        </div>
			        	@foreach($departments as $department)
			        	<div class="form-check">

								<input type="checkbox" name="department[]" value="{{$department->name}}">
								<label for="" >{{$department->name}}</label>


			        	</div>
			        	@endforeach
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
					<th>Имя</th>
					<th>Отчество</th>
					<th>Фамилия</th>
					<th>Зарплата</th>
					<th>Пол</th>
					<th>Отдел</th>
				</tr>
			</thead>
			<tbody>
				@foreach($workers as $worker)
				<tr>
					<td>{{$worker->name}}</td>
					<td>{{$worker->last_name}}</td>
					<td>{{$worker->middle_name}}</td>
					<td>{{$worker->wage}} $</td>
					<td>
						@if($worker->gender == 'male')
						Мужчина
						@elseif($worker->gender == 'femali')
						Женщина
						@endif
					</td>
					<td>
						{{$worker->departments}}
					</td>
                    <td>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#worker_{{$worker->id}}">
                            Изменить
                        </button>
                        <div class="modal fade" id="worker_{{$worker->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Создание работника</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('EditWorker')}}" method="get">
                                            <input type="hidden" name="user_id" value="{{$worker->id}}">
                                            <div class="form-group"><input type="text" name="name" placeholder="Имя" class="form-control" value="{{$worker->name}}"></div>
                                            <div class="form-group"><input type="text" name="last_name" placeholder="Фамилия" class="form-control" value="{{$worker->last_name}}"></div>
                                            <div class="form-group"><input type="text" name="middle_name" placeholder="Отчество" class="form-control" value="{{$worker->middle_name}}"></div>
                                            <div class="form-group"><input type="number" name="wage" placeholder="Зарплата" class="form-control" value="{{$worker->wage}}"></div>
                                            <div class="form-group">
                                                <label for="gender">Пол: </label>
                                                <select name="gender" id="gender">
                                                    <option value="male" @if($worker->gender == 'male') selected @endif>Мужчина</option>
                                                    <option value="female" @if($worker->gender == 'female') selected @endif>Женщина</option>
                                                </select>
                                            </div>
                                            @foreach($departments as $department)
                                                <div class="form-check">

                                                    <input
                                                        type="checkbox" name="department[]" value="{{$department->name}}"
                                                        <?php
                                                            $array = $worker['departments'];
                                                            $array = explode(',',$array);


                                                            if (in_array($department->name, $array))
                                                                {
                                                                    echo "checked";
                                                                }


                                                        ?>

                                                    >
                                                    <label for="" >{{$department->name}}</label>


                                                </div>
                                            @endforeach
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
                        <a href="{{route('DeleteWorker',$worker->id)}}" class="btn btn-danger">Удалить</a>

                    </td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<style>

	</style>
@endsection
