<?php

namespace App\Http\Controllers\adminshop;
use DB;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
class ShoploginController extends Controller
{
      /**
      *
      *  登录页面
      *  @return 返回登录视图
      */
      public function getLogin()
      {
         return view('/adminshop/login');
      }
      /**
      *
      *  执行登录验证
      *  @return 返回布尔型 存入session
      */
      public function postLogins(Request $request)
      {  
         $data = $request->except('code','_token');
         $pass = $request->input('password');

         if(empty($data['phone'])){
            return back()->withInput()->with('error','用户名不能为空');
         } 
         if(empty($data['password'])){
            return back()->withInput()->with('error','密码不能为空');
         } 

         $res = DB::table('user')->where('phone',$data['phone'])->first();
        
         if(empty($res)){
            return back()->withInput()->with('error','当前用户不存在');
         }

         if($res->author != 2){
            return back()->withInput()->with('error','您的权限不符合');
         }

         $pas = DB::table('user')->where('phone',$res->phone)->first();

         if(Hash::check($pass,$pas->password)){

            session(['sid'=>$res->id]);

            $request->session()->put('name',$res->phone);

         }else{
            return back()->withInput()->with('error','密码不正确');
         }

         //判断用户是否创建店铺
         $sel = DB::table('shop')->where('uid',$res->id)->first();
         
         if(empty($sel)){
               return view('/adminshop/shopest');
         }
         return redirect('/adminshop/index');
      }
}
