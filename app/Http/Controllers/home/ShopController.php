<?php
namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    
 

    /**
    *
    *   进入到商家页
    *    
    *   @param  varchar $res     地址参数
    *   @return array   $datas   附近店铺信息
    **/
    public function getMenu(Request $request)
    {   

        $res = $request->input('Search');

        if($res){
          session(["address"=>$res]);
          $datas = DB::table('shop')->where('address',session('address'))->paginate(9);
        }else{
          $datas = DB::table('shop')->where('address',session('address'))->paginate(9);
        }
        

        $all = $request->all();

        if($datas){

           return view('/home/menu',['datas'=>$datas,'all'=>$all]);
         }else{
           return back()->withInput()->with('error','无效地址');
         }

       
    }


    /**
    *
    *
    *   进入单个商家菜单页面
    *   
    *   @param  int     $sid      商家id
    *   @param  varchar $title    菜品分类
    *   @return int     $sid      商家id
    *   @return array   $datas    分类下的菜品
    *   @return array   $arr      菜品分类
    *   @return array   $dd       菜品详细信息
    *   @return varchar $shopname 商铺名称
    *   
    **/
    public function getProducts(Request $request)
    {
        $sid = $request->input('sid');
      
        $title = $request->input('title');

        $aa = DB::table('shop')->where('id',$sid)->first();

        $shopname = $aa->shopname;

        $res = DB::table('cate')->where('pid','0')->where('uid',$aa->uid)->get();

        if($res!=[]){

         $arr = [];

         foreach ($res as $k => $v) {

         $arr[] = $v->title;

         $datas = DB::table('cate')->where('pid',$v->id)->get();
       
         }

        if($title){
         $dd = DB::table('food') 
            ->select('food.*', 'shop.shopname','cate.title')
            ->join('shop', 'shop.id', '=', 'food.sid')
            ->join('cate','food.lei','=','cate.id')
            ->where('cate.title',$title)
            ->where('sid',$sid)
            ->paginate(8);
         if(empty($dd)){
             return view('/home/products1',['shopname'=>$shopname,'arr'=>$arr,'sid'=>$sid]);
        };
        }else{
          $dd = DB::table('food') 
            ->select('food.*', 'shop.shopname')
            ->join('shop', 'shop.id', '=', 'food.sid')
            ->where('sid',$sid)
            ->paginate(8);
         if(empty($dd)){
             return view('/home/products2',['shopname'=>$shopname,'arr'=>$arr,'sid'=>$sid]);
        };
        }
        $all = $request->all();

        return view('/home/products',['sid'=>$sid,'arr'=>$arr,'datas'=>$datas,'dd'=>$dd,'all'=>$all,'shopname'=>$shopname]);          

    }else{
        return view('/home/products3',['shopname'=>$shopname,'sid'=>$sid]);
    }

  }
   /**
    *
    *   AJAX访问数据库中餐厅信息
    *   @param      varchar  $id        商铺ID
    *   @param      varchar  $shopname  商铺名称
    *   @return     array    $data      商铺信息
    **/
    public function getFoodname(Request $request)
    {

      $id = $request->input('id');
      $shopname = $request->input('shopname');

      $data = DB::table('food') 
            ->select('food.*', 'shop.shopname')
            ->join('shop', 'shop.id', '=', 'food.sid')
            ->where('shopname',$shopname)
            ->where('id',$id)
            ->get();
        return $data;
    }

    /**
    *
    *
    *   进入菜品详情页的ajax
    *   @param  varchar  $id    菜品id
    *   @return array    $data  菜品信息
    **/
    public function getModel(Request $request)
    {
      $id = $request->input('id');

      $data = DB::table('food')->where('id',$id)->get();

      return $data;
    }



}
