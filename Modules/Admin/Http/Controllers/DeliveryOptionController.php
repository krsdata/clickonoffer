<?php

declare(strict_types=1);
 
namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Admin\Entities\DeliveryOption;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect; 
use Modules\Admin\Models\Permission;
use Route;
use Validator;
use View;
use Illuminate\Support\Facades\Input;

/**
 * Class AdminController
 */
class DeliveryOptionController extends Controller
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
         
        View::share('viewPage', 'deliveryoption'); 
        View::share('route_url', route('deliveryoption'));
        View::share('heading', 'Delivery Option');

        $this->record_per_page = Config::get('app.record_per_page');
    }
 

    /*
     * Dashboard
     * */

    public function index(DeliveryOption $deliveryOption, Request $request)
    {
        $page_title  = 'Delivery Option';
        $page_action = 'View Delivery Option';

     
        // Search by name ,email and group
        $search = Input::get('search');

        if ((isset($search) && !empty($search))) {
            $search = isset($search) ? Input::get('search') : '';

            $deliveryOption = DeliveryOption::where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->Where('title', 'LIKE', "%$search%");
                }
            })->orderBy('title', 'asc')->Paginate($this->record_per_page);
        } else {
            $deliveryOption  = DeliveryOption::orderBy('id', 'desc')->Paginate($this->record_per_page);
        }

        return view('admin::delivery_option.index', compact('deliveryOption', 'page_title', 'page_action'));
    }

    /*
     * create  method
     * */

    public function create(DeliveryOption $deliveryOption)
    { 
        $page_title  = 'Delivery Option';
        $page_action = 'Create Delivery Option'; 
        
        return view('admin::delivery_option.create', compact('deliveryOption', 'page_title', 'page_action'));
    }

    /*
     * Save Group method
     * */

    public function store(Request $request, DeliveryOption $deliveryOption)
    {


        $validator = Validator::make($request->all(), [
            'title'       => 'required|unique:delivery_option,title',
        ]);
        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $deliveryOption->title = $request->get('title');
        $deliveryOption->save();

        return Redirect::to('admin/deliveryoption')
            ->with('flash_alert_notice', 'Delivery Option was successfully created !');
    }
    /*
     * Edit Group method
     * @param
     * object : $category
     * */

    public function edit(Request $request, $deliveryOption)
    {    
        $page_title  = 'Delivery Option';
        $page_action = 'Edit Delivery Option';
        
        
        return view('admin::delivery_option.edit', compact('deliveryOption','page_title', 'page_action'));
    }

    public function update(Request $request, $deliveryOption)
    {
        $validator = Validator::make($request->all(), [
            'title'  => 'required|unique:delivery_option,title,'.$deliveryOption->id
        ]);
        
      
        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

         
        $deliveryOption->title = $request->get('title');
        $deliveryOption->save();

        return Redirect::to('admin/deliveryoption')
            ->with('flash_alert_notice', 'Delivery option was successfully updated!');
    }
    /*
     *Delete ads type
     * @param ID
     *
     */
    public function destroy(Request $request,$deliveryOption)
    {
        $deliveryOption->delete();

        return Redirect::to('admin/deliveryoption')
            ->with('flash_alert_notice', 'Delivery option was successfully deleted!');
    }

    public function show(DeliveryOption $deliveryOption)
    {
    }

  
}
