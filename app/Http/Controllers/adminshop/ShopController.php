<?php

namespace App\Http\Controllers\adminshop;
use DB;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{	
   /**
   *
   *  显示未接订单
   *  @return 通过orders表关联查询 插入视图
   */
   public function getIndex(Request $request)
   {  
      $num = $request->input('num',5);
      $keyword = $request->input('keyword');
      $id = Session::get('sid'); 
      if($request->keyword){
          $res = DB::table('shop')
                ->select('orders.*','address.shname','address.shphone','address.shaddress')
                ->join('orders','orders.sid','=','shop.id')
                ->join('address','address.id','=','orders.pid')
                ->where('shop.uid',$id)
                ->where('state',2)
                ->where('orders.id','like','%'.$request->keyword.'%')
                ->paginate($num);
      }else{
          $res = DB::table('shop')
                ->select('orders.*','address.shname','address.shphone','address.shaddress')
                ->join('orders','orders.sid','=','shop.id')
                ->join('address','address.id','=','orders.pid')
                ->where('shop.uid',$id)
                ->where('state',2)
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
        return view('/adminshop/index',['res'=>$res,'aa'=>$aa,'all'=>$all,'keyword'=>$keyword]);

   }




   /**
   *
   *  当商家名下没有店铺就创建
   *  @return 返回布尔型
   */
   public function postShopest(Request $request)
   {
      $data = $request->except('_token','uid');
      $data['pic'] = $this->upload($request);
      $data['uid'] = session('sid');
      $res = DB::table('shop')->insert($data);
      if($res){
         return redirect('/adminshop/index');
      }else{
         return back()->withInput()->with('error','创建失败');
      }
      
   }


   /**
   *
   *  接单
   *  @return 修改orders 表 状态state
   */
   public function postOres(Request $request)
   {
         $state = $request->input('state');
         $id = $request->input('id');

         $res = DB::table('orders')->where('id',$id)->update(['state'=>1]);




   }

   /**
   *
   *  查询orders 表 关联查询 并且状态state为1
   *  @return 返回数据插入视图
   */
   public function getToday(Request $request)
   {
      $num = $request->input('num',5);
      $keyword = $request->input('keyword');
      $id = Session::get('sid'); 
      if($request->keyword){
          $res = DB::table('shop')
                ->select('orders.*','address.shname','address.shphone','address.shaddress')
                ->join('orders','orders.sid','=','shop.id')
                ->join('address','address.id','=','orders.pid')
                ->where('shop.uid',$id)
                ->where('state',1)
                ->where('orders.id','like','%'.$request->keyword.'%')
                ->orderby('orders.id','desc')
                ->paginate($num);
      }else{
          $res = DB::table('shop')
                ->select('orders.*','address.shname','address.shphone','address.shaddress')
                ->join('orders','orders.sid','=','shop.id')
                ->join('address','address.id','=','orders.pid')
                ->where('shop.uid',$id)
                ->where('state',1)
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
        return view('/adminshop/today',['res'=>$res,'aa'=>$aa,'all'=>$all,'keyword'=>$keyword]);

   }


   /**
   *
   *  查询orders 表 关联查询 并且状态state为0
   *  @return 返回数据插入视图
   */
   public function getOrdercomment(Request $request)
   {
      $num = $request->input('num',5);
      $keyword = $request->input('keyword');
      $id = Session::get('sid'); 
      if($request->keyword){
          $res = DB::table('shop')
                ->select('orders.*','address.shname','address.shphone','address.shaddress')
                ->join('orders','orders.sid','=','shop.id')
                ->join('address','address.id','=','orders.pid')
                ->where('state',3)
                ->orwhere('state',4)
                ->where('shop.uid',$id)
                ->where('orders.id','like','%'.$request->keyword.'%')
                ->orderby('orders.id','desc')
                ->paginate($num);
      }else{
          $res = DB::table('shop')
                ->select('orders.*','address.shname','address.shphone','address.shaddress')
                ->join('orders','orders.sid','=','shop.id')
                ->join('address','address.id','=','orders.pid')
                ->where('state',3)
                ->orwhere('state',4)
                ->where('shop.uid',$id)
                ->orderby('orders.id','desc')
                ->paginate($num);
                   
      }
      //获取所有的请求参数
      $all=$request->all();

      $aa = [];
      $ff = [];
      $data = [];
      foreach($res as $k=>$v){
        $rid = $v->id;

        //查询订单菜品信息
        $bb = DB::table('corders')
               ->join('food','food.id','=','corders.cid')
               ->where('rid',$rid)
               ->get();
        
        //查询订单评价信息
        $cc = DB::table('comment')
                ->join('userinfor','userinfor.uid','=','comment.uid')
                ->where('rid',$rid)
                ->first();

         
        //查询订单回复信息
        $dd = DB::table('reply')
                  ->join('orders','orders.id','=','reply.rid')
                  ->join('userinfor','userinfor.uid','=','reply.uid') 
                  ->where('reply.uid',session('sid'))
                  ->where('rid',$rid)
                  ->get();
        $aa[] = $bb;
        $data[] = $cc;          
        $ff[] = $dd;

       }
        return view('/adminshop/ordercomment',['res'=>$res,'aa'=>$aa,'all'=>$all,'data'=>$data,'ff'=>$ff]);
}


        
           /**
           *
           *  查询orders 表 关联查询 并且状态state为0
           *  @return 返回数据插入视图
           */
           public function getOrderreply(Request $request)
           {
              $num = $request->input('num',5);
              $keyword = $request->input('keyword');
              $id = Session::get('sid'); 
              if($request->keyword){
                  $res = DB::table('shop')
                        ->select('orders.*','address.shname','address.shphone','address.shaddress')
                        ->join('orders','orders.sid','=','shop.id')
                        ->join('address','address.id','=','orders.pid')
                        ->where('shop.uid',$id)
                        ->where('state',3)
                        ->where('orders.id','like','%'.$request->keyword.'%')
                        ->paginate($num);
              }else{
                  $res = DB::table('shop')
                        ->select('orders.*','address.shname','address.shphone','address.shaddress')
                        ->join('orders','orders.sid','=','shop.id')
                        ->join('address','address.id','=','orders.pid')
                        ->where('shop.uid',$id)
                        ->where('state',3)
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

                $cc = DB::table('comment')
                        ->join('userinfor','userinfor.uid','=','comment.uid')
                        ->where('rid',$rid)
                        ->first();

                $data[] = $cc; 
              }
             
                return view('/adminshop/orderreply',['res'=>$res,'aa'=>$aa,'all'=>$all,'data'=>$data]);
        }
       /**
         *
         *  查询orders 表 关联查询 并且状态state为0
         *  @return 返回数据插入视图
         */
         public function getOrders(Request $request)
         {
            $num = $request->input('num',5);

            if($request->keyword){
                $res = DB::table('shop')
                      ->select('orders.*','address.shname','address.shphone','address.shaddress')
                      ->join('orders','orders.sid','=','shop.id')
                      ->join('address','address.id','=','orders.pid')
                      ->where('shop.uid',session('sid'))
                      ->where('orders.id','like','%'.$request->keyword.'%')
                      ->orderby('orders.id','desc')
                      ->paginate($num);
            }else{
                $res = DB::table('shop')
                      ->select('orders.*','address.shname','address.shphone','address.shaddress')
                      ->join('orders','orders.sid','=','shop.id')
                      ->join('address','address.id','=','orders.pid')
                      ->where('shop.uid',session('sid'))
                      ->orderby('orders.id','desc')
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
            }

              return view('/adminshop/orders',['res'=>$res,'aa'=>$aa,'all'=>$all,'data'=>$data]);
      }
      

       /**
      *
      *
      *   评论回复
      *   @param int $rid 订单id
      *   @param array $data 获取评论参数
      *
      **/
      public function postReply(Request $request)
      {
          //获取订单id
          $rid = $request->input('rid');

          $data = $request->except('_token');

          $data['uid'] = session('sid');

          $data['date'] = time();

          $res = DB::table('reply')->insert($data);

          if($res){

            $boolean = DB::table('orders')->where('id',$rid)->update(['state'=>4]);

            return redirect('/adminshop/ordercomment')->with('success','恭喜您评论成功');
          }else{
            return back()->withInput()->with('error','恭喜您评论成功');
          }

      }


   /**
   *
   *  菜品添加页面
   *  @return 返回cate类别 插入视图
   */
   public function getFoodadd(Request $request)
   {  
      $data = DB::table('cate')->where('uid',session('sid'))->get();  

      if($data){
         return view('/adminshop/foodadd',['res'=>$data]);
      }else{
         return redirect('/adminshop/foodclass');
      }
   }

   /**
   *
   *  执行菜品添加
   *  @return 返回布尔型
   */
   public function postFoodinsert(Request $request)
   {
      $data = $request->except("_token"); 


      //调用图片上传方法
      $data['pic'] = $this->upload($request);
        
      $aa = DB::table('shop')->where('uid',session('sid'))->get();
      $data['sid'] = $aa[0]->id;
      //执行添加操作
     $res = DB::table('food')->insert($data);

     if($res){
        return redirect('/adminshop/foodlist');
     }else{
        return back()->withInput()->with('error','添加失败');
     }
   }
   /**
   *
   *  添加分类页面
   *  @return 查询cate表数据 插入视图
   */
   public function getFoodclass(Request $request){

      $res = DB::table('cate')->where('uid',session('sid'))->get();

      return view('/adminshop/foodaddclass',['res'=>$res]);
   }

   /**
   *
   *  执行分类添加
   *  @return 返回布尔值
   */                                                  
   public function postAddclass(Request $request)
   {
       //提取数据
        $title = $request->input('title');
        $pid = $request->input('pid');

        if($pid == 0){
            $path = '0';
        }else{
            //获取父级path信息
            $res = DB::table('cate')->where('id',$pid)->where('uid',session('sid'))->first();
            $path = $res->path.','.$pid;
        }


        //执行数据插入
        $res = DB::table('cate')->where('uid',session('sid'))->insert(['pid'=>$pid,'title'=>$title,'path'=>$path,'uid'=>session('sid')]);
        
        //判断分类是否添加成功
        if($res){
           return redirect('/adminshop/foodadd'); 
        }else{
           return back()->withInput()->with('error','添加失败');
        }
   }

   /**
   *
   *  删除分类页面
   *  @return 返回视图
   */
   public function getFoodclassdel(Request $request)
   {
      $res = DB::table('cate')->where('uid',session('sid'))->get();

      return view('/adminshop/fooddelclass',['res'=>$res]);
   } 



   /**
   *
   *    执行修改分类
   *
   *
   **/
  public function getFoodclassupdate(Request $request)
   { 
      $id = $request->input('id');

      $aa = DB::table('food')->where('lei',$id)->get();

      if(empty($aa)){
        $res = DB::table('cate')->where('id',$id)->first();

        if($res){
          return view('/adminshop/foodclassedit',['res'=>$res])->with('success','修改成功');
        }else{
          return redirect('/adminshop/foodclassdel')->with('error','修改失败');
        }
      }else{
         return  redirect('/adminshop/foodclassdel')->with('error','本类有菜品不能修改');
      }
      
   }


   /**
   *
   *  执行分类添加
   *  @return 返回布尔值
   */                                                  
   public function postFoodclassedits(Request $request)
   {
       //提取数据
        $title = $request->input('title');
        $titles = $request->input('titles');

        //获取父级path信息
        $res = DB::table('cate')->where('uid',session('sid'))->where('title',$titles)->update(['title'=>$title]);
      
        //判断分类是否修改成功
        if($res){
           return redirect('/adminshop/foodclassdel'); 
        }else{
           return back()->withInput()->with('error','添加失败');
        }
   }

   /**
   *
   *    执行删除分类
   *
   *
   **/
  public function getFoodclassdelete(Request $request)
   { 
      $id = $request->input('id');

      $aa = DB::table('food')->where('lei',$id)->get();

      if(empty($aa)){
        $res = DB::table('cate')->where('id',$id)->delete();

        if($res){
          return back()->withInput()->with('success','删除成功');
        }else{
          return back()->withInput()->with('error','删除失败');
        }
      }else{
        return  back()->withInput()->with('error','本类有菜品不能删除');
      }
      
   }

   /**
   *
   *  修改菜品页面
   *  @return 返回food和cate表数据 插入视图
   */
   public function getUpdatefood(Request $request)
   {
      $id = $request->input('id');


      $data = DB::table('food')
            ->where('id','=',$id)
            ->first();

      //查出cate表
      $cate = DB::table('cate')->where('uid',session('sid'))->get();

      //注：参数2的cate代表cate表中数据,data代表这个菜品的信息
      if($data){
         return view('/adminshop/foodupdate',['res'=>$data,'cate'=>$cate]);
      }else{
         return view('/adminshop/foodupdate',['res'=>false,'cate'=>$cate]);
      }
   }



   /**
   *
   *  执行菜品修改
   *  @return 返回布尔值
   */
   public function postFoodupdate(Request $request)
   {
      $data = $request->except("_token");
      // dd($data);  
      $sid = $request->input('sid');
      $pic = $request->input('pic');
      $id = $request->input('id');
      $lei = $request->input('lei');
      // dd($data);
      //判断传图片了
      if($data['pic'] = $this->upload($request)){ 
      }else{
         $data['pic'] = $pic;
      }

      // dd($data);
      //执行添加操作
      $res = DB::table('food')
                  ->where('id','=',$id)
                  ->update($data);

      if($res){
         return redirect('/adminshop/foodlist?id='.$sid)->with('success','修改成功');
     }else{
        return back()->withInput()->with('error','修改失败');
      }
   }


   /**
   *
   *  处理图片上传
   *  @return 返回处理后的图片名和路径
   */
    public function upload($request)
   {
      //判断是否有文件上传
      if($request->hasFile('pic')){
         //随机文件名
         $name = md5(time()+rand(1,9999));
         //获取文件的扩展名
         $suffix = $request->file('pic')->getClientOriginalExtension();
         $arr = ['png','jpeg','gif','jpg'];
         if(!in_array($suffix,$arr)){
             return back()->with('error','上传文件格式不正确');
         }
         $request->file('pic')->move('./upload/',$name.'.'.$suffix);
         //返回路径信息
         return '/upload/'.$name.'.'.$suffix;
       }else{
         return false;
      }
   }

   /**
   *
   *  菜品列表
   *  @return 返回关联数据 插入视图
   */
   public function getFoodlist(Request $request)
   {  
      $num = $request->input('num',5);

      $aa = DB::table('shop')->where('uid',session('sid'))->get();

      //获取本商铺id
      $sid = $aa[0]->id;

      if($request->keyword){

        $res = DB::table('food')
               ->join('cate','food.lei','=','cate.id')
               ->where('foodname','like','%'.$request->keyword.'%')
               ->where('food.sid',$sid)
               ->select('food.*','cate.title')
               ->paginate($num);
      }else{

        $res = DB::table('food')
               ->join('cate','food.lei','=','cate.id')
               ->where('food.sid',$sid)
               ->select('food.*','cate.title')
               ->paginate($num);
      }

      //获取所有的请求参数
      $all=$request->all();
      //返回模板
      return view('/adminshop/foodlist',['res'=>$res,'all'=>$all]);
   } 

   /**
   *
   *  菜品回收站
   *  @return 返回关联数据 插入视图
   */
   public function getFoodrecyle(Request $request)
   {
   	$num = $request->input('num',5);

    $aa = DB::table('shop')->where('uid',session('sid'))->get();

    if($request->keyword){
      $res = DB::table('food')
             ->join('cate','food.lei','=','cate.id')
             ->where('foodname','like','%'.$request->keyword.'%')
             ->where('food.sid',$aa[0]->id)
             ->where('sta',1)
             ->select('food.*','cate.title')
             ->paginate($num);
    }else{
      $res = DB::table('food')
             ->join('cate','food.lei','=','cate.id')
             ->where('food.sid',$aa[0]->id)
             ->where('sta',1)
             ->select('food.*','cate.title')
             ->paginate($num);
    }

   		$all=$request->all();

      return view('/adminshop/foodrecyle',['res'=>$res,'all'=>$all]);
   }


   /**
   *
   *  删除回收站菜品
   *  @return 返回布尔值
   */
   public function getShopdel(Request $request)
   {
      $id = $request->input('id');
      $res = DB::table('food')->where('id',$id)->where('sta',0)->delete();
      // dd($res);
      if($res){
         return back()->withInput()->with('success','删除成功');
      }else{
         return back()->withInput()->with('error','删除失败');
      }
   }

   /**
   *
   *  执行修改店铺
   *  @return 返回布尔值
   */
   public function postShopupdate(Request $request)
   { 
      $kao = $request->except('_token','id');

      if($request->hasFile('pic')){

     	 $kao['pic'] = $this->upload($request);

      }

      $res = DB::table('shop')->where('uid',session('sid'))->update($kao);
      if($res){
         return redirect('/adminshop/shoplist');
      }else{
        return back()->withInput()->with('error','修改失败');
      }
   }



    /**
    *
    *  修改店铺信息页面
    *   @return 返回shop表数据 插入视图
    */
   public function getShopadd(Request $request)
   {  
       //通过id查询本店信息
        $res = DB::table('shop')->where('uid',session('sid'))->first();


        return view('adminshop/shopadd',['res'=>$res]);
   }


   /**
   *
   *  店铺信息页面
   *  @return 返回shop表数据 插入视图
   */
   public function getShoplist(Request $request)
   {  

      $res = DB::table('shop')->where('uid',session('sid'))->get();

      if($res){
         return view('/adminshop/shoplist',['res'=>$res]);
      }else{
         return view('/adminshop/shoplist');
      }
   }


   /**
   *
   *  下线菜品
   *  @return 返回布尔型
   */
   public function getShopxia(Request $request)
   {
   		$id = $request->input('id');

   		$res = DB::table('food')->where('id',$id)->update(['sta'=>0]);

   		if($res){
   			return back()->withInput()->with('success','下线成功');
   		}else{
   			return back()->withInput()->with('error','下线失败');
   		}
   }

   /**
   *
   *  上线菜品
   *  @return 返回布尔型
   */
   public function getShopshang(Request $request)
   {
   		$id = $request->input('id');

   		$res = DB::table('food')->where('id',$id)->update(['sta'=>1]);

   		if($res){
   			return back()->withInput()->with('success','上线成功');
   		}else{
   			return back()->withInput()->with('error','上线失败');
   		}

   }

   /**
   *
   *  执行删除菜品
   *  @return 返回布尔值
   */
   public function getDelete(Request $request)
   {
      $id = $request->all()['id'];

      //执行删除
      $res = DB::table('food')->where('id','=',$id)->delete();
      if($res){
         return redirect('/adminshop/foodlist')->with('success','删除菜品成功');
      }else{
         return back()->withIput()->with('error','删除菜品失败');
      }
   }

   /**
   *
   *  店主信息修改页面
   *  @return 返回userinfor表数据 插入视图
   */
   public function getShopuser(Request $request)
   {
      $id = $request->input('id');

      $res = DB::table('userinfor')->where('uid',$id)->first();

      return view('/adminshop/shopuserupdate',['res'=>$res]);
   }

   /**
   *
   *  执行店主信息修改
   *  @return 返回布尔值
   */
   public function postShopuserupdate(Request $request)
   {
      $data = $request->except('_token','id');
      $id = $request->input('id');
       if($request->hasFile('pic')){
          $data['pic'] = $this->upload($request);
       }

       $res = DB::table('userinfor')->where('uid',$id)->update($data);
       if($res){
         return redirect('/adminshop/index')->with('success','修改成功');
       }else{
         return back()->withInput()->with('error','修改失败');
       }
   }


   /**
   *
   *  退出并清除session
   *  @return 返回登陆页面
   */
   public function getOut(Request $request)
   {    
   		$request->session()->flush('id','name');

   		return redirect('/admins/login');
   }


}