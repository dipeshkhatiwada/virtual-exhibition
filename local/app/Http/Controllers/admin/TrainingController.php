<?php

namespace App\Http\Controllers\admin;
use DB;
use File;
use App\UserGroup;
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
$this->middleware('auth');
}

public function index(Request $request)
{
  $permission = UserGroup::checkPermission('TrainingController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }

        $datas['filter_employer'] = '';
        $datas['filter_title'] = '';
        $datas['filter_category'] = '';
        $datas['filter_status'] = '';
        $url = '';
      $training = Training::where('id', '!=', '');
      if (isset($request->filter_employer)) {
            $datas['filter_employer'] = $request->filter_employer;
            $url .= '&filter_employer='.$request->filter_employer;
            $training->where('employers_id',$request->filter_employer);

        }
        if (isset($request->filter_title)) {
            $datas['filter_title'] = $request->filter_title;
            $url .= '&filter_title='.$request->filter_title;
            $training->where('title', 'LIKE', $request->filter_title.'%');

        }
        if (isset($request->filter_category)) {
            $datas['filter_category'] = $request->filter_category;
            $url .= '&filter_category='.$request->filter_category;
            $training->where('training_category_id',$request->filter_category);

        }
        if (isset($request->filter_status)) {
            $datas['filter_status'] = $request->filter_status;
            $url .= '&filter_status='.$request->filter_status;
            $training->where('status',$request->filter_status);

        }
        
        $datas['training'] = $training->orderBy('id', 'desc')->paginate(50)->setPath('admin/training?'.$url);


        $datas['categories'] = TrainingCategory::orderBy('title','asc')->get();
        $datas['status'][] = ['value' => '0', 'title' => 'Enabled'];
        $datas['status'][] = ['value' => '1', 'title' => 'Disabled'];

return view('admin.training.index')->with('datas', $datas);
}

public function addnew()
{
   $permission = UserGroup::checkPermission('TrainingController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }
  $data['vcode'] = rand(1, 9999);   
  $data['placeholder'] = Imagetool::mycrop('no-image.png', 60,60); 
  $data['category'] = TrainingCategory::orderBy('title', 'asc')->get();

  $data['status'][] = ['value' => 1, 'title' => 'Enable'];
  $data['status'][] = ['value' => 2, 'title' => 'Disable'];
  return  view('admin.training.newform')->with('datas', $data);
}


public function save(Request $request)
{
   $permission = UserGroup::checkPermission('TrainingController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }
//dd($request->all());
$this->validate($request, [
  'employer' => 'required|integer',
  'title' => 'required|min:3',
  'training_category' => 'required|integer',
  'meta_title' => 'required|min:3',
  'description' => 'required|min:20',
  'seo_url' => 'required|min:3|unique:training',
  'image' => 'required',
]);
  

$f = array(
    'employers_id' => $request->employer,
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
    return redirect('admin/training');

} else {

    \Session::flash('alert-danger','Something Went Wrong on Deleting usergroup');
    return redirect('admin/training'); 
}
}

public function edit($id)
{
   $permission = UserGroup::checkPermission('TrainingController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }

$training=  Training::where('id', $id)->first();
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
  
return view('admin.training.editform')->with('datas', $mydatas);
} else {

\Session::flash('alert-danger','You choosed wrong data');
    return redirect('admin/training'); 
}
}

public function update(Request $request)
    {
       $permission = UserGroup::checkPermission('TrainingController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }
      //dd($request->all());
      $this->validate($request, [
        'employer' => 'required|integer',
      'id' => 'required|integer',
      'training_category' => 'required|integer',
      'title' => 'required|min:3',
      'meta_title' => 'required|min:3',
      'description' => 'required|min:20',
      'seo_url' => 'required|min:3|unique:training,seo_url,'.$request->id.',id',
      'image' => 'required',
      ]);
  

    $f = array(
      'employers_id' => $request->employer,
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
    return redirect('admin/training');
    }


public function delete($id)
{
   $permission = UserGroup::checkPermission('TrainingController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }
$training = Training::find($id);
if($training){
$article = Training::where('id', $id)->first();
$i=$training->delete();
if($i)
{

\Session::flash('alert-success','Record deleted Successfully');
  return redirect('admin/training');
}
    else 
    {
    \Session::flash('alert-danger','Something Went Wrong on Deleting Data');
        return redirect('admin/training'); 
    }
    } else {
    \Session::flash('alert-danger','Did not find the choosen Data');
        return redirect('admin/training'); 
    }
}

}