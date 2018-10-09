<?php

declare(strict_types=1);
 
namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Admin\Entities\DeliveryType;  
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
class DeliveryTypeController extends Controller
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
         
        View::share('viewPage', 'deliverytype'); 
        View::share('route_url', route('deliverytype'));
        View::share('heading', 'Delivery Type');

        $this->record_per_page = Config::get('app.record_per_page');
    }
 

    /*
     * Dashboard
     * */

    public function index(DeliveryType $deliveryType, Request $request)
    {
        $page_title  = 'Delivery Type';
        $page_action = 'View Delivery Type';

     
        // Search by name ,email and group
        $search = Input::get('search');

        if ((isset($search) && !empty($search))) {
            $search = isset($search) ? Input::get('search') : '';

            $deliveryType = DeliveryType::where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->Where('title', 'LIKE', "%$search%");
                }
            })->orderBy('title', 'asc')->Paginate($this->record_per_page);
        } else {
            $deliveryType  = DeliveryType::orderBy('id', 'asc')->Paginate($this->record_per_page);
        }

        return view('admin::delivery_type.index', compact('deliveryType', 'page_title', 'page_action'));
    }

    /*
     * create  method
     * */

    public function create(DeliveryType $deliveryType)
    { 
        $page_title  = 'Delivery Type';
        $page_action = 'Create Delivery Type';
        
        return view('admin::delivery_type.create', compact('deliveryType', 'page_title', 'page_action'));
    }

    /*
     * Save Group method
     * */

    public function store(Request $request, DeliveryType $deliveryType)
    {


        $validator = Validator::make($request->all(), [
            'title'  => 'required|unique:delivery_type,title',        
        ]);
        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

       
        $deliveryType->title = $request->get('title');
        $deliveryType->save();

        return Redirect::to('admin/deliverytype')
            ->with('flash_alert_notice', 'Delivery type was successfully created !');
    }
    /*
     * Edit Group method
     * @param
     * object : $category
     * */

    public function edit(Request $request, $deliveryType)
    {    
        $page_title  = 'Delivery Type';
        $page_action = 'Edit Delivery Type';
        
        
        return view('admin::delivery_type.edit', compact('deliveryType','page_title', 'page_action'));
    }

    public function update(Request $request, $deliveryType)
    {
        $validator = Validator::make($request->all(), [
            'title'  => 'required|unique:delivery_type,title,'.$deliveryType->id
        ]);
        
       
        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        
        $deliveryType->title = $request->get('title');
        $deliveryType->save();

        return Redirect::to('admin/deliverytype')
            ->with('flash_alert_notice', 'Delivery type was successfully updated!');
    }
    /*
     *Delete ads type
     * @param ID
     *
     */
    public function destroy(Request $request, $deliveryType)
    {
        $deliveryType->delete();

        return Redirect::to('admin/deliverytype')
            ->with('flash_alert_notice', 'Delivery type was successfully deleted!');
    }

    public function show(AdsType $adsType)
    {
    }

  
}
