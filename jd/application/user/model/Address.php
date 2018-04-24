<?php  
namespace app\user\model;
/**
* 用户地址模型
*/
class Address extends \think\Model
{
	protected $resultSetType = 'collection';
	public function user(){
		//商品和分类的多对一关系
		return $this->belongsTo('User');
	}

	public function order()
	/*地址和订单的一对多关系*/
	{
		return $this->hasMany('Order');
	}

	
}
?>