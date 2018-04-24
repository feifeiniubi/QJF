<?php
namespace app\user\controller;

// use alidayu\TopClient;
// use alidayu\AlibabaAliqinFcSmsNumSendRequest;

class Index extends Common
{
	public function index()
	/*个人中心首页*/
	{
		$coll=db('coll')->where('col_uid',session('user_id'))->limit(8)->select();
		$week=array("日","一","二","三","四","五","六");
		   $t['year']=date('Y-m');
		    $t['day']=date('d');
		     $t['week']="星期".$week[date('w')];

		 $order=db('order')->where('user_id',session('user_id'))->select();
		 $s=array(0,0,0,0);
		 foreach($order as $o)
		 {
		 	if($o['order_status']==1)
		 		$s[0]++;
		 	if($o['order_status']==2)
		 		$s[1]++;
		 	if($o['order_status']==3)
		 		$s[2]++;
		 	if($o['order_status']==4)
		 		$s[3]++;
		 }
		     $this->assign('day',$t);
		 $this->assign('order',$s);
        $this->assign('coll',$coll);
		return view();
	}
}
