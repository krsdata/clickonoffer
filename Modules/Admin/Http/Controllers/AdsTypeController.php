<?php

declare(strict_types=1);
 
namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Admin\Entities\AdsType;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect; 
use Modules\Admin\Models\Permission;
use Route;
use Validator;
use View;
use Storage;
use Illuminate\Support\Facades\Input;

/**
 * Class AdminController
 */
class AdsTypeController extends Controller
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
         
        View::share('viewPage', 'adstype'); 
        View::share('route_url', route('adstype'));
        View::share('heading', 'Ads Type');

        $this->record_per_page = Config::get('app.record_per_page');
    }
 

    /*
     * Dashboard
     * */

    public function index(AdsType $adsType, Request $request)
    {
        $page_title  = 'Ads Type';
        $page_action = 'View Ads Type';

     
        // Search by name ,email and group
        $search = Input::get('search');

        if ((isset($search) && !empty($search))) {
            $search = isset($search) ? Input::get('search') : '';

            $adsType = AdsType::where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->Where('title', 'LIKE', "%$search%");
                }
            })->orderBy('title', 'asc')->Paginate($this->record_per_page);
        } else {
            $adsType  = AdsType::orderBy('id', 'asc')->Paginate($this->record_per_page);
        }

        return view('admin::ads_type.index', compact('adsType', 'page_title', 'page_action'));
    }

    /*
     * create  method
     * */

    public function create(AdsType $adsType)
    { 
        $page_title  = 'Ads Type';
        $page_action = 'Create Ads Type';
        
        return view('admin::ads_type.create', compact('adsType', 'page_title', 'page_action'));
    }

    /*
     * Save Group method
     * */

    public function store(Request $request, AdsType $adsType)
    {


        $validator = Validator::make($request->all(), [
            'title'       => 'required|unique:ads_type,title',
            'image'  => 'required|mimes:jpeg,jpg,png|max:10000'
        ]);
        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $adsType->image = '';
        if ($request->hasFile('image')) 
        {
           $temp_name = time().'_ads_type.'.$request->image->getClientOriginalExtension();              
           $adsType->image = $request->image->storeAs('uploads/ads_type',$temp_name,'ads_type_img');           
        }   
        $adsType->title = $request->get('title');
        $adsType->slug = $request->get('title');
        $adsType->save();

        return Redirect::to('admin/adstype')
            ->with('flash_alert_notice', 'Ads type was successfully created !');
    }
    /*
     * Edit Group method
     * @param
     * object : $category
     * */

    public function edit(Request $request, $adsType)
    {    
        $page_title  = 'Ads Type';
        $page_action = 'Edit Ads Type';
        $url = '';
        if($adsType->image){
            $url = asset('public/'.$adsType->image) ;
        }
        
        return view('admin::ads_type.edit', compact('url','adsType','page_title', 'page_action'));
    }

    public function update(Request $request, $adsType)
    {
        $validator = Validator::make($request->all(), [
            'title'  => 'required|unique:ads_type,title,'.$adsType->id
        ]);
        
        if(empty($adsType->image)) {            
            $validator = Validator::make($request->all(), [
                'image'  => 'required|mimes:jpeg,jpg,png|max:10000'
            ]);            
        }
        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        if ($request->hasFile('image')) 
        {
           Storage::disk('ads_type_img')->delete($adsType->image);

           $temp_name = time().'_ads_type.'.$request->image->getClientOriginalExtension();              
           $adsType->image = $request->image->storeAs('uploads/ads_type',$temp_name,'ads_type_img');  

       
        }   
        $adsType->title = $request->get('title');
        $adsType->slug = $request->get('title');
        $adsType->save();

        return Redirect::to('admin/adstype')
            ->with('flash_alert_notice', 'Ads type was successfully updated!');
    }
    /*
     *Delete ads type
     * @param ID
     *
     */
    public function destroy(Request $request,$adsType)
    {
        Storage::disk('ads_type_img')->delete($adsType->image);
        $adsType->delete();

        return Redirect::to('admin/adstype')
            ->with('flash_alert_notice', 'Ads type was successfully deleted!');
    }

    public function show(AdsType $adsType)
    {
    }

  
}
