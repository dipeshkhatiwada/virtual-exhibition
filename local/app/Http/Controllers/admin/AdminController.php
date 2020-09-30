<?php
namespace App\Http\Controllers\admin;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employers;
use App\Employees;
use App\Jobs;
use File;
class AdminController extends Controller
{
   
   
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard(Request $request)
    {
        
       $datas = [];
       $datas['users'] = User::orderBy('name', 'asc')->get();
       $datas['total_employes'] = Employees::select('id')->where('status', 1)->where('trash', 0)->count();
       $datas['employers'] = Employers::select('id', 'name', 'email', 'logo', 'seo_url')->where('status', 1)->where('trash', 0)->get();
       $datas['jobs'] = Jobs::where('status', 1)->where('trash', 0)->orderBy('id', 'desc')->get();
        return view('admin.dashboard')->with('datas', $datas);
    }
    
}