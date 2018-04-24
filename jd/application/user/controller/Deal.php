<?php  
namespace app\user\controller;
/**
* 
*/
class Deal extends Common
{
	public function change() //售后
	{
		return view();
	}
	public function logistics() //物流
	{
		return view();
	}
	public function order() //订单
	{
		
		$or=db('order')->where('user_id',session('user_id'))->order('order_time desc')->select();
        foreach($or as $key=>&$o)
        {
            $o['ordergoods']=db('order_goods')->where('order_id',$o['order_id'])->select();
             $p=0;
        foreach ($o['ordergoods'] as $o1) {
            if($o1['goods_after_price']!=0)
            $p+=$o1['goods_after_price']*$o1['goods_num'];
        else
            $p+=$o1['goods_price']*$o1['goods_num'];
        }
        $o['order_price']=$p;
        if($o['ordergoods']==null)
            unset($or[$key]);
        }
       
        
		$this->assign('arr',$or);
		return view();
	}

    public function delorder($order_id='')
    /*订单删除的方法*/
    {
        $order_model = model('order');
        $order_get = $order_model->get($order_id);
        $o=$order_get->toArray();
        if(empty($order_get)){
            $this->redirect('order');
        }
        if($o['order_status']==1)
        $order_get->save(['order_status'=>-1]);
    else
        $this->error('无法取消该订单','order');
        $this->redirect('order');
    }
	public function pay($goods_id='',$num=1) //订单生成
	{
	    $add=db('address')->where('user_id',session('user_id'))->where('address_default',1)->find();
        $goods[]=db('goods')->find($goods_id);
        if($goods[0]['goods_after_price']!=0)
        $all=$num*$goods[0]['goods_after_price'];
    else
        $all=$num*$goods[0]['goods_price'];
        $goods[0]['shop_gnum']=$num;
        $this->assign('add',$add);
         $this->assign('goods',$goods);
         $this->assign('all',$all);
          if(request()->isPost())
         {
             $post=input('post.');
       
             $order['order_address']=$post['order_address'];
             $order['order_remarks']=$post['order_remarks'];
             $order['order_price']=$post['order_price'];
             $order['user_id']=session('user_id');
             $order['order_status']=1;
             $order['order_time']=date('Y-m-d H:i:s');
             db('order')->insert($order);
             if($o=db('order')->where('order_time',$order['order_time'])->find())
           { 
            foreach($post['order_goods'] as $p)
            {
                $good['goods_id']=$p["'goods_id'"];
                $good['goods_num']=$p["'goods_num'"];
                $good['order_id']=$o['order_id'];
                db('ordergoods')->insert($good);
                db('shopcart')->where('shop_gid',$good['goods_id'])->where('shop_uid',session('user_id'))->delete();
            }
            $this->success('订单创建成功','user/deal/order');
          }
          else
                $this->error('订单创建失败');
      
         
        }
		return view();
	}
    public function orderinfo($order_id='')
    /*订单详情*/
    {
        if (empty($order_id)) {
            $this->redirect('order');
        }
        $order_find = db('order')->find($order_id);
        if (empty($order_find)) {
            $this->redirect('order');
        }
        /*$order_model = model('order');
        $order_get = $order_model->get($order_id);
        $order_goods = $order_get->ordergoods()->select();
        $order_goods_toArray = $order_goods->toArray();*/
        //以上四行操作得到的结果和使用db("ordergoods")->where('order_id','eq',$order_id)->select()的结果是一样的。
        //实例化一个订单模型
        $order_model = model('order');
        //获取对应order_id值得订单对象
        $order_get = $order_model->get($order_id);
        //将地址信息写入到订单对象当中
        $order_get->address;
        //将省份信息写入到订单对象的address属性中
        $order_get->ordergoods;
        //定义一个订单总价格
        $total_price = 0;
        //订单和订单商品信息之间是一对多关系，需要循环
        foreach ($order_get['ordergoods'] as $key => $value) {
            //将商品具体信息写入到订单商品对象中去
            $value->goods;
            //将关键字信息写入到商品对象中去；
            $value['goods']->keywords;
            //将value转换为数组，得到商品数量和价格等信息
            $value_toArray = $value->toArray();
            //计算总价格
            if($value_toArray['goods']['goods_after_price']!=0)
            $total_price += $value_toArray['goods_num']*$value_toArray['goods']['goods_after_price'];
        else
             $total_price += $value_toArray['goods_num']*$value_toArray['goods']['goods_price'];
        }
        //将最终得到的订单信息转换为数组
        $order_get_toArray = $order_get->toArray();
        //将价格信息写入到最终得到的订单信息中去
        $order_get_toArray['total_price'] = $total_price;
        // dump($order_get_toArray);
        $this->assign('order_get_toArray',$order_get_toArray);
        return view();
    }
	public function shopcart() //购物车
	{
		$u=model('user');
		$us=$u->get(session('user_id'));
		$s=$us->shop;
		$shop=$s->toArray();
		$this->assign('shop',$shop);
		 if(request()->isPost())
         {
             $post=input('post.');
             if(isset($post['items']))
             {
             	$all=0;
             	foreach($post['items'] as $p)
             {
             	$g=db('shop')->where('user_id',session('user_id'))->where('goods_id',$p)->find();
                if($g['goods_after_price']!=0)
                $all+=$g['shop_gnum']*$g['goods_after_price'];
            else
                 $all+=$g['shop_gnum']*$g['goods_price'];
                $goods[]=$g;
             }
                 $add=db('address')->where('user_id',session('user_id'))->where('address_default',1)->find();
                $this->assign('add',$add);
                $this->assign('goods',$goods);
                $this->assign('all',$all);
                return view('pay');
            }
         }
		return view();
	}
	public function add()//产品中间步骤
	{
		$post=input('post.');
		if($post['button']=='立即购买')
		{
			 $this->redirect('deal/pay',array('goods_id'=>$post['goods_id'],'num'=>$post['num']));
		}
		if($post['button']=='加入购物车')
        { 
        if($shop=db('shopcart')->where('shop_gid',$post['goods_id'])->find())
        {
        	$shop['shop_gnum']+=$post['num'];
        	if(db('shopcart')->update($shop))
        		$this->success('添加成功');
       else
       	$this->error('添加失败');
        }
        else
        {
        $s['shop_uid']=session('user_id');
        $s['shop_gid']=$post['goods_id'];
        $s['shop_gnum']=$post['num'];
        $g=db('goods')->find($post['goods_id']);
        if($g['goods_inventory']<$post['num'])
        	$this->error('商品库存不足！');
        if(db('shopcart')->insert($s))
           $this->success('添加成功');
       else
       	$this->error('添加失败');
   }
   }
	}
	public function shopadd($goods_id='')
	{
         $s=db('shopcart')->where('shop_uid',session('user_id'))->where('shop_gid',$goods_id)->find();
         $sh=db('shop')->where('user_id',session('user_id'))->where('goods_id',$goods_id)->find();
         if($s['shop_gnum']<$sh['goods_inventory'])
         $s['shop_gnum']=$s['shop_gnum']+1;
         db('shopcart')->update($s);
         $this->redirect('deal/shopcart');
	}
	public function shopred($goods_id='')
	{
         $s=db('shopcart')->where('shop_uid',session('user_id'))->where('shop_gid',$goods_id)->find();
         $s['shop_gnum']=$s['shop_gnum']-1;
          if($s['shop_gnum']<=0)
          	db('shopcart')->delete($s['shop_id']);
         db('shopcart')->update($s);

         $this->redirect('deal/shopcart');
	}
	public function shopdel($goods_id='')
	{
         $s=db('shopcart')->where('shop_uid',session('user_id'))->where('shop_gid',$goods_id)->delete();
         $this->redirect('deal/shopcart');
	}
	public function shopdel1()
	{
         $s=db('shopcart')->where('shop_uid',session('user_id'))->delete();
         $this->redirect('deal/shopcart');
	}
    public function receipt($order_id)
    {
          $order_model = model('order');
        $order_get = $order_model->get($order_id);
        if($order_get->save(['order_status'=>4]))
        {
            $this->success('收货成功','order');
        }
        else
            $this->error('收货失败','order');
   }


