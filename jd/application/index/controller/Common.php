<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
class Common extends Controller
{
	public function _initialize(){
		$ncate_id=input('cate_id');
		$keywords=input('goods_keywords');
		
		//dump($ncate_id);
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