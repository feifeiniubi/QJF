<?php  
namespace app\user\model;
/**
* 用户模型
*/
class User extends \think\Model
{
	protected $resultSetType = 'collection';

	public function address()
	/*用户和地址的一对多关系*/
	{
		return $this->hasMany('Address');
	}

	public function shop()
	/*用户和购物车的一对多关系*/
	{
		return $this->hasMany('Shop');
	}
	public function coll()
	/*用户和收藏的一对多关系*/
	{
		return $this->hasMany('Coll','col_uid');
	}
	public function order()
	/*用户和订单的一对多关系*/
	{
		return $this->hasMany('Order');
	}
	public function question()
	
	{
		return $this->hasMany('Question');
	}
		public function realname()

	{
		return $this->hasOne('Realname');
	}

	public function evaluate()
	/*用户和商品评论的一对多关系*/
	{
		return $this->hasMany('Evaluate');
	}
	public function notice()
	{
		return $this->hasMany('Evaluate')->where('eva_status',-1)->order('eva_rtime desc');
	}
}
?>