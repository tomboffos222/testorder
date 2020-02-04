<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Worker;
use App\Department;
class BaseController extends Controller
{
    //
    public function Home(){
        $data['departments'] =Department::get();
        $data['workers']  = Worker::paginate(12);

    	return view('home',$data);

    }

    public function Workers(){
    	$data['workers'] = Worker::paginate(12);
    	$data['departments'] = Department::get();
    	return view('worker',$data);
    }
    public function CreateWorker(Request $request){
        $rules = [
            'name'=> 'required',
            'last_name'=>'required',

            'wage'=>'required|numeric',
            'gender'=>'required',
            'department'=>'required'
        ];

        $messages = [
            "name.required"=>"Введите имя сотрудника",
            "last_name.required"=>"Введите фамилию сотрудника",

            "wage.required"=>"Введите зарплату сотдруника",

            "wage.numeric"=>"Зарплата должна быть написана в цифрах",
            "gender.required"=>"Выберите пол сотрудника",
            "department.required" => "Выберите хотя бы один отдел в котором работает сотрудник"



        ];
        $validator = $this->validator($request->all(),$rules,$messages);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            $departments = "";
            $departments = implode(',',$request['department']);
            foreach($request['department'] as $key => $department){


                $departmentModel = Department::where('name',$department)->first();
                if ($request['wage'] > $departmentModel['max_wage']){
                    return back()->withErrors('Введите зарплату которая меньше максимальной зарплаты отдела');
                }else {
                    $departmentModel['quantity'] += 1;
                    $departmentModel->save();
                }

            }
            $worker = new Worker;
            $worker['name'] = $request['name'];
            if($request['middle_name'] == null){
                $worker['middle_name'] = "";

            }else {
                $worker['middle_name'] = $request['middle_name'];
            }
            $worker['last_name'] = $request['last_name'];

            $worker['wage'] = $request['wage'];

            $worker['departments'] = $departments;

            $worker->save();



            return back()->with('message','Сотрудник добавлен в список');

        }

    }
    public function Departments(){
        $data['departments'] = Department::paginate(12);
        return view('department',$data);
    }
    public function DeleteDepartment($id){
        $department = Department::find($id);

        if ($department['quantity'] != 0){


            return back()->withErrors('Невозможно удалить там есть количество людей');
        }else{
            $department->delete();
            return back()->with('message','Удалено');
        }
    }
    public function DeleteWorker($id){
        $worker = Worker::find($id);
        $depatments = explode(',' , $worker['departments']);
        foreach($depatments as $department){

            $department = Department::where('name',$department)->first();
            $department['quantity'] -= 1;
        }

        $worker->delete();

        return back()->with('message','Удалено');

    }
    public function CreateDepartment(Request $request){
        $rules = [
            'name'=>'required|max:255',
            'max_wage'=>'required|max:255'

        ];
        $messages =[
            "name.required"=>"Введите имя отдела",
            "max_wage.required"=>"Введите максимальную сумму"
        ];
        $validator = $this->validator($request->all(),$rules, $messages);

        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            $department = new Department;
            $department['quantity'] = 0;
            $department['max_wage'] = $request['max_wage'];
            $department['name']= $request['name'];
            $department->save();



            return back()->with('message','Отдел создан!');
        }
    }
    public function EditDepartment(Request $request){
        $rules = [
            'name'=>'required|max:255',
            'max_wage' => 'required|max:255'
        ];
        $messages = [
            "name.required"=> "Введите имя",
            "max_wage.required"=>"Введиет максимальную зарплату"
        ];
        $validator = $this->validator($request->all(),$rules,$messages);

        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            $department = Department::find($request['depart_id']);
            $department['name'] = $request['name'];
            $department['max_wage'] = $request['max_wage'];
            $department->save();

            return back()->with('message','Изменено');
        }

    }
    public function EditWorker(Request $request){
        $rules = [
            'name'=> 'required',
            'last_name'=>'required',
            'user_id'=>'required',
            'wage'=>'required|numeric',
            'gender'=>'required',
            'department'=>'required'
        ];

        $messages = [
            "name.required"=>"Введите имя сотрудника",
            "last_name.required"=>"Введите фамилию сотрудника",

            "wage.required"=>"Введите зарплату сотдруника",

            "wage.numeric"=>"Зарплата должна быть написана в цифрах",
            "gender.required"=>"Выберите пол сотрудника",
            "department.required" => "Выберите хотя бы один отдел в котором работает сотрудник",
            "user_id.required"=>"Введите id сотрудника"



        ];
        $validator = $this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());

        }else{
            $departments = "";
            $departments = implode(',',$request['department']);

            $workerModel = Worker::find($request['user_id']);

            $workerModel['departments'] = explode(',',$workerModel['departments']);

            foreach($workerModel['departments'] as $workersDepartment){
                $workersDepartment = Department::where('name',$workersDepartment)->first();
                $workersDepartment['quantity'] = $workersDepartment['quantity'] - 1;
                $workersDepartment->save();


            }
            foreach($request['department'] as $key => $department){


                $departmentModel = Department::where('name',$department)->first();

                if ($request['wage'] > $departmentModel['max_wage']){
                    return back()->withErrors('Введите зарплату которая меньше максимальной зарплаты отдела');
                }else {
                    $departmentModel['quantity'] += 1;
                    $departmentModel->save();
                }

            }
            $worker  = Worker::find($request['user_id']);

            $worker['name'] = $request['name'];
            $worker['last_name'] =$request['last_name'];
            $worker['middle_name'] = $request['middle_name'];
            $worker['wage'] = $request['wage'];
            $worker['gender'] = $request['gender'];
            $worker['departments'] = $departments;
            $worker->save();

            return back()->with('message','Изменено');
        }
    }
}
