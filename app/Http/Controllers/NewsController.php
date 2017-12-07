<?php
/**
 * Created by PhpStorm.
 * User: shikaijie
 * Date: 17-12-7
 * Time: 下午2:51
 */

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends  Controller
{
    public function getCategory(Request $request,$category){
        $news=DB::table('news')->where('type',$category)->get();
        $result=array();
        if($news!='[]'){
            foreach ($news as $new){
                echo $new->title.'</br>';
                $result[]=$new;
            }
            return response()->json(['code'=>'200','message'=>'success',
                'content'=>$result]);
        }else{
            return response()->json(['code'=>'500','message'=>'category error',
                'content'=>array()]);
        }
    }
    public function hotNews(Request $request){
        $allNews=DB::table('view_news')->orderBy('count','desc')->get();
        $hotNews=array();
        if($allNews!='[]'){
            for($i=$request->start;$i<$request->count;$i++){
                echo $allNews[$i]->newsID;
                $selectedNews=DB::table('news')->where('ID',$allNews[$i]->newsID)->get();
                if($selectedNews){
                    $hotNews[]=$selectedNews;
                }else{
                    return response()->json(['code'=>'500','message'=>'not found error',
                        'content'=>array()]);
                }
            }
            return response()->json(['code'=>'200','message'=>'success',
                'content'=>$hotNews]);
        }else{
            return response()->json(['code'=>'500','message'=>'empty error',
                'content'=>array()]);
        }
    }
    public function detail(Request $request){
        echo'sdufsd';
        echo $request->id;
        $news=DB::table('news')->where('ID',$request->id)->first();
        if($news){
            return response()->json(['code'=>'200','message'=>'success',
                'content'=>$news]);
        }else{
            return response()->json(['code'=>'500','message'=>'news_id error',
                'content'=>array()]);
        }
    }
}