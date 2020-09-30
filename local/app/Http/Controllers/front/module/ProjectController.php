<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\Project;
use App\Employers;
use App\ProjectCategory;
use Carbon\Carbon;
use App\ProjectApply;


class ProjectController extends Controller
{
     

public function index($id,$setting)
    {
        $datas['category'] = [];
       
       $categories = ProjectCategory::inRandomOrder()->limit(15)->get();
       $today = date('Y-m-d');
       foreach ($categories as $category) {
        $count = Project::where('project_category_id', $category->id)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->count();
           $datas['category'][] = [
            'title' => $category->title,
            'total' => $count,
            'url' => url('/projects/category/'.$category->seo_url),
           ];
       }
       
       $projects = Project::where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->inRandomOrder()->skip(0)->take($setting->limit)->get();
       $datas['projects'] = [];
       foreach ($projects as $key => $project) {
            $averate = ProjectApply::where('project_id', $project->id)->avg('amount');
            $totalbid = ProjectApply::where('project_id', $project->id)->count();
            $skills = explode(',', $project->skills);
          $datas['projects'][] = [
              'id'              => $project->id,
              'title'           => $project->title,
              'title_dis'       => Settings::getLimitedWords($project->title,0,10),
              'employer'        => Employers::getName($project->employers_id),
              'employer_url'    => url('/projects/business/'.Employers::getUrl($project->employers_id)),
              'logo'            => Employers::getPhoto($project->employers_id),
              'publish_date'    => $project->publish_date,
              'skills'          => $skills,
              'description'     => Settings::getLimitedWords($project->description,0,20),
              'avg'             => $averate,
              'href'            => url('/projects/'.$project->seo_url),
              'total'           => $totalbid
          ];
       }
      $datas['title'] = $setting->title;
      $datas['description'] = $setting->description;

      $logo = Settings::getImages()->project;
      $datas['logo'] = Imagetool::mycrop('no-image.png',60,32);
      if (is_file(DIR_IMAGE.$logo)) {
          $datas['logo'] = Imagetool::mycrop($logo,120,64);
      } 



      if ($setting->design == 1) {
        return view('front.module.projectgrid')->with('datas', $datas);
      } else{
        return view('front.module.projectlist')->with('datas', $datas);
      }
      
       

    }
    
     
     
  
   

}
