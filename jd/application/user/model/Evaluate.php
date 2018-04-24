<?php  
namespace app\user\model;
/**
* 具体评论内容模型模型
*/
class Evaluate extends \think\Model
{
	protected $resultSetType = 'collection';
	public function address()
	/*具体评论内容和评论的多对一关系*/
	{
		return $this->belongsTo('Commentlist');
	}

	public function goods()
	/*具体评论内容和商品的多对一关系*/
	{
		return $this->belongsTo('app\admin\model\Goods');
	}

	public function ordergoods()
	/*具体评论和订单的多对一关系*/
	{
		return $this->belongsTo('Ordergoods');
	}

	public function user()
	/*具体评论和用户的多对一关系*/
	{
		return $this->belongsTo('User');
	}
	public function admin()
	/*具体评论和管理员的多对一关系*/
	{
		return $this->belongsTo('app\admin\model\Admin');
	}
}
?>