<?php
namespace App\Http\Controllers\home;
use Session;
use Ucpaas;
use Illuminate\Http\Request;
use Crypt;
use DB;
use Hash;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{ 

  public static function youqing()
  {
    $res = DB::table('youqing')->get();

    return $res;
  }

  /**
      *
      *      进入主页页面
      *
      *
      **/    
     public function getIndex()
    {

         return view('home.index');
    }

     
    /**
    *
    *  ajax主页地址搜索
    *  @param varchar $position  搜索地址
    *
    **/
    public function postSeach(Request $request)
    {
      $position = $request->input('res');

       if($position){
          $res=DB::table('shop')->where('address','like','%'.$position.'%')->get();
          if(!empty($res)){
            $arr = [];
            foreach ($res as $k => $v) {
              $arr[] = $v->address;
             $data=array_unique($arr);
          }
          
            return $data;
          }else{
            return ;
          }
        }else{
           return ;
        }
    }
    

    /**
    *
    *   进入店家没有菜单跳转页面
    *
    *
    **/
     public function getOffers()
    {
         return view('home.offers');
    }

   
    /**
    *
    *
    *   进入到帮助页面
    *
    **/
    public function getHelp()
    {
        return view('home.help');
    }

    /**
    *
    *   友情链接
    *   @return 返回youqing表数据 插入视图
    */


}