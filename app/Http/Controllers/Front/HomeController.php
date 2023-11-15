<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Basic;
use App\Models\Content;
use App\Models\Customer;
use App\Models\Governance;
use App\Models\Service;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    //get home view
    public function home(){
        $basic = Basic::with('media')->first();
        $about = About::with('media')->first();
        $governances = Governance::query()->first();
        $importantServices = Service::where('status','active')->where('important','1')->take(4)->get();
        $getLastThreeContents  = Content::with('service')->latest()->take(3)->get(); 
        $getCustomers = Customer::all();

       
        return view('index',compact('basic','about','governances','importantServices','getLastThreeContents','getCustomers'));
    }
}
