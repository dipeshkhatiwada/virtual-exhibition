<?php

namespace App\Http\Controllers\employer;
use DB;
use File;
use App\Http\Controllers\Controller;
use App\Training;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Imagetool;
use App\library\myFunctions;
use App\library\Settings;
use App\TrainingCategory;

class TrainingController extends Controller
{

/**
* Create a new controller instance.
*
* @return void
*/

/**
* Show the application dashboard.
*
* @return \Illuminate\Http\Response
*/
public function __construct()
{
$this->middleware('employer');
}

public function index(Request $request)
{
$training = Training::where('employers_id', auth()->guard('employer')->user()->employers_id)->orderBy('id', 'desc')->paginate(50);
return view('employer.training.index')->with('datas', $training);
}

public function addnew()
{
  $data['vcode'] = rand(1, 9999);   
  $data['placeholder'] = Imagetool::mycrop('no-image.png', 60,60); 
  $data['category'] = TrainingCategory::orderBy('title', 'asc')->get();

  $data['status'][] = ['value' => 1, 'title' => 'Enable'];
  $data['status'][] = ['value' => 2, 'title' => 'Disable'];
  return  view('employer.training.addnew')->with('datas', $data);
}


public function save(Request $request)
{
//dd($request->all());
$this->validate($request, [
  'title' => 'required|min:3',
  'training_category' => 'required|integer',
  'meta_title' => 'required|min:3',
  'description' => 'required|min:20',
  'seo_url' => 'required|min:3|unique:training',
  'image' => 'required',
]);


$f = array(
    'employers_id' => auth()->guard('employer')->user()->employers_id,
    'training_category_id' => $request->training_category,
    'title' => $request->title,
    'meta_title' => $request->meta_title,
    'meta_keyword' => $request->meta_keyword,
    'meta_description' => $request->meta_description,
    'seo_url' => $request->seo_url,
    'start_time' => $request->start_time,
    'end_time' => $request->end_time,
    'image' => $request->image,
    'venue' => $request->venue,
    'longitude' => $request->longitude,
    'latitude' => $request->latitude,
    'address' => $request->address,
    'description' => $request->description,
    'start_date' => $request->start_date,
    'end_date' => $request->end_date,
    'price'=>$request->price,
    'status' => $request->status
    );
$article= Training::create($f);
if($article)
{
    \Session::flash('alert-success','Record have been saved Successfully');
    return redirect('employer/training');

} else {

    \Session::flash('alert-danger','Something Went Wrong on Deleting usergroup');
    return redirect('employer/training'); 
}
}

public function edit($id)
{

$training=  Training::where('id', $id)->where('employers_id', auth()->guard('employer')->user()->employers_id)->first();
//dd($training);
if($training) {

$mydatas = array();

$placeholder = Imagetool::mycrop('no-image.png',100,100);

  if(is_file(DIR_IMAGE.$training->image)){
  $image = Imagetool::mycrop($training->image, 100, 100);;
  } 
  else {
    $image = $placeholder;
    }
  $mydatas['training'] = $training;
  $mydatas['image'] = $image;
  $mydatas['placeholder'] = $placeholder;
  $mydatas['category'] = TrainingCategory::orderBy('title', 'asc')->get();
  $mydatas['status'][] = ['value' => 1, 'title' => 'Enable'];
  $mydatas['status'][] = ['value' => 2, 'title' => 'Disable'];

//dd($mydatas);
  
return view('employer.training.edittraining')->with('datas', $mydatas);
} else {

\Session::flash('alert-danger','You choosed wrong data');
    return redirect('employer/training'); 
}
}

public function update(Request $request)
    {
      //dd($request->all());
      $this->validate($request, [
      'id' => 'required|integer',
      'training_category' => 'required|integer',
      'title' => 'required|min:3',
      'meta_title' => 'required|min:3',
      'description' => 'required|min:20',
      'seo_url' => 'required|min:3|unique:training,seo_url,'.$request->id.',id',
      'image' => 'required',
      ]);
  

    $f = array(
    'training_category_id' => $request->training_category,
    'title' => $request->title,
    'meta_title' => $request->meta_title,
    'meta_keyword' => $request->meta_keyword,
    'meta_description' => $request->meta_description,
    'seo_url' => $request->seo_url,
    'start_time' => $request->start_time,
    'end_time' => $request->end_time,
    'image' => $request->image,
    'venue' => $request->venue,
    'longitude' => $request->longitude,
    'latitude' => $request->latitude,
    'address' => $request->address,
    'description' => $request->description,
    'start_date' => $request->start_date,
    'end_date' => $request->end_date,
    'price'=>$request->price, 
    'status' => $request->status,
    );
    Training::where('id', $request->id)->update($f);
    \Session::flash('alert-success','Record have been updated Successfully');
    return redirect('employer/training');
    }


public function delete($id)
{
$training = Training::find($id);
if($training){
$article = Training::where('id', $id)->where('employers_id', auth()->guard('employer')->user()->employers_id)->first();
$i=$training->delete();
if($i)
{

\Session::flash('alert-success','Record deleted Successfully');
  return redirect('employer/training');
}
    else 
    {
    \Session::flash('alert-danger','Something Went Wrong on Deleting Data');
        return redirect('employer/training'); 
    }
    } else {
    \Session::flash('alert-danger','Did not find the choosen Data');
        return redirect('employer/training'); 
    }
}

}