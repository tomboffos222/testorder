@extends('welcome')


@section('content')

	<div class="container">
		<div class="row">
			<table class="table table-striped">
                <thead>
                <th></th>
                    @foreach($departments as $department)

                        <th>
                            {{$department->name}}
                        </th>
                    @endforeach
                </thead>
                <tbody>
                @foreach($workers as $worker)
                    <tr>
                        <td>{{$worker->name}}</td>
                        @foreach($departments as $department)
                            <td>
                                <?php
                                $array = $worker['departments'];
                                $array = explode(',',$array);


                                if (in_array($department->name, $array))
                                {
                                    echo "&#10003;";
                                }


                                ?>

                            </td>

                        @endforeach
                    </tr>
                    @endforeach
                </tbody>

            </table>
		</div>
	</div>

@endsection
