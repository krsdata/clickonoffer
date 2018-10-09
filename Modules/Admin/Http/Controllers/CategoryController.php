<?php

declare(strict_types=1);
 
namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Admin\Entities\Category;  
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
class CategoryController extends Controller
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
         
        View::share('viewPage', 'categories'); 
        View::share('route_url', route('categories'));
        View::share('heading', 'Categories');

        $this->record_per_page = Config::get('app.record_per_page');
    }
 

    /*
     * Dashboard
     * */

    public function index(Category $category, Request $request)
    {
        $page_title  = 'Categories';
        $page_action = 'View Category';

             // Search by name ,email and group
        $search = Input::get('search');

        if ((isset($search) && !empty($search))) {
            $search = isset($search) ? Input::get('search') : '';

            $category = Category::where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->Where('name', 'LIKE', "%$search%");
                }
            })->orderBy('name', 'asc')->Paginate($this->record_per_page);
        } else {
            $category  = Category::orderBy('id', 'asc')->get();
        }

        return view('admin::category.index', compact('category', 'page_title', 'page_action'));
    }

    /*
     * create  method
     * */

    public function create(Category $category)
    { 
        $page_title  = 'Category';
        $page_action = 'Create Category';         
        return view('admin::category.create', compact('category','page_title', 'page_action'));
    }

    /*
     * Save Group method
     * */

    public function store(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:ads_categories,name',
            'image' => 'required|mimes:jpeg,jpg,png',
			'description' => 'required',
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
        $category->name         =   $request->get('name');
        $category->slug         =   $request->get('name');
        $category->description  =   $request->get('description');
        $category->save();

        return Redirect::to('admin/categories')
            ->with('flash_alert_notice', 'Category was successfully created !');
    }
    /*
     * Edit Group method
     * @param
     * object : $category
     * */

    public function edit(Request $request, Category $category)
    {    
        $page_title  = 'Category';
        $page_action = 'Edit Category';  
				
        return view('admin::category.edit', compact('category','page_title', 'page_action'));
    }

    public function update(Request $request,Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:ads_categories,name,'.$category->id,
			'description' => 'required',
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

        $category->name         =   $request->get('name');
        $category->slug         =   $request->get('name');
        $category->description  =   $request->get('description');
        $category->save();

        return Redirect::to('admin/categories')
            ->with('flash_alert_notice', 'Category was successfully updated!');
    }
    /*
     *Delete User
     * @param ID
     *
     */
    public function destroy(Request $request,Category $category)
    {
        $category->delete();

        return Redirect::to('admin/categories')
            ->with('flash_alert_notice', 'Category was successfully deleted!');
    }

    public function show(Category $category)
    {
    }

 
	
	}
