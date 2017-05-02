<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class ContController extends Controller
{	
  /**
  *
  * 进入管理员个人信息
  * @return 返回userinfor表数据
  */
   public function getIndex(Request $request)
   {  
    $num = $request->input('num',5);
    $keyword = $request->input('keyword');
    if($request->keyword){
        $res = DB::table('shop')
              ->select('orders.*','address.shname','address.shphone','address.shaddress')
              ->join('orders','orders.sid','=','shop.id')
              ->join('address','address.id','=','orders.pid')
              ->where('orders.id','like','%'.$request->keyword.'%')
              ->orderby('orders.id','desc')
              ->paginate($num);
    }else{
        $res = DB::table('shop')
              ->select('orders.*','address.shname','address.shphone','address.shaddress')
              ->join('orders','orders.sid','=','shop.id')
              ->join('address','address.id','=','orders.pid')
              ->orderby('orders.id','desc')
              ->paginate($num);
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
      return view('/admin/index',['res'=>$res,'aa'=>$aa,'all'=>$all,'keyword'=>$keyword]);
  }
   /**
    *
    * 进入登录页面
    * @return 解析登录视图
    */
   public function getLogin()
   {  
      return view('/admin/login');
   }

   /**
   *
   *  执行登录验证
   *  @return 成功重定向到index 失败 返回上一层
   */
   public function postUserlogin(Request $request)
   {  
    $name = $request->input('phone');
    $password = $request->input('password');

     //内置验证
    $this->validate($request,['phone' => 'required',],['phone.required'=>'账号不能为空',]);

    $res = DB::table('user')->where('phone',$name)->first();
        
    if(empty($res)){
       return back()->withInput()->with('error','当前用户不存在');
    }
    if($res->author != 3){
       return back()->withInput()->with('error','您的权限不符合');
    }

    $pas = DB::table('user')->where('phone',$name)->select('user.password')->first();

        if(!Hash::check($password,$pas->password)) { 
              return back()->withInput()->with('error','密码不正确');
        }else{
            $request->session()->put('id',$res->id);
            $request->session()->put('phone',$res->phone);
        }
            return redirect('/admin/index');

    $res = DB::table('user')
                  ->where('name',$name)
                  ->where('password',$password)
                  ->where('status',3)
                  ->get();

    if($res){
      $res = DB::table('user')->where('phone',$name)->where('password',$password)->where('author',3)->get();
      $request->session()->put('id',$res[0]->id);
      $request->session()->put('phone',$res[0]->phone);
        return redirect('admin/index');
    }else{
        return back()->withInput()->with('error','密码错误，登录失败');
    }
   
   }
      /**
      *
      *   查看订单评论
      *   @param  $num  每页显示
      *   @param  $all  翻页传递的参数
      *   @return $res  订单信息
      *   @return $data 评论的基本信息
      *   @return $ff   回复的基本信息 
      *
      **/
      public function getOrders(Request $request)
      {
        //搜索
        $num = $request->input('num',5);

        if($request->keyword){
           $res = DB::table('orders')
                      ->select('orders.*','address.shname','address.shphone','address.shaddress')
                      ->join('address','address.id','=','orders.pid')
                      ->orderBy('orders.id', 'desc')
                      ->paginate($num);
        }else{
           $res = DB::table('orders')
                      ->select('orders.*','address.shname','address.shphone','address.shaddress')
                      ->join('address','address.id','=','orders.pid')
                      ->orderBy('orders.id', 'desc')
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

          $cc = DB::table('comment')
                    ->join('userinfor','userinfor.uid','=','comment.uid')
                    ->where('rid',$rid)
                    ->first();

          $data[] = $cc; 

           //查询订单回复信息
          $dd = DB::table('reply')
                    ->join('orders','orders.id','=','reply.rid')
                    ->join('userinfor','userinfor.uid','=','reply.uid') 
                    ->where('rid',$rid)
                    ->first(); 
          $ff[] = $dd;
        }

        return view('/admin/orders',['res'=>$res,'aa'=>$aa,'data'=>$data,'all'=>$all,'ff'=>$ff]);
      }

        /**
        *
        *   查看订单评论
        *   @param  $num  每页显示
        *   @param  $all  翻页传递的参数
        *   @return $res  订单信息
        *   @return $data 评论的基本信息
        *   @return $ff   回复的基本信息 
        *
        **/
        public function getOrderreply(Request $request)
        {
          //搜索
          $num = $request->input('num',5);

          if($request->keyword){
             $res = DB::table('orders')
                        ->select('orders.*','address.shname','address.shphone','address.shaddress')
                        ->join('address','address.id','=','orders.pid')
                        ->where('state',3)
                        ->orwhere('state',4)
                        ->orderBy('orders.id', 'desc')
                        ->paginate($num);
          }else{
             $res = DB::table('orders')
                        ->select('orders.*','address.shname','address.shphone','address.shaddress')
                        ->join('address','address.id','=','orders.pid')
                        ->where('state',3)
                        ->orwhere('state',4)
                        ->orderBy('orders.id', 'desc')
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

            $cc = DB::table('comment')
                      ->join('userinfor','userinfor.uid','=','comment.uid')
                      ->where('rid',$rid)
                      ->first();

            $data[] = $cc; 

             //查询订单回复信息
            $dd = DB::table('reply')
                      ->join('orders','orders.id','=','reply.rid')
                      ->join('userinfor','userinfor.uid','=','reply.uid') 
                      ->where('rid',$rid)
                      ->get(); 
            $ff[] = $dd;
          }

          return view('/admin/orderreply',['res'=>$res,'aa'=>$aa,'data'=>$data,'all'=>$all,'ff'=>$ff]);
        }
        /**
        *
        *   管理员对订单评价进行回复
        *   @param $rid  订单id
        *   @param $data 回复信息
        *
        *
        **/
        public function postReplycomment(Request $request)
        {
          //获取订单id
          $rid = $request->input('rid');

          $data = $request->except('_token');

          $data['uid'] = session('id');

          $data['date'] = time();

          $res = DB::table('reply')->insert($data);

          if($res){

            $boolean = DB::table('orders')->where('id',$rid)->update(['state'=>4]);

            return redirect('/admin/orderreply')->with('success','恭喜您评论成功');
          }else{
            return back()->withInput()->with('error','恭喜您评论成功');
          }

        }

        /**
        *
        *   删除评论
        *
        *
        **/

        public function getCommentdelete(Request $request)
        {
          //获取订单ID
          $id = $request->input('id');

          $res = DB::table('orders')->where('id',$id)->first();

          //当状态为3时,删除用户评价
          if($res->state==3){

            $boolean = DB::table('comment')->where('rid',$id)->delete();

            if($boolean){

              //更改订单权限,使订单失去评价权利
              $aa = DB::table('orders')->where('id',$id)->update(['state'=>5]);
              if($aa){
                return redirect('/admin/orderreply')->with('success','删除成功');
              }else{
                 return back()->withInput()->with('error','删除失败');
              }
              return redirect('/admin/orderreply')->with('success','删除成功');
            }else{
              return back()->withInput()->with('error','删除失败');
            }
          }


          //当状态为4时删除用户和商家评价
          if($res->state==4 || $res->state==5){

            //先删除用户评价
            $boolean = DB::table('comment')->where('rid',$id)->delete();

            if($boolean){

              //删除商家评价
              $bool = DB::table('reply')->where('rid',$id)->delete();

              if($bool){

                //更改订单权限,使订单失去评价权利
                $aa = DB::table('orders')->where('id',$id)->update(['state'=>5]);
                if($aa){
                  return redirect('/admin/orderreply')->with('success','删除成功');
                }else{
                   return back()->withInput()->with('error','删除失败');
                }
              }else{
                return back()->withInput()->with('error','删除失败');
              }
            }else{
              return back()->withInput()->with('error','删除失败');
            }
          }
        }

       /**
       *
       *  进入用户添加页面
       *  @return 返回视图
       */
       public function getUseradd()
       {
          return view('/admin/useradd');
       }

      /**
      *
      * 执行用户添加
      * @return 成功重定向到用户列表 失败返回上一层
      */
       public function postUserinsert(Request $request)
       {

        $data = $request->except('_token');
          
        $data['password'] = Hash::make($data['password']);  

        $uid = DB::table('user')->insertGetId($data);

        $res = DB::table('userinfor')->insert(['phone'=>$data['phone'],'uid'=>$uid]);
        if($res){
            return redirect('admin/userlist')->with('success','用户添加成功');
        }else{
            return back()->withInput()->with('error','用户添加失败');
        }
       }


   public function postComment(Request $request)
   {
          //获取订单id
          $rid = $request->input('rid');

          $data = $request->except('_token');

          $data['uid'] = session('id');

          $data['date'] = time();

          $res = DB::table('reply')->insert($data);

          if($res){

            $boolean = DB::table('orders')->where('id',$rid)->update(['state'=>4]);

            return redirect('/admin/orderreply')->with('success','恭喜您评论成功');
          }else{
            return back()->withInput()->with('error','恭喜您评论成功');
          }
   }

   /**
   *
   *  用户列表
   *  @return 返回userinfor全部信息 
   */
   public function getUserlist(Request $request)
   {  
      $num = $request->input('num',10);

      if($request->key){
        $users = DB::table('user')  
          ->join('userinfor','user.id','=','userinfor.uid')
          ->where('nikename','like','%'.$request->key.'%')
          ->orderby('user.id')
          ->paginate($num);
      
      }else{
          $users = DB::table('user')
          ->join('userinfor','user.id','=','userinfor.uid')
          ->orderby('user.id')
          ->paginate($num);
      }
      $all = $request->all();
      //解析模版
      return view('/admin/userlist',['users'=>$users,'all'=>$all]);
   }
   /**
   *
   *  执行用户删除
   *  @return 返回布尔行
   */
   public function getDel(Request $request)
   {
   		$uid = $request->input('id');
      // dd($uid);
   		$res = DB::table('userinfor')->where('uid',$uid)->delete();
      $data = DB::table('user')->where('id',$uid)->delete();
       if($res)
        {
            return redirect('admin/userlist')->with('success','用户删除成功');
        }else{
            return back()->withInpot->with('error','用户删除失败');
        }
   }

   /**
   *
   *  用户修改页面
   *  @return 返回userinfor信息
   */
   public function getUserupdate(Request $request)
   {
   		$id = $request->input('id');
   		$users = DB::table('userinfor')->where('id', $id)->first();
   		// dd($users);
   		// return view('/admin/userupdate');
   		//解析模版
   		return view('/admin/userupdate',['users'=>$users]);
	}

	/**
  *
  *  执行用户修改
  *  @return 返回布尔型
  */
	public function postUseredit(Request $request)
	{

		$data = $request->except('_token','id');
    $id = $request->input('id');
    // dd($id);
		$data['pic'] = $this::upload($request);

		$res = DB::table('userinfor')->where('id',$id)->update($data);

		if($res){
		    return redirect('admin/userlist')->with('success','用户修改成功');
		}else{
		    return back()->withInput()->with('error','用户修改失败');
		}
	}

	/**
  *
  *  处理图片上传
  *   @return 返回修改后的图片名字和路径
  */
 public function upload($request)
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
   *  商家列表  
   *  @return 返回shop表全部信息插入视图
   */
   public function getShoplist(Request $request)
   {
      //搜索
      $num = $request->input('num',5);

      if($request->keyword){
        $res=DB::table('shop')
            ->where('shopname','like','%'.$request->keyword.'%')
            ->orderby('shop.id')
            ->where('status',1)
            ->paginate($num);
      }else{
       //每页取多少条(分页)
        $res=DB::table('shop')
              ->orderby('shop.id')
              ->where('status',1)
              ->paginate($num);
      }
        //获取所有的请求参数
      $all=$request->all();

       //返回模板
        return view('/admin/shoplist',['res'=>$res,'all'=>$all]);
   }

   /**
   *
   *  商家下线 修改商家状态
   *  @return 返回布尔值
   */
   public function getShopdel(Request $request)
   {
    $id = $request->input('id');
    $res = DB::table('shop')->where('id',$id)->update(['status'=>1]);

    if($res){
       return back()->withInput()->with('success','已下线成功');
    }else{
       return back()->withInput()->with('error','下线失败');
    }

   }

   /**
   *
   *  商家上线 修改商家状态
   *  @return 返回布尔值
   */
   public function getShopup(Request $request)
   {
      $id = $request->input('id');
    $res = DB::table('shop')->where('id',$id)->update(['status'=>2]);

    if($res){
       return back()->withInput()->with('success','上线成功');
    }else{
       return back()->withInput()->with('error','上线失败');
    }

   }

   /**
   *
   *  修改商家页面
   *  @return 返回shop信息 插入视图
   */
   public function getShopupdate(Request $request)
   {
    $id = $request->input('id');
    $res = DB::table('shop')->where('id',$id)->first();
    return view('/admin/shopupdate',['res'=>$res]);
   }

   /**
   *
   *  执行商家修改
   *  @return 返回布尔值
   */
   public function postShopedit(Request $request)
   {  
    // dd($request->all());
    $res = $request->except('_token','id');
    //调用图片上传方法
     if($request->hasFile('pic')){
       $res['pic'] = $this->upload($request);
     }// dd($kao);
    // dd($res['pic']);
    $id = $request->input('id');
    // dd($id);
    $boolean = DB::table('shop')->where('id',$id)->update($res);
    // dd($boolean);
    if($boolean){
      return redirect('/admin/shoplist')->with('success','修改成功');
    }else{
      return redirect('/admin/shoplist')->with('error','修改失败');
    }
   }
   /**
   *
   *  下线商家列表 
   *  @return 返回shop信息 插入视图
   */
   public function getShopdrop(Request $request)
   {
   		//搜索
      $num = $request->input('num',5);

      if($request->keyword){
          $res=DB::table('shop')
                  ->where('shopname','like','%'.$request->keyword.'%')
                  ->orderby('shop.id')
                  ->where('status',2)
                  ->paginate($num);
      }else{

        $res=DB::table('shop')
                  ->where('status',2)
                  ->orderby('shop.id')
                  ->paginate($num);
      }
        //获取所有的请求参数
      $all=$request->all();

       //返回模板
       return view('/admin/shopdrop',['res'=>$res,'all'=>$all]);
   }
 
   /**
   *
   *  删除商家
   *  @return 返回布尔值
   */
   public function getShopdelete(Request $request)
   {
     $id = $request->input('id');
     $res = DB::table('shop')->where('id',$id)->delete();
     if($res){
       return redirect('/admin/shopdrop')->with('success','删除成功');
     }else{
       return redirect('/admin/shopdrop')->with('error','删除失败');
     }
   }

   /**
   *
   *  查看商家菜品
   *  @return 返回food 信息 插入模版
   */
   public function getShopfood(Request $request)
   {
      $id = $request->input('id');

      $request->session()->put('foodid',$id);
      $num = $request->input('num',5);
      $keyword = $request->keyword;
      // dd($keyword);
      if($keyword){
        $res = DB::table('food')
               ->join('cate','food.lei','=','cate.id')
               ->where('foodname','like','%'.$request->keyword.'%')
               ->where('sta',1)
               ->where('food.sid',$id)
               ->select('food.*','cate.title')
               ->paginate($num);
         // dd($res);
      }else{
       //每页取多少条(分页)
        $res = DB::table('food')
               ->join('cate','food.lei','=','cate.id')
               ->where('food.sid',$id)
               ->where('sta',1)
               ->select('food.*','cate.title')
               ->paginate($num);
               // dd($res); 
      }
        //获取所有的请求参数
      $all=$request->all();
      // dd($all);
       //返回模板
      return view('/admin/shopfood',['res'=>$res,'all'=>$all,'keyword'=>$keyword]);
   }
   
   /**
   *  
   *  显示网站修改页面
   *  @return 返回sec信息 插入视图
   */
   public function getSec()
   {
   	  $res = DB::table('sec')->first();
      if($res){
        return view('/admin/sec',['res'=>$res]);
      }else{
        return view('/admin/sec');
      }
      
   }

   /**
   *
   *  执行网站配置修改
   *  @return 返回布尔型
   */
   public function postEntsec(Request $request)
   {
   	  $data = $request->except('_token');
   	  // dd($data);
   	  if($request->hasFile('pic')){
       $data['pic'] = $this->upload($request);
      }// dd($kao);
   	  // dd($data);
   	  $res = DB::table('sec')->update($data);
   	  if($res){
   	  	return redirect('/admin/sec')->with('success','修改成功');
   	  }else{
   	  	return back()->withInput()->with('error','修改失败');
   	  }
   }

   /**
   *
   * 友情链接添加页面
   *  @return 返回视图
   */
   public function getYouqing()
   {
   		return view('/admin/youqingadd');
   }

   /**
   *
   *  执行友情链接添加
   *  @return 返回布尔型
   */
   public function postYouqingadd(Request $request)
   {

   		$data = $request->except('_token');

   		$res = DB::table('youqing')->insert($data);

   		if($res){
   			return redirect('/admin/youqinglist')->with('success','添加友情链接成功');
   		}else{
   			return back()->withInput()->with('error','添加友情链接失败');
   		}
   }

   /**
   *
   *  友情链接列表
   *  @return 返回youqing表信息 插入视图
   */
   public function getYouqinglist(Request $request)
   {	
    $num = $request->input('num',10);
    $keyword = $request->keyword;
    // dd($keyword);
    if($keyword){
      $res = DB::table('youqing')
             ->where('yname','like','%'.$request->keyword.'%')
             ->paginate($num);
       // dd($res);
    }else{
     //每页取多少条(分页)
      $res = DB::table('youqing')->paginate($num);
             // dd($res); 
    }
      //获取所有的请求参数
    $all=$request->all();
    // dd($all);
     //返回模板
    return view('/admin/youqinglist',['res'=>$res,'all'=>$all,'keyword'=>$keyword]);
   }

   /**
   *
   *  显示友情链接修改页面
   *   @return 返回youqing表信息 插入视图
   */
   public function getYouqingup(Request $request)
   {
      // dd($request->all());
      $id = $request->input('id');
      $res = DB::table('youqing')->where('id',$id)->first();
      // dd($res);
      return view('/admin/youqingupdate',['res'=>$res]);

   }

   /**
   *
   *  执行友情链接修改
   *  @return 返回布尔值
   */
   public function postYouqingupdate(Request $request)
   {
      // dd($request->all());
      $data = $request->except('_token');
      // dd($data['id']);
      $res = DB::table('youqing')->where('id',$data['id'])->update($data);
      // dd($res);
      if($res){
          return redirect('/admin/youqinglist')->with('success','修改成功');
      } else{
          return back()->withInput()->with('error','修改失败');
      }
   }

   /**
    *
    * 执行友情链接删除
    * @return 返回布尔值
    */
   public function getYouqingdel(Request $request)
   {
      // dd($request->all());
      $id = $request->input('id');
      $res = DB::table('youqing')->where('id',$id)->delete();
      // dd($res);
      if($res){
        return redirect('/admin/youqinglist')->with('success','删除成功');
      }else{
        return back()->withInput()->with('error','删除失败');
      }
   }

   /**
   *
   *  管理员修改个人信息页面
   *  @return 返回userinfor信息 插入视图
   */
   public function getAdminuser(Request $request)
   {
      $id = $request->input('id');
      $res = DB::table('userinfor')->where('uid',$id)->first();
      if($res){
        return view('/admin/adminupdate',['res'=>$res]);
      }
   }

   /**
   *
   *  执行管理员信息修改
   *  @return 返回布尔值
   */
   public function postAdminupdate(Request $request)
   {
      $data = $request->except('_token','id');
      $id = $request->input('id');

      if($request->hasFile('pic')){
         $data['pic'] = $this->upload($request);
      }
      $res = DB::table('userinfor')->where('uid',$id)->update($data);
      if($res){
        return redirect('/admin/index')->with('success','修改成功');
      }else{
        return back()->withInput()->with('error','修改失败');
      }
   }

   /**
   *
   *  退出登录
   *  @return 清空session 并 返回到登录页面
   */
  public function getOut(Request $request)
    {    
        $request->session()->flush('id','name');

        return redirect('/admin/login');
    }
}
