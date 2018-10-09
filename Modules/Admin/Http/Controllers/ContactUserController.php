<?php
declare(strict_types=1);
 
namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Admin\Entities\ContactUser;  
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
class ContactUserController extends Controller
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
         
        View::share('viewPage', 'contactuser'); 
        View::share('route_url', route('contactuser'));
        View::share('heading', 'Contact User');

        $this->record_per_page = Config::get('app.record_per_page');
    }
 

    /*
     * Dashboard
     * */

    public function index(ContactUser $contactUser, Request $request)
    {
        $page_title  = 'Contact User';
        $page_action = 'View Contact User';

     
        // Search by name ,email and group
        $search = Input::get('search');

        if ((isset($search) && !empty($search))) {
            $search = isset($search) ? Input::get('search') : '';

            $contactUser = ContactUser::where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->Where('name', 'LIKE', "%$search%");
                    $query->orWhere('email', 'LIKE', "%$search%");
                    $query->orWhere('phone_no', 'LIKE', "%$search%");
                }
            })->orderBy('name', 'asc')->Paginate($this->record_per_page);
        } else {
            $contactUser  = ContactUser::orderBy('id', 'asc')->Paginate($this->record_per_page);
        }

        return view('admin::contact_user.index', compact('contactUser', 'page_title', 'page_action'));
    }

  
   
    /*
     *Delete ads type
     * @param ID
     *
     */
    public function destroy(ContactUser $contactUser,Request $request)
    {
        $contactUser->delete();
        return Redirect::to('admin/contactuser')
            ->with('flash_alert_notice', 'Contact user was successfully deleted!');
    }

    public function show(ContactUser $contactUser)
    {
    }

  
}
