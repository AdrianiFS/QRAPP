<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qrgenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class QrgeneratorController extends Controller
{
    public function index()
    {
        $qrgenerator = Qrgenerator::where('user_id', Auth::user()->id)->latest()->get();
        return $qrgenerator;
    }

    public function queryString(Request $request)
    {
        $param = $request->input('generatedUrl');
        $url = DB::table('qrgenerators')->where('generatedUrl', $param)->first();
        if (!$url) {
            abort(404);
        } else {
            return Redirect::to($url->redirectionUrl);
        }
    }

    public function qrform(Request $request)
    {
        $qrgenerator = Qrgenerator::latest()->get();
        return view('qrpages.qrform', compact('qrgenerator'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'generatedUrl' => 'required|max:50',
            'redirectionUrl' => 'required|max:50',
        ]);
        $data['user_id'] = Auth::user()->id;
        $data['generatedUrl'] = $request['generatedUrl'];
        $data['redirectionUrl'] = $request['redirectionUrl'];
        Qrgenerator::create($data);

     }

    protected function updateResource()
    {
        $validatedredirectionUrl = request()->validate([
            'redirectionUrl' => 'required|max:100'
        ]);
        $user_id = Auth::user()->id;
        $paramOrigin = request('generatedUrl');
        $paramRedirection = request('redirectionUrl');
        $msg = 'required field';
        if (!$paramRedirection) {
            return  $msg;
        } else {
            $affected = Qrgenerator::where('generatedUrl', $paramOrigin)->where('user_id', $user_id)
                ->update($validatedredirectionUrl);
            return $affected;
        }
    }
    protected function delete()
    {
        $user_id = Auth::user()->id;
        $paramOrigin = request('generatedUrl');
        Qrgenerator::where('generatedUrl', $paramOrigin)->where('user_id', $user_id)->delete();
    }
    
    protected function qrGenerator()
    {
        return view('qrpages.qrGenerator');
    }
    
    protected function  qrGeneratorData(Request $request)
    {
        //  compact('urlWithQueryString')
        $urlWithQueryString = $request->fullUrl();
        return $urlWithQueryString;
    }
}
