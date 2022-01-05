<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;
use lluminate\Pagination\LengthAwarePaginator;

class EmailController extends Controller
{
    public function index(Request $request){
        $result = Email::query();
        if($request->input('status')!=''){
            $result->where('status',$request->status);   
        }
        $emailData = $result->orderBy('id','desc')->paginate(1);
        return view('email.emaillist')->with(array('emails'=>$emailData));
    }
}
