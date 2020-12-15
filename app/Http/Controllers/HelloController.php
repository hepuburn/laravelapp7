<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HelloRequest;
use Validator;
use Illuminate\Support\Facades\DB;



use Illuminate\Http\Response;


class HelloController extends Controller
{



   public function index(Request $request)
   {
       if ($request->hasCookie('msg'))
       {
           $msg = 'Cookie: ' . $request->cookie('msg');
       } else {
           $msg = '※クッキーはありません。';
       }
       return view('hello.index', ['msg'=> $msg]);
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

}
  
