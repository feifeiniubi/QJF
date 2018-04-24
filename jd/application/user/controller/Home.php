<?php  
namespace app\user\controller;
/**
* 
*/
class Home extends Common
{
	public function collection()  //收藏
	{
		$u=model('user');
		$us=$u->get(session('user_id'));
		$c=$us->coll;
        $co=$c->toArray();
        $this->assign('coll',$co);
		return view();
	}
	public function addc($goods_id='')
	{
		$c['col_uid']=session('user_id');
		$c['col_gid']=$goods_id;
		
		if(db('collection')->insert($c))
			$this->success('收藏添加成功');
		else
			$this->error('收藏添加失败');

	}
	public function delc($col_id)
	{
         db('collection')->delete($col_id);
         $this->redirect('home/collection');
	}
	public function comment() //评价
	{
		return view();
	}
	public function commentlist()//评价列表
	{
		$u=model('user');
		$us=$u->get(session('user_id'));
		$o=$us->order;
		foreach($us['order'] as &$o)
		{$o->ordergoods;
		foreach ($o['ordergoods'] as &$g)
		{
			$g->goods;
			
		}
	}
	$or=$us->toArray();
		 $this->assign('order_get_toArray',$or['order']);
		return view();
	}
	public function news() // 消息
	{
		$u=model('user');
		$us=$u->get(session('user_id'));
		$us->notice;
		foreach($us['notice'] as &$n)
		{
			
            $n['goods']=$n->ordergoods->goods;
            $n['order']=$n['ordergoods']->order;
            unset($n['ordergoods']);
		}
		$use=$us->toArray();
          $mes=db('message')->where('mes_type',2)->order('mes_time desc')->field('mes_id,mes_title,mes_contant,mes_link,mes_time')->select();
         
		 $this->assign('notice',$use['notice']);
		  $this->assign('mes',$mes);
		return view();
	}
}
?>