<?php

namespace App\Http\Controllers\admin;
use DB;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Imagetool;
use App\library\myFunctions;
use App\Layout;
use App\UserGroup;



class MenuController extends Controller
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
        $permission = UserGroup::checkPermission('MenuController');
        if($permission == 1){
          
          return view('admin.noPermission');
          exit;
        }
        $menus = [];

        $menu = Menu::where('parent_id', 0)->get();
        foreach ($menu as $flevel) {
            $slevel = [];
            $smenu = Menu::where('parent_id', $flevel->id)->get();
            foreach ($smenu as $sl) {
                $tlevel = [];
                $tmenu = Menu::where('parent_id', $sl->id)->get();
                foreach ($tmenu as $tl) {
                    $tlevel[]= [
                        'id' => $tl->id,
                        'title' => $flevel->title.' >> '.$sl->title.' >> '.$tl->title,
                        'sort_order'  => $tl->sort_order,
                        'edit'        => url('admin/menu/edit/'. $tl->id),
                        'delete'      => url('admin/menu/delete/'. $tl->id),
                    ];
                }
                $slevel[] = [
                        'id' => $sl->id,
                        'title' => $flevel->title.' >> '.$sl->title,
                        'sort_order'  => $sl->sort_order,
                        'children' => $tlevel,
                        'edit'        => url('admin/menu/edit/'. $sl->id),
                        'delete'      => url('admin/menu/delete/'. $sl->id),
                ];
            }
            $menus[] = [
                        'id' => $flevel->id,
                        'title' => $flevel->title,
                        'sort_order'  => $flevel->sort_order,
                        'children' => $slevel,
                        'edit'        => url('admin/menu/edit/'. $flevel->id),
                        'delete'      => url('admin/menu/delete/'. $flevel->id),
                ];

        }


        return view('admin.menu.index')->with('datas', $menus);

    }

     public function addnew()
    {
       $permission = UserGroup::checkPermission('MenuController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }
       
       $datas = [];
        $datas['layout'] = Layout::orderBy('layout_title', 'asc')->get();
         $image='catalog/back.png';
        $datas['image']=Imagetool::mycrop($image, 100, 100);    
        return view('admin.menu.newform')->with('datas',$datas);
    }
    public function save(Request $request)
    {
       $permission = UserGroup::checkPermission('MenuController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }
        
       $this->validate($request, [
            'title' => 'required|min:3',
            'meta_title' => 'required|min:3',
            'se_url' => 'required|min:3|unique:menu',
       ]);
            
                $medata = array(
                    
                    'parent_id' => $request->parent_id,           
                    'sort_order' => $request->sort_order,
                    'status' => $request->status,
                    'layout_id' => $request->layout_id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'meta_title' => $request->meta_title,
                    'meta_keyword' => $request->meta_keyword,
                    'meta_description' => $request->meta_description,
                    'image' => $request->image,
                    'se_url' => $request->se_url,
                    );
                $menu=Menu::create($medata);
                if($menu)
                {
                   

                    $seo = array(
                        'type_id' => $menu->id, 
                        'type' => 'menu',
                        's_url' => $request->se_url,
                        );
                    DB::table('seo_url')->insert($seo);
                    \Session::flash('alert-success','Record have been saved Successfully');
                    return redirect('admin/menu');

                } else {

                    \Session::flash('alert-danger','Something Went Wrong on Saving Data');
                    return redirect('admin/menu'); 
                
                }
               
                

            
        
    }

    public function delete($id)
    {
        $permission = UserGroup::checkPermission('MenuController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }
        $menu = Menu::find($id);
        if($menu){
        $i=$menu->delete();
       
        if($i)
        {
            //DB::table('menu_path')->where('path_id', $id)->delete();
            DB::table('seo_url')->where('type_id', $id)->where('type', 'menu')->delete();
            
            \Session::flash('alert-success','Record deleted Successfully');
                    return redirect('admin/menu');
        }
        else 
        {
           \Session::flash('alert-danger','Something Went Wrong on Deleting Data');
                    return redirect('admin/menu'); 
        }
    } else
    {
      \Session::flash('alert-danger','Sorry you choosed wrong Data');
                    return redirect('admin/menu');   
    }

        
    }

     public function edit($id)
    {
        $permission = UserGroup::checkPermission('MenuController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }
       $value=Menu::where('id', $id)->first();
       if($value) {
        
        $datas = [];

        if(!empty($value->image)){
                $image = $value->image;
            } else {
                $image = 'catalog/back.png';
            }

            
            $timage='catalog/back.png';
            $image_file=Imagetool::mycrop($timage, 120, 100); 
            $datas['data'] = array(
            'id' => $value->id,
            'parent_id' => $value->parent_id,
            'parent_title' => Menu::getMenuTitle($value->parent_id),
            'title' => $value->title,
            'description' => $value->description,
            'meta_title' => $value->meta_title,
            'meta_keyword' => $value->meta_keyword,
            'meta_description' => $value->meta_description,
            'sort_order' => $value->sort_order,
            'status' => $value->status,
            'layout_id' => $value->layout_id,
            'se_url' => $value->se_url,
            'image_thumb' => Imagetool::mycrop($image, 120, 100),
            'image_file' => $image_file,
            'image' => $value->image,
            
            );



      
        $datas['layout'] = Layout::orderBy('layout_title', 'asc')->get();
        
        
        return view('admin.menu.editform')->with('datas', $datas);
        } else {

             \Session::flash('alert-danger','You choosed wrong data');
                    return redirect('admin/menu'); 
        }
    }

    public function update(Request $request)
    {
       $permission = UserGroup::checkPermission('MenuController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }
        

        $this->validate($request, [
            'title' => 'required|min:3',
            'meta_title' => 'required|min:3',
            'se_url' => 'required|min:3|unique:menu,se_url,'.$request->id.',id',
       ]);
            
                $medata = array(
                    
                    'parent_id' => $request->parent_id,           
                    'sort_order' => $request->sort_order,
                    'status' => $request->status,
                    'layout_id' => $request->layout_id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'meta_title' => $request->meta_title,
                    'meta_keyword' => $request->meta_keyword,
                    'meta_description' => $request->meta_description,
                    'image' => $request->image,
                    'se_url' => $request->se_url,
                    );
                $menu=Menu::where('id', $request->id)->update($medata);
                if($menu)
                {
                   

                  
                    DB::table('seo_url')->where('type_id', $request->id)->where('type', 'menu')->update(['s_url' => $request->se_url]);
                    \Session::flash('alert-success','Record have been saved Successfully');
                    return redirect('admin/menu');

                } else {

                    \Session::flash('alert-danger','Something Went Wrong on Saving Data');
                    return redirect('admin/menu'); 
                
                }
           
    }


     
   public function autocomplete(Request $request)
            {
                if (isset($request->term)) {
                    
                    
               
                $data = Menu::where('title', 'LIKE', $request->term.'%')->skip(0)->take(10)->get();;
                
                    $result = array();
                    $result[]=['id'=> '0', 'value'=> 'Root'];
                    foreach ($data as $key => $v) {
                        $result[]=['id'=> $v->id, 'value'=> $v->title];
                    }
                   return response()->json($result);
               }
            }
    public function autocompleteArticle(Request $request)
            {
                if (isset($request->term)) {
                    
                    
               
                $data = Menu::where('title', 'LIKE', $request->term.'%')->skip(0)->take(10)->get();;
                
                    $result = array();
                    
                    foreach ($data as $key => $v) {
                        $result[]=['id'=> $v->id, 'value'=> $v->title];
                    }
                   return response()->json($result);
               }
            }
    public function checkUrl(Request $request)
            {
                if (isset($request->seo_url)) {
                   
                   $check=DB::table('seo_url')->where('s_url', $request->seo_url)->count();
                   if($check >0){
                    $out = 'error';
                   } else {
                    $out='success';
                   }
                   echo $out;
               }
            }

    public function RcheckUrl(Request $request)
            {
                if (isset($request->seo_url)) {
                    
                   $check=DB::table('seo_url')->where('s_url', $request->seo_url)->where('type_id', '!=', $request->id)->count();
                   if($check >0){
                    $out = 'error';
                   } else {
                    $out='success';
                   }
                   echo $out;
               }
            }

}
