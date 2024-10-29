<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class RBController extends Controller
{
    public function rb_buscar(Request $request){
    	
    	$rbs = User::where('folio','like',"%$request->buscar%")->orWhere('name','like',"%$request->buscar%")->where('cargo_id',4)->take(3)->get();

    	return response()->json([
         'rbs' => $rbs,
      	]);
    }					


    public function rb_datos(Request $request){
    	
    	$rb = User::find($request->id);

    	return response()->json([
    		'rb' => $rb
		]);
		
    }

}
