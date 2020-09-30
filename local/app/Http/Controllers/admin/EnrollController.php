<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enroll;
use App\Category;
use App\Booth;
use App\EnrollInvoice;
use App\Setting;


class EnrollController extends Controller
{

    public function index()
    {

        $enroll_types = Enroll::get();
        $enroll_categories = Category::get();
        return view('admin.enroll.detail', compact('enroll_types', 'enroll_categories'));
    }
    public function create()
    {
        $enroll_types = Enroll::get();
        $enroll_category = Category::get();
        $booths = Booth::get();
        return view('admin.enroll.new_create', compact('booths', 'enroll_types', 'enroll_category'));

    }

    // public function saveType(Request $request)
    // {

    //     $this->validate($request, [
    //         'vtype' => 'required|min:5',
    //         'category_title' => 'required',
    //         'seo_url' => 'required',
    //         'seat_limit' => 'required'
    //     ]);

    //     $enroll_type = new Enroll();
    //     $enroll_type->title = $request->vtype;
    //     $enroll_type->save();
    //     $enroll_id = $enroll_type->id;

    //     Category::create([
    //         'enroll_id' => $enroll_id,
    //         'title' => $request->category_title,
    //         'seo_url' => $request->seo_url,
    //         'seat_limit' => $request->seat_limit
    //     ]);
    //     return redirect('admin/enroll')->with('message', 'Exhibition Type and Category has beed added Successfully!');


    // }

    public function saveCategory(Request $request)
    {

        $this->validate($request, [
            'enroll_type' => 'required',
            'category_title' => 'required',
            'seo_url' => 'required',
            'seat_limit' => 'required'
        ]);

        $datas = $request->all();
        $enroll_category = new Category();
        $enroll_category->enroll_id = $datas['enroll_type'];
        $enroll_category->title = $datas['category_title'];
        $enroll_category->seo_url = $datas['seo_url'];
        $enroll_category->seat_limit = $datas['seat_limit'];
        $enroll_category->save();

        return redirect('admin/enroll')->with('message', 'Category has been added Successfully!');

    }

    public function addCategory($id=null, Request $request)
    {
        $category = Category::find($id);
        if($request->isMethod('post'))
        {
            $this->validate($request, [
                'category_title' => 'required',
                'seo_url' => 'required',
                'seat_limit' => 'required'
            ]);
            $category = new Category();
            $category->enroll_id = $request->idType;
            $category->title = $request->category_title;
            $category->seo_url = $request->seo_url;
            $category->seat_limit = $request->seat_limit;
            $category->save();

            return redirect('admin/enroll')->with('message', 'Exhibition Category Added Successfully!');
        }

        return view('admin.enroll.add_category', compact('category'));

    }
    public function editCategory($id=null)
    {
        $category = Category::find($id);
        return view('admin.enroll.editEnrollForm', compact('category'));
    }

    public function updateCategory(Request $request, $id=null)
    {

        $datas = $request->all();

        Enroll::where(['id' => $datas['idType']])->update([
            'title' => $datas['type']
        ]);

        Category::where(['id' => $datas['idCategory']])->update([
            'title' => $datas['category'],
            'seo_url' => $datas['seo_url'],
            'seat_limit' => $datas['seat_limit']
        ]);

        return redirect('admin/enroll')->with('message', 'Exhibition Category and Type has been updated Successfully!');
    }

    public function destroyCategory($id=null)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('message', 'Category has been deleted Successfully!');

    }

    public function destroyType($id=null)
    {
        $enroll_type = Enroll::find($id);
        $enroll_categories = $enroll_type->categories()->where('enroll_id', $id)->get();
        foreach ($enroll_categories as $category)
        {
            Category::find($category->id)->delete();

        }
        $enroll_type->delete();
        return redirect()->back()->with('message', 'Enroll Type has been deleted Successfully!');
    }

    public function invoice(){


        $invoice = \App\EnrollInvoice::get();
        $data['invoice'] = $invoice;
        return view('admin.enroll.invoice.detail',compact('data'));
    }

    public function showInvoice(EnrollInvoice $invoice)
    {
        $data['invoice'] = $invoice->load('enrollinvoiceItem', 'enrollinvoiceHistory');

        $setting = Setting::first();
        $data['logo'] = $setting->settingImage['logo'];
        $data['store'] = $setting->name;
        $data['store_address'] = $setting->address;
        $data['store_phone'] = $setting->telephone;
        $data['store_email'] = $setting->email;
        return view('admin.enroll.invoice.view')->with('data', $data);
    }
}
