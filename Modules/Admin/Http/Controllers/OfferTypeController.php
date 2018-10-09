<?php

declare(strict_types=1);
 
namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Admin\Entities\OfferType;  
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
class OfferTypeController extends Controller
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
         
        View::share('viewPage', 'offer_type'); 
        View::share('route_url', route('offer_type'));
        View::share('heading', 'Offer Type');

        $this->record_per_page = Config::get('app.record_per_page');
    }
 

    /*
     * Dashboard
     * */

    public function index(OfferType $offer_type, Request $request)
    {
        $page_title  = 'Offer Type';
        $page_action = 'View Offer Type';


        // Search by name ,email and group
        $search = Input::get('search');

        if ((isset($search) && !empty($search))) {
            $search = isset($search) ? Input::get('search') : '';

            $list = OfferType::where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->Where('name', 'LIKE', "%$search%");
                }
            })->orderBy('name', 'asc')->Paginate($this->record_per_page);
        } else {
            $list  = OfferType::orderBy('id', 'asc')->get();
        }

        return view('admin::offer_type.index', compact('list', 'page_title', 'page_action'));
    }

    /*
     * create  method
     * */

    public function create(OfferType $offer_type)
    { 
        $page_title  = 'Offer Type';
        $page_action = 'Create Offer Type';

         
        return view('admin::offer_type.create', compact('offer_type','page_title', 'page_action'));
    }

    /*
     * Save Group method
     * */

    public function store(Request $request, OfferType $offer_type)
    {


        $validator = Validator::make($request->all(), [
            'offer_name'  => 'required'
        ]);
        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $offer_type->offer_name         =   $request->get('offer_name');
        $offer_type->save();

        return Redirect::to('admin/offer_type')
            ->with('flash_alert_notice', 'offer type was successfully created !');
    }
    /*
     * Edit Group method
     * @param
     * object : $category
     * */

    public function edit(Request $request, $offer_type)
    {    
        $page_title  = 'Offer Type';
        $page_action = 'Edit offer type';
  
        return view('admin::offer_type.edit', compact('offer_type','page_title', 'page_action'));
    }

    public function update(Request $request, $offer_type)
    {
        $validator = Validator::make($request->all(), [
            'offer_name'       => 'required'
        ]);
        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

       
        $offer_type->offer_name         =   $request->get('offer_name');
        $offer_type->save();

        $offer_type->save();

        return Redirect::to('admin/offer_type')
            ->with('flash_alert_notice', 'offer type was successfully updated!');
    }
    /*
     *Delete User
     * @param ID
     *
     */
    public function destroy(Request $request, $offer_type)
    {
        $offer_type->delete();

        return Redirect::to('admin/offer_type')
            ->with('flash_alert_notice', 'offer type was successfully deleted!');
    }

    public function show(OfferType $offer_type)
    {
    }

   
}
