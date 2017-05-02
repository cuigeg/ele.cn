<?php
namespace App\Http\Controllers\Auth;

use App\User;
use Hash;
use DB;
use Ucpaas;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   /**
    *
    *登录页面
    *
    **/
     public function getLogin()
    {

         return view('/auth/login');
    }
    
      /**
        *
        *   登录
        *   @param  varchar  $username   用户账号
        *   @param  varchar  $password   用户密码
        **/
    public function postDologin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        //内置验证
        $this->validate($request,[
            'phone' => 'required',
            'phone'=>'regex:/^1\d{10}$/',
            'password'=>'required|regex:/^\w{6,18}\w$/'
        ],[
            //错误提示信息
            'phone.regex'=>'电话格式不正确',
            'phone.required'=>'手机号不能为空',
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码不符合格式'
        ]);
        $res = DB::table('user')
                  ->where('phone',$username)
                  ->where('author',1)
                  ->first();
          $newpassword = $res->password;        
         if (Hash::check($password,$newpassword)) {
            session(['uid'=>$res->id]);
            session(['phone'=>$username]);
            return redirect('/home/index');
        }else{
            return back()->withInput()->with('error','密码错误，登录失败');
        }

    }

     /**
    *
    *注册页面
    *
    **/
    public function getRegister()
    {
         return view('auth.Register');
    }

     /**
      *
      *   验证码
      * 
      *   @param  int  id    手机号码
      *   @return int  param 验证码
      **/
    public function postLog(Request $request)
    {

      //初始化必填
      $options['accountsid']='88a5d88dbeca3ac1d0e32a355e29dd2a';
      $options['token']='72af76fa791519858d269fe4639766bd';


      //初始化 $options必填
      $ucpass = new Ucpaas($options);

      //开发者账号信息查询默认为json或xml

      // echo $ucpass->getDevinfo('xml');


      //语音验证码,云之讯融合通讯开放平台收到请求后，向对象电话终端发起呼叫，接通电话后将播放指定语音验证码序列
      //$appId = "xxxx";
      //$verifyCode = "1256";
      //$to = "18612345678";

      //echo $ucpass->voiceCode($appId,$verifyCode,$to);

      //短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
      $appId = "c1657bd321094f29b7a3482a88aec2d7";
      $to = ($request->input('id'));
      $templateId = "40154";
      $code = rand(100000,999999);
      $param=$code;

      echo $ucpass->templateSMS($appId,$to,$templateId,$param);
      session(['param' =>$param]);
      return($param);
    }

    /**
    *
    *  注册
    *   @param  array    $datas     获取账号，密码，验证码信息
    *   @param  varchar  $code      验证码
    *   @param  init     $phone     账号号码
    *   @param  varchar  $password  用户密码
    **/
    public function postReg(Request $request)
    {
      $datas = $request->except('_token','code');
      $code = $request->input('code');
      $phone = $request->input('phone');
      $password = $request->input('password');
        //内置验证
        $this->validate($request,[
            'phone' => 'required',
            'phone'=>'regex:/^1\d{10}$/',
            'password'=>'required|regex:/^\w{6,18}\w$/'
        ],[
            //错误提示信息
            'phone.regex'=>'电话格式不正确',
            'phone.required'=>'手机号不能为空',
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码不符合格式'
        ]);
        $res = DB::table('user')->where('phone',$phone)->first();
        if(empty($res)){
          if(session('param')!=$code){
            $password = Hash::make($password);
            $uid = DB::table('user')->insertGetId(['phone'=>$phone,'password'=>$password]);
            DB::table('userinfor')->insert(['phone' =>$phone,'uid'=>$uid]);
            return view('/auth/login');
          }else{
            return back()->withInput()->with('error','验证码错误');
          }  
        }else{
            return back()->withInput()->with('error','您的号码已注册，请登录');
        }  
    } 

    /**
    *
    *   退出登录
    *
    **/
    public function getExit()
    {
         session()->forget('phone');
         session()->forget('uid');
         session()->forget('shoplist');

         return view('/auth/login');
    }

}
