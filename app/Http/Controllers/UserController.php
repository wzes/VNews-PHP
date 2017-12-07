<?php
/**
 * Created by PhpStorm.
 * User: shikaijie
 * Date: 17-12-6
 * Time: 下午9:01
 */

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends  Controller
{
    public function logAccount(Request $request){
        $user=DB::table('user')->where('username',$request->username)->first();
        if($user){
            if($user->password==$request->password){
                return response()->json(['code'=>'200','message'=>'success',
                    'content'=>array()]);
            }
            else{
                return response()->json(['code'=>'500','message'=>'password error',
                    'content'=>array()]);
            }
        }else{
            return response()->json(['code'=>'500','message'=>'username error',
                'content'=>array()]);
        }
    }
    public function register(Request $request){
        $user=DB::table('user')->where('telephone',$request->telephone)->first();
        $username=DB::table('user')->where('username',$request->username)->first();
        if($user){
            return response()->json(['code'=>'500','message'=>'telephone error',
                'content'=>array()]);
        }
        else{
            if($username){
                return response()->json(['code'=>'500','message'=>'username error',
                    'content'=>array()]);
            }else{
                DB::table('user')->insert(['ID'=>$request->telephone,'username'=>$request->username,'password'=>$request->password,
                    'telephone'=>$request->telephone]);
                return response()->json(['code'=>'200','message'=>'success',
                    'content'=>array('ID'=>$request->telephone)]);
            }
        }
    }
    public function checkPhone(Request $request,$telephone){
        $user=DB::table('user')->where('telephone',$telephone)->first();
        if($user){
            return response()->json(['code'=>'500','message'=>'telephone error',
                'content'=>array()]);
        }else{
            return response()->json(['code'=>'200','message'=>'success',
                'content'=>array()]);
        }
    }
    public function updateUser(Request $request,$username){
        $user=DB::table('user')->where('username',$username)->first();
        $newuser=DB::table('user')->where('username',$request->username)->first();
        if($user){
            if($newuser){
                return response()->json(['code'=>'500','message'=>'new username error',
                    'content'=>array()]);
            }else{
                if($request->has('username','password','email','sex','birthday','image','motto','info')){
                    DB::table('user')->where('username',$username)->update(['username'=>$request->username,'password'=>$request->password,
                        'email'=>$request->email,'sex'=>$request->sex,'birthday'=>$request->birthday,
                        'image'=>$request->image,'motto'=>$request->motto,
                        'info'=>$request->info]);
                    return response()->json(['code'=>'200','message'=>'success',
                        'content'=>array()]);
                }
                else{
                    return response()->json(['code'=>'500','message'=>'information error',
                        'content'=>array()]);
                }
            }
        }else{
            return response()->json(['code'=>'500','message'=>'username error',
                'content'=>array()]);
        }
    }
    public function  getUser(Request $request,$username){
        $user=DB::table('user')->where('username',$username)->first();
        if($user){
            return  response()->json(['code'=>'200','message'=>'success',
                'content'=>array(['ID'=>$user->ID,'username'=>$user->username,'password'=>$user->password,'email'=>$user->email,
                    'sex'=>$user->sex,'birthday'=>$user->birthday,'image'=>$user->image,'telephone'=>$user->telephone,
                    'motto'=>$user->motto,'info'=>$user->info])]);
        }else{
            return response()->json(['code'=>'500','message'=>'username error',
                'content'=>array()]);
        }
    }
}