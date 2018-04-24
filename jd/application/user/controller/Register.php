<?php  
namespace app\user\controller;

/**
* 用户注册的控制器
*/
class Register extends \think\Controller
{
	
	public function register()
	{
		/*显示用户注册界面的方法*/
		return view();
	}

	public function registerhanddle()
	{
		/*处理用户提交注册请求的方法*/
		$post = request()->post();
		if($post['passwordRepeat']==$post['user_password'])
		{
			$post['user_password'] = md5($post['user_password']);
			unset($post['passwordRepeat']);
		    $user_register_result = db('user')->insert($post);
	    }
	    else
         {
         	$this->error('密码不一致','register/register');
         }
		if ($user_register_result) {
			$this->active($post['user_email']);
			$this->success('恭喜你注册成功','user/login/login');
		}
		else{
			$this->error('注册失败，请重新注册');
		}
	}

	public function registerhanddle1()
	{
		/*处理用户提交注册请求的方法*/

		$post = request()->post();
		if(!preg_match("/^([0-9]{11})$/", $post['user_phone']))
			$this->error('手机号格式不正确！','register/register');
         if($post['passwordRepeat1']==$post['user_password1'])
		{
		$post['user_password'] = md5($post['user_password1']);
		unset($post['user_password1']);
		unset($post['passwordRepeat1']);
		$user_register_result = db('user')->insert($post);
	}
	 else
         {
         	$this->error('密码不一致','register/register');
         }

		if ($user_register_result) {
			$this->success('恭喜你注册成功','index/index/index');
		}
		else{
			$this->error('注册失败，请重新注册');
		}
	}

	public function checkusername()
	{
		/*使用Ajax对用户注册时邮箱是否已经存在进行验证*/
		if (request()->isAjax()) {
			//如果是Ajax请求
			$post = request()->post();
			$user_email = $post['param'];
			$user_email_find = db('user')->where('user_email','eq',$user_email)->find();
			//查看传递过来的邮箱地址是否存在
			if ($user_email_find) {
				return ['status'=>'n','info'=>'该邮箱已经被注册'];
			}
			else {
				return ['status'=>'y','info'=>'该邮箱可以使用'];
			}
		}
	}
	public function checkusername1()
	{
		/*使用Ajax对用户注册时手机是否已经存在进行验证*/
		if (request()->isAjax()) {
			//如果是Ajax请求
			$post = request()->post();
			$user_email = $post['param'];
			$user_email_find = db('user')->where('user_phone','eq',$user_email)->find();
			//查看传递过来的邮箱地址是否存在
			if ($user_email_find) {
				return ['status'=>'n','info'=>'该手机已经被注册'];
			}
			else {
				return ['status'=>'y','info'=>'该手机可以使用'];
			}
		}
	}

	public function sendMobileCode()
	/*用户获取验证码的方法*/
	{
		if (request()->isAjax()) {
			$post = request()->post();
			$num = $post['num'];
			SendMessage($num);
		}
	}

	public function checkmobilenum()
	/*验证验证码是否有效*/
	{
		if (request()->isAjax()) {
			$post = request()->post();
			$code = $post['param'];
			if ($code==session('mobilenum')) {
				return ['status'=>'y','info'=>'验证码正确'];
			}
			else{
				return ['status'=>'n','info'=>'验证码错误'];
			}
		}
	}
	public function active($user_email)
	{
		$title = '特食尚';  //标题
		$address = url('user/register/active1',array('user_email'=>$user_email));
		$address = urldecode($address);
		$content = '请访问以下地址进行激活http://localhost'.$address;
		//邮件内容
		SendMail($user_email,$title,$content); //直接调用发送即可
	}

	public function active1($user_email)
	{
		$user_email_find = db('user')->where('user_email','eq',$user_email)->find();
		if ($user_email_find) {
			if ($user_email_find['user_email_active']=='1') {
				$this->error('该邮箱已经激活，请重新登录','user/login/login');
			}
			else{
				db('user')->update(['user_email_active'=>'1','user_id'=>$user_email_find['user_id']]);
				$this->success('该邮箱被成功激活，请登录','user/login/login');
			}
		}
		else{
			$this->redirect('index/index/index');
		}
	}
}
?>