<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HelloRequest;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Person;



use Illuminate\Http\Response;


class HelloController extends Controller
{



    public function index(Request $request)
    {
       $items = DB::table('people')->simplePaginate(5);
       return view('hello.index', ['items' => $items]);
    }


    public function post(Request $request)
    {
        $validate_rule = [
            'msg' => 'required',
        ];
        $this->validate($request, $validate_rule);
        $msg = $request->msg;
        $response = response()->view('hello.index', 
            ['msg'=>'「' . $msg . 
            '」をクッキーに保存しました。']);
        $response->cookie('msg', $msg, 100);
        return $response;
    }

    public function rest(Request $request)
    {
    return view('hello.rest');
    }

    public function ses_get(Request $request)
    {
    $sesdata = $request->session()->get('msg');
    return view('hello.session', ['session_data' => $sesdata]);
    }

    public function ses_put(Request $request)
    {
    $msg = $request->input;
    $request->session()->put('msg', $msg);
    return redirect('hello/session');
    }


}
  