   public function commentlist($order_id='')
    /*商品评论*/
    {
        $order_model = model('order');
        $order_get = $order_model->get($order_id);
        if(empty($order_get)){
            $this->redirect('order');
        }
        $order_get->ordergoods;
        foreach($order_get['ordergoods'] as $k=>$v){
            $v->goods;
            $v['goods']->keywords;
        }
        $order_get_toArray = $order_get->toArray();
        $this->assign('order_get_toArray',$order_get_toArray);
        return view();
    }
    public function refund($status='',$goods_id='',$order_id=''){  //退货
          if($status==1)
          {
               db('ordergoods')->where('order_id',$order_id)->where('goods_id',$goods_id)->delete();
               if(!db('ordergoods')->where('order_id',$order_id)->find())
                       $this->delorder($order_id);
          }    
          else
          {
              $order_model = model('order');
              $o = $order_model->get($order_id);
              $o->ordergoods;
              foreach ($o['ordergoods'] as $key=>&$g) {
                  if($g['goods_id']==$goods_id)
                  {
                    $o['goods']=$g->goods;
                    $o['goods']['goods_num']=$g['goods_num'];
                     $o['goods']['ordergoods_id']=$g['ordergoods_id'];
                  }
              }
              unset($o['ordergoods']);
              $or=$o->toArray();
             
             $this->assign('order',$or);

             if(request()->isPost())
             {
                $post=input('post.');
               $post['user_id']=session('user_id');
               $post['eva_time']=date('Y-m-d H:i:s');
               $g=new \app\admin\model\Goods();
               $good=$g->get($goods_id);
               $good->base;
               $good['base']->admin;
               $post['admin_id']=$good['base']['admin']['admin_id'];
               /* $goods=$good->toArray();
               dump($post);*/
              if(db('evaluate')->insert($post))
                   $this->success('提交成功','order');
                   else
                    $this->error('提交成功','order');
             }
              return view();
          }
          $this->redirect('order');
    }
}
?>