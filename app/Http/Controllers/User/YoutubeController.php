<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\LicenseController;
use App\Services\Statistics\UserService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;
use App\Models\SubscriptionPlan;
use App\Models\Image;
use App\Models\User;
use App\Models\ApiKey;
use App\Services\Service;
use Carbon\Carbon;

class YoutubeController extends Controller
{
    private $api;
    private $user;

    public function __construct()
    {
        $this->api = new LicenseController();
        $this->user = new UserService();
    }

    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $data = Image::where('user_id', Auth::user()->id)->latest()->limit(18)->get();
        $records = Image::where('user_id', Auth::user()->id)->count();

        if (auth()->user()->plan_id) {
            $plan = SubscriptionPlan::where('id', auth()->user()->plan_id)->first();
            if ($plan) {
                $openai_model = ($plan->dalle_image_engine != 'none') ? $plan->dalle_image_engine : 'none';
                $sd_model = ($plan->sd_image_engine != 'none') ? $plan->sd_image_engine : 'none';
                $openai_engine = "";
                $sd_engine ="";
            } else {
                $openai_model = 'none';
                $sd_model = 'none';
                $openai_engine = "";
                $sd_engine ="";
            }
        } else {
            $openai_model = 'none';
            $sd_model = 'none';
            $openai_engine = "";
            $sd_engine = "";
        }       

        return view('user.youtube.index', compact('data', 'records', 'openai_model', 'sd_model', 'openai_engine', 'sd_engine'));
    }






    public function submit(Request $request) 
    {

        $data = [
        "action" => $request->input('action'),
        "content" => $request->input('content'),
        "language" => $request->input('language'),
        "model" => $request->input('model'),
    ];

 if ($request->input('action') == "Article") {

        $data = [
            "status" => "successful",
            "article" => "article",
            "title" => "youtube video title - article",
            "content"=>"content content content content content content content content ",
            // "body" => "ertyuiocvbng"
        ];
        return response()->json($data);
    } else if ($request->input('action') == "Summary") {
        // If the action is not "article," you can have a default response or handle it accordingly
        $data = [
            "status" => "successful",
            "article" => "Summary",
            "title" => "youtube video title - summary",
            "content"=>"content content content content content content content content ",
            // "body" => "ertyuiocvbng"
        ];
        return response()->json($data);
    }
      else if ($request->input('action') == "Transcript") {
        // If the action is not "article," you can have a default response or handle it accordingly
        $data = [
            "status" => "successful",
            "article" => "Transcript",
            "title" => "youtube video title - Transcript",
            "content"=>"content content content content content content content content ",
            // "body" => "ertyuiocvbng"
        ];
        return response()->json($data);
    }



    return response()->json($request);;
    $data = [
        "status" => "successful",
        "body" => "ertyuiocvbng"
    ];

        

        



        // return json_encode($data);
        return response()->json($data);


        // return "$data";
    }


}
