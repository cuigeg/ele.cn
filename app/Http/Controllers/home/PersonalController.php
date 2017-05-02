<?php
namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use DB;
use Hash;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PersonalController extends Controller
{
    public function getPerson()
    {
         return view('/home/person');
    }
    /**
    *
    * 进入更换头像
    * @param $photo
    *
    **/
    public function getPerson1()
    {
        $res =  DB::table('userinfor')->where('uid',session('uid'))->first();
        $photo = $res->pic;
        return view('/home/person1',['photo'=>$photo]);
    }

    /**
    *
    * 更换头像
    *
    *
    **/
    public function postPhoto(Request $request)
    {
      $photo = $request->input('pic');

      //调用图片上传方法
      $photo = self::upload($request);

      $boolean = DB::table('userinfor')->where('uid',session('uid'))->update(['pic'=>$photo]);

       if($boolean){
          return redirect('/personal/person4');
        }else{
          return back()->withInput()->with('errpr','修改头像失败');
        }


    }


    /**
    *
    *   进入修改密码页面
    *
    *
    **/
    public function getPerson2()
    {
         return view('/home/person2');
    }

    /**
    *
    * 修改密码页面
    *
    *
    **/
    public function postPassword(Request $request)
    {
      $phone = $request->input('phone');
      $oldpassword = $request->input('oldpassword');
      $newpassword = $request->input('newpassword');
      $truepassword = $request->input('truepassword');

       $res = DB::table('user')
                  ->where('phone',$phone)
                  ->where('author',1)
                  ->first();        
        if (Hash::check($oldpassword,$res->password)) {
        if($newpassword==$truepassword && $newpassword!=$oldpassword){
          $newpassword = Hash::make($newpassword);
          $boolean = DB::table('user')->where('id',session('uid'))->update(['password'=> $newpassword]);
          if($boolean){
            $request->session()->flush();
            return redirect('/auth/login')->with('success','密码修改成功，请重新登录');
          }else{
            return back()->withInput()->with('error','密码修改失败');
          }
        }else{
            return back()->withInput()->with('error','确认密码与新密码不同或者新密码与原密码相同修改失败');
        }
       }else{
         return back()->withInput()->with('error','账号密码输入错误');
      }
    }

    /**
    *
    *
    * 进入完善资料页面
    * @param $res  查询本人基本信息
    *
    **/
    public function getPerson3()
    {
        $res = DB::table('userinfor')->where('uid',session('uid'))->first();
        if($res){
          return view('/home/person3',['res'=>$res]);
        }else{
          return view('/home/person3');
        }
    }

    /**
    *
    *
    *   完善个人信息
    *
    *  
    **/
    public function postAddperson3(Request $request)
    {
        $res = $request->except('_token');

        //调用图片上传方法
        $res['pic'] = self::upload($request);
        
        $boolean = DB::table('userinfor')->where('uid',session('uid'))->update($res);

        if($res){
          return redirect('/personal/person4');
        }else{
          return back()->withInput()->with('error','完善失败');
        }
    }

     /**
    *
    *
    *   查看用户的个人信息
    *   @param $res 个人信息   
    *  
    **/
    public function getPerson4()
    {
         $res = DB::table('userinfor')->where('uid',session('uid'))->first();
         return view('/home/person4',['res'=>$res]);

        
    }
    /**
    *
    *   订单列表页(所有订单)
    *   @param $res 用户的订单信息
    *   @param $aa 用户的菜品详情信息
    *
    **/
public function getPerson5(Request $request)
    {
       //搜索
      $num = $request->input('num',5);

      if($request->keyword){
         $res = DB::table('orders')
                    ->where('uid',session('uid'))
                    ->where('id','like','%'.$request->keyword.'%')
                    ->where('state',0)
                    ->orderBy('id', 'desc')
                    ->paginate($num);
      }else{
         $res = DB::table('orders')
                    ->where('uid',session('uid'))
                    ->where('state',0)
                    ->orderBy('id', 'desc')
                    ->paginate($num);
      }

      //获取所有的请求参数
      $all=$request->all();


      $aa = [];
      $data = [];
      foreach($res as $k=>$v){
        $rid = $v->id;
        $bb = DB::table('corders')
               ->join('food','food.id','=','corders.cid')
               ->where('rid',$rid)
               ->get();
        $aa[] = $bb;

        $cc = DB::table('comment')->where('rid',$rid)->first();

        $data[] = $cc; 
      }

      return view('/home/person5',['res'=>$res,'aa'=>$aa,'data'=>$data,'all'=>$all]);
    }

    
    /**
    *
    *   订单列表页(所有订单)
    *   @param $res 用户的订单信息
    *   @param $aa 用户的菜品详情信息
    *   @return $data 用户评价信息
    *
    **/
    public function getPerson7(Request $request)
    {
      //搜索
      $num = $request->input('num',5);

      if($request->keyword){
         $res = DB::table('orders')
                    ->where('uid',session('uid'))
                    ->where('id','like','%'.$request->keyword.'%')
                    ->orderBy('id', 'desc')
                    ->paginate($num);
      }else{
         $res = DB::table('orders')
                    ->where('uid',session('uid'))
                    ->orderBy('id', 'desc')
                    ->paginate($num);
      }

      //获取所有的请求参数
      $all=$request->all();


      $aa = [];
      $data = [];
      $ff = [];
      foreach($res as $k=>$v){
        $rid = $v->id;
        $bb = DB::table('corders')
               ->join('food','food.id','=','corders.cid')
               ->where('rid',$rid)
               ->get();
        $aa[] = $bb;

        //评价
        $cc = DB::table('comment')->join('orders','orders.id','=','comment.rid')->where('rid',$rid)->first();

        $data[] = $cc; 

         //查询订单回复信息
        $dd = DB::table('reply')
                  ->join('orders','orders.id','=','reply.rid')
                  ->join('userinfor','userinfor.uid','=','reply.uid') 
                  ->where('rid',$rid)
                  ->get(); 
        $ff[] = $dd;
      }
      // dd($res,$aa,$data,$all,$ff);
      return view('/home/person7',['res'=>$res,'aa'=>$aa,'data'=>$data,'all'=>$all,'ff'=>$ff]);
    }

    /**
    *
    *   ajax接单
    *
    *
    **/
    public function getJorder(Request $request)
    {
      $id = $request->input('id');

      $res = DB::table('orders')->where('id',$id)->update(['state'=>0]);

      if($res){
          return 1;
      }else{
          return 0;
      }
      
    }

  /**
    *
    *   订单列表页(所有订单)
    *   @param $res 用户的订单信息
    *   @param $aa 用户的菜品详情信息
    *
    **/
    public function getPerson6(Request $request)
    {
      //搜索
      $num = $request->input('num',5);

      if($request->keyword){
         $res = DB::table('orders')
                      ->where('uid',session('uid'))
                      ->where('state',1)
                      ->orwhere('state',2)
                      ->where('id','like','%'.$request->keyword.'%')
                      ->orderBy('id', 'desc')
                      ->paginate($num);;
      }else{
          $res = DB::table('orders')
                    ->where('uid',session('uid'))
                    ->where('state',1)
                    ->orwhere('state',2)
                    ->orderBy('id', 'desc')
                    ->paginate($num);;
      }

      //获取所有的请求参数
      $all=$request->all();


      $aa = [];
      foreach($res as $k=>$v){
        $rid = $v->id;
        $bb = DB::table('corders')
               ->join('food','food.id','=','corders.cid')
               ->where('rid',$rid)
               ->get();
        $aa[] = $bb;
      }

      return view('/home/person6',['res'=>$res,'aa'=>$aa,'all'=>$all]);
    }


     /**
    *
    *   订单列表页(所有订单)
    *   @param $res 用户的订单信息
    *   @param $aa 用户的菜品详情信息
    *
    **/
public function getPerson8(Request $request)
    {
       //搜索
      $num = $request->input('num',5);

      if($request->keyword){
         $res = DB::table('orders')
                    ->where('state',3)
                    ->orwhere('state',0)
                    ->orwhere('state',4)
                    ->where('uid',session('uid'))
                    ->where('id','like','%'.$request->keyword.'%')
                    ->orderBy('id', 'desc')
                    ->paginate($num);
      }else{
         $res = DB::table('orders')
                    ->where('state',3)
                    ->orwhere('state',0)
                    ->orwhere('state',4)
                    ->where('uid',session('uid'))
                    ->orderBy('id', 'desc')
                    ->paginate($num);
      }

      //获取所有的请求参数
      $all=$request->all();


      $aa = [];
      $data = [];
      $ff = [];
      foreach($res as $k=>$v){
        $rid = $v->id;
        $bb = DB::table('corders')
               ->join('food','food.id','=','corders.cid')
               ->where('rid',$rid)
               ->get();
        $aa[] = $bb;

        //查询订单评论信息
        $cc = DB::table('comment')->where('rid',$rid)->first();

        $data[] = $cc;


        //查询订单回复信息
        $dd = DB::table('reply')
                  ->join('orders','orders.id','=','reply.rid')
                  ->join('userinfor','userinfor.uid','=','reply.uid') 
                  ->where('rid',$rid)
                  ->get(); 
        $ff[] = $dd;
      }
      return view('/home/person8',['res'=>$res,'aa'=>$aa,'data'=>$data,'all'=>$all,'ff'=>$ff]);
    }


      /**
      *
      *   进行图片上传处理
      *
      *   @param '/uload/'.$name.'.'.$suffix;
      **/
      static public function upload($request)
      {
        //判断是否有文件上传
        if($request->hasFile('pic')){
            //随机文件名
            $name = md5(time()+rand(1,999999));
            //获取文件的后缀名
            $suffix = $request->file('pic')->getClientOriginalExtension();
            $arr = ['png','jpeg','gif','jpg'];
            if(!in_array($suffix,$arr)){
                return back()->with('error','上传文件格式不正确');
            }
            $request->file('pic')->move('./upload/', $name.'.'.$suffix);
            //返回路径
            return '/upload/'.$name.'.'.$suffix;
        }
      }

      /**
      *
      *
      *   订单评论
      *   @param int $rid 订单id
      *   @param array $data 获取评论参数
      *
      **/
      public function postComment5(Request $request)
      {
          //获取订单id
          $rid = $request->input('rid');

          $data = $request->except('_token');

          $data['uid'] = session('uid');

          $data['date'] = time();

          $res = DB::table('comment')->insert($data);

          if($res){

            $boolean = DB::table('orders')->where('id',$rid)->update(['state'=>3]);

            return redirect('/personal/person5')->with('success','恭喜您评论成功');
          }else{
            return back()->withInput()->with('error','恭喜您评论成功');
          }

      }

      /**
      *
      *
      *   订单评论
      *   @param int $rid 订单id
      *   @param array $data 获取评论参数
      *
      **/
      public function postComment7(Request $request)
      {
          //获取订单id
          $rid = $request->input('rid');

          $data = $request->except('_token');

          $data['uid'] = session('uid');

          $data['date'] = time();

          $res = DB::table('comment')->insert($data);

          if($res){

            $boolean = DB::table('orders')->where('id',$rid)->update(['state'=>3]);

            return redirect('/personal/person7')->with('success','恭喜您评论成功');
          }else{
            return back()->withInput()->with('error','恭喜您评论成功');
          }

      }


}
