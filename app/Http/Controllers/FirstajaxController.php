<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\firstajax;
use DB;

class FirstajaxController extends Controller
{
   public function home(){
       $list=firstajax::all();
       return view('ajax.list',['list'=>$list]);
   }
   public function create(Request $request){
   /*    $addname=new firstajax();
       $addname->name=$request->text;
       $addname->save();
*/
DB::table('firstajaxes')->insert([
    'name'=>$request->text,
    
        ]);
    return "done";
}
public function delete(Request $request){
    firstajax::where('id',$request->id)->delete();
        return $request->all();
}
public function update(Request $request){
    $update=firstajax::find($request->id);
    $update->name=$request->value;
    $update->save();

    return $request->all();
}
}
