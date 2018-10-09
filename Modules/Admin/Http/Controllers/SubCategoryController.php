<?php

declare(strict_types=1);
 
namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Admin\Entities\SubCategory;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect; 
use Route;
use Validator;
use View;
use Illuminate\Support\Facades\Input;

/**
 * Class AdminController
 */
class SubCategoryController extends Controller
{
    /**
     * @var  Repository
     */

    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    { 
         
        View::share('viewPage', 'subcategories'); 
        View::share('route_url', route('subcategories'));
        View::share('heading', 'Sub Categories');

        $this->record_per_page = Config::get('app.record_per_page');
    }
 

    /*
     * Dashboard
     * */

    public function index(SubCategory $category, Request $request)
    {
        $page_title  = 'Sub Categories';
        $page_action = 'View SubCategory';

             // Search by name ,email and group
        $search = Input::get('search');

        if ((isset($search) && !empty($search))) {
            $search = isset($search) ? Input::get('search') : '';

            $category = SubCategory::where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->Where('name', 'LIKE', "%$search%");
                }
            })->where('parent_cat_id','!=','0')->orderBy('name', 'asc')->Paginate($this->record_per_page);
        } else {
            $category  = SubCategory::where('parent_cat_id','!=','0')->orderBy('id', 'desc')->get();
        }

        return view('admin::sub_category.index', compact('category', 'page_title', 'page_action'));
    }

    /*
     * create  method
     * */

    public function create(SubCategory $category)
    { 
        $page_title  = 'Sub Category';
        $page_action = 'Create SubCategory';   
		$parentCat  = SubCategory::where('parent_cat_id','=','0')->where('status','=','1')->orderBy('name', 'asc')->get();
        return view('admin::sub_category.create',  compact('parentCat','category','page_title', 'page_action'));
    }

    /*
     * Save Group method
     * */

    public function store(Request $request, SubCategory $category)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:ads_categories,name',
            'image' => 'required|mimes:jpeg,jpg,png',
			'description' => 'required',
			'parent_cat_id' => 'required'
        ]);
        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
		$category->image  =  '';
		if ($request->hasFile('image')) {
			$category->image = $request->file('image')->store('uploads/category','cat_image');	
		}	
		$category->parent_cat_id =   $request->get('parent_cat_id');
        $category->name         =   $request->get('name');
        $category->slug         =   $request->get('name');
        $category->description  =   $request->get('description');
        $category->save();

        return Redirect::to('admin/subcategories')
            ->with('flash_alert_notice', 'Sub Category was successfully created !');
    }
    /*
     * Edit Group method
     * @param
     * object : $category
     * */

    public function edit(Request $request, SubCategory $category)
    {    
        $page_title  = 'Category';
        $page_action = 'Edit Category';  
		$parentCat  = SubCategory::where('parent_cat_id','=','0')->where('status','=','1')->orderBy('name', 'asc')->get();
        		
        return view('admin::sub_category.edit', compact('parentCat','category','page_title', 'page_action'));
    }

    public function update(Request $request,Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:ads_categories,name,'.$category->id,
			'description' => 'required',
			'parent_cat_id' => 'required'
        ]);
		if(empty($category->image)){			
			$validator = Validator::make($request->all(), [
				'image' => 'required|mimes:jpeg,jpg,png'
			]);
		}
		
        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
		if ($request->hasFile('image')) {
			$category->image = $request->file('image')->store('uploads/category','cat_image');	
		}	
		$category->parent_cat_id =   $request->get('parent_cat_id');
        $category->name         =   $request->get('name');
        $category->slug         =   $request->get('name');
        $category->description  =   $request->get('description');
        $category->save();

        return Redirect::to('admin/subcategories')
            ->with('flash_alert_notice', 'Sub Category was successfully updated!');
    }
    /*
     *Delete User
     * @param ID
     *
     */
    public function destroy(Request $request,SubCategory $category)
    {
        $category->delete();

        return Redirect::to('admin/subcategories')
            ->with('flash_alert_notice', 'Sub Category was successfully deleted!');
    }

    public function show(SubCategory $category)
    {
    }

 
	
	}
