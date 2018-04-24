<?php  
namespace app\user\controller;
/**
* 
*/
class Common extends \think\Controller
{
	
	public function _initialize(){
		if(!session('?name')){
			$this->error('您还没有登录','login/login');
		}
		$ncate_id=input('cate_id');
		$keywords=input('goods_keywords');
		$o=db('shopcart')->where('shop_uid',session('user_id'))->select();
		$num=0;
		foreach($o as $a)
		{
           $num++;
		}
		$this->assign('shopn',$num);
		$this->assign('ncate_id',$ncate_id);
		$this->assign('keywords',$keywords);
	}
}
?>