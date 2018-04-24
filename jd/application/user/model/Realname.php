<?php  
namespace app\user\model;
/**
* 城市模型
*/
class Realname extends \think\Model
{
	protected $resultSetType = 'collection';
	public function user(){
		return $this->hasOne('User');
	}
}
?>