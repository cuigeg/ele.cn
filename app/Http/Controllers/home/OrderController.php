<?php
namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
    * 分配购物车界面
    * @param  array  $shoplist  购物车菜品信息
    * @return array  $res       购物车菜品信息
    * @return array  $aa        购物车内单个菜品图片，ID 详情信息
    * @return array  $pos       送餐的详细信息
    *   
    **/
    public function getShopcart(Request $request)
    {
    
      if(session('uid')){

        $shoplist = $request->except('upload','bn','cmd');
        if($shoplist){
           session(['shoplist'=>$shoplist]);
           $res = array_chunk(session('shoplist'),5);
        }else{
           $res = array_chunk(session('shoplist'),5);
        }
        
       
        $aa = [];
        foreach($res as $k=>$v){
            $data = DB::table('food')
               ->select('pic','food.id','info','food.sid')
               ->where('foodname',$v[1])
               ->get(); 
               $aa[] = $data;
        } 


        $pos = DB::table('address')->where('uid',session('uid'))->get();
         // dd($res,$aa,$pos);
        return view('/home/shopcart',['res'=>$res,'aa'=>$aa,'position'=>$pos]);

      }else{
        return redirect('/auth/login');
      }

      
    }

    /**
    *
    *   菜品确认下订单
    *   @param      varchar $price   菜品价格信息
    *   @param      array   $res     菜品数量，单价，名称
    *   @param      varchar $comment 用户订单备注
    *   @param      varchar $pid     用户的地址id
    *   @param      emnu    $zf      支付形式 
    *          
    **/
    public function postOriders(Request $request)
    {
      $price = $request->input('price');
      $res = $request->except('_token','comment','zf','pid','price','sid');
      $comment = $request->input('comment');
      $pid = $request->input('pid');
      $zf = $request->input('zf');
      $sid = $request->input('sid');
      $res = array_chunk($res,2);
      $time = time();
       $id = DB::table('orders')->insertGetId(['pid'=>$pid,'uid'=>session('uid'),'sid'=>$sid,'date'=>$time,'comment'=>$comment,'price'=>$price,'zf'=>$zf]);
        if($id){
         foreach($res as $k=>$v){
          $boolean = DB::table('corders')->insert(['counts'=>$v[0],'cid'=>$v[1],'rid'=>$id]);
          }
          if($boolean){
            session()->forget('_previous');
            session()->forget('flash');
            session()->forget('shoplist');
            return redirect('/personal/person7');
          }else{
            return back()->withInput()->with('error','抱歉下单失败，请重新下单');
          }
        
            return back()->withInput()->with('error','抱歉下单失败，请重新下单');
         }
        
      
    }


    /**
    *
    *   新增配送地址
    *   @param  array  $data  新增配送地址信息
    *
    **/

    public function postAddress(Request $request)
    {
      $data = [];
      $data[] = $request->except('_token');
      $data[0]['uid'] = session('uid');
      $res = DB::table('address')->insert($data);
      if($res){
        return redirect('/order/shopcart');
      }else{
        return back()->withInput()->with('error','抱歉添加失败地址');
      }
    }

    /**
    *
    *     ajax删除不在使用的地址
    *
    *     @param varchar  $id   订单地址ID
    *
    **/
     public function getDelete(Request $request)
     {
        $id = $request->input('id');

        $res = DB::table('address')->where('id',$id)->delete();

        if($res){
            return 1;
        }else{
            return 0;
        }
     }

}
