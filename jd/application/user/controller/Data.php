<?php  
namespace app\user\controller;
/**
* 
*/
class Data extends Common
{
	public function address() //地址
	{
		$a=model('address');
		$ad=$a->where('user_id',session('user_id'))->select();
		$add=$ad->toArray();
		$this->assign(array('address'=>$add));
		  if(request()->isPost())
         {
             $post=input('post.');
             $post['user_id']=session('user_id');
             if($a->save($post))
             	$this->success('添加成功！','data/address');
             else
             	$this->error('添加失败！','data/address');
         }
		return view();
	}
	public function setaddress($address_id='')
	{
		$data=db('address')->where('address_id',$address_id)->find();
	    return $data;
	}
	public function setd($address_id='')
	{
        $a=model('address');
		if($ad=$a->where('user_id',session('user_id'))->where('address_default',1)->find())
		{$add=$ad->toArray();
		$add['address_default']=0;
		$a->update($add);}
		$a1=$a->get($address_id);
		$ad1=$a1->toArray();
		$ad1['address_default']=1;
		$a->update($ad1);
		$this->redirect('data/address');
	}
	public function del($address_id='')
	{
       $a=model('address');
       $a->destroy($address_id);
       $this->redirect('data/address');
	}
	public function editaddress($address_id='') //编辑地址
	{
		 $a=model('address');
       $ad=$a->get($address_id);
       $add=$ad->toArray();
        $this->assign(array('address'=>$add));
         if(request()->isPost())
         {
             $post=input('post.');
             dump($post);
            $post['address_id']=$address_id;
              if($a->update($post))
             	$this->success('编辑成功！','data/address');
             else
             	$this->error('编辑失败！','data/address');
         }
		return view();
	}
	public function information() //个人资料
	{
		$u=model('user');
		$us=$u->get(session('user_id'));
		$use=$us->toArray();
		$ad=$us->address;
		$add=$ad->toArray();
			$use['score']=0;
		if($use['user_password'])
		{
			$use['score']+=20;
		}
		unset($use['user_password']);
	
        $r=$us->realname;
		$re=$r->toArray();
		if($re['real_code'])
		{
			$use['score']+=30;
		}
		if($use['user_email']&&$use['user_email_active'])
		{
			$use['score']+=20;
		}
		if($use['user_phone'])
		{
			$use['score']+=30;
		}
		foreach($add as $a)
		{
            if($a['address_default']==1)
            {
            	$use['provice']=$a['user_address_province'];
            	$use['city']=$a['user_address_city'];
            	$use['district']=$a['user_address_district'];
            	$use['detail']=$a['user_address_detail'];
            	$use['name']=$a['user_address_name'];
            }
		}
        $this->assign(array('user'=>$use));
        if(request()->isPost())
        {
             $post=input('post.');
             $post['user_id']=session('user_id');
             if($us->update($post))
             	$this->success('修改成功！','data/information');
             else
             	$this->error('修改失败！','data/information');

        }
		return view();
	}
	public function safety() //安全信息
	{
		$u=model('user');
		$us=$u->get(session('user_id'));
		$use=$us->toArray();
		$r=$us->realname;
		$re=$r->toArray();
		$use['score']=0;
		if($re['real_code'])
		{
			$use['realname']=1;
			$use['score']+=30;
		}
		else 
			$use['realname']=0;
		if($use['user_email']&&$use['user_email_active'])
		{
			$use['score']+=20;
		}
		if($use['user_phone'])
		{
			$use['score']+=30;
		}
		if($use['user_password'])
		{
			$use['score']+=20;
		}
		unset($use['user_password']);
		 $this->assign(array('user'=>$use));
		return view();
	}
	public function password()
	/*用户修改密码的方法*/
	{
		 if(request()->isPost())
        {
             $post=input('post.');
             $u=model('user');
             $us=$u->get(session('user_id'));
             $use=$us->toArray();
             $post['user_old_password'] = md5($post['user_old_password']);
             if($post['user_old_password']==$use['user_password'])
             {
             	unset($post['user_old_password']);
                   if($post['user_password']==$post['user_password1'])
                   {
                   	    unset($post['user_password1']);
                   	    $post['user_password']=md5($post['user_password']);
                   	    $post['user_id']=session('user_id');
                   	    if($us->update($post))
                   	    	$this->success('修改成功！','data/safety');
                   	    else
                   	    	$this->error('修改失败！','data/password');
                   }
                   else
                   	$this->error('密码不一致！','data/password');
             }
              else
              	$this->error('原密码不正确！','data/password');
         }
		return view();
	}
	public function sendMessage()
	/*发送短信验证码的方法*/
	{
		if (request()->isAjax()) {
			$post = request()->post();
			$num = $post['num'];
			SendMessage($num);
		}
	}

	public function checkCode()
	/*验证验证码的方法*/
	{
		if (request()->isAjax()) {
			$post = request()->post();
			$num = $post['name'];
			$code = $post['param'];
			if (cookie((string)$num)==$code) {
				return ['status'=>'y','info'=>'验证码正确'];
			}
			else{
				return ['status'=>'n','info'=>'验证码错误'];
			}
		}
	}
	public function bindphone2()
	/*用户没有绑定手机时新绑定手机的方法*/
	{
		$user_phone_find = db('user')->find(session('user_id'));
		unset($user_phone_find['user_password']);
		return view();
	}

	public function bindphone2handdle()
	{
		$post = request()->post();
		$user_phone_find = db('user')->where('user_phone','eq',$post['user_phone'])->find();
		if ($user_phone_find) {
			$this->error('该手机已经被注册，请更换绑定的手机号码');
		}
		if ($post['user_code']==cookie((string)$post['user_phone'])) {
			$data = array();
			$data['user_phone'] = $post['user_phone'];
			$data['user_id'] = session('user_id');
			db('user')->update($data);
			$this->success('验证码正确，手机绑定成功');
		}
		else{
			$this->error('验证码错误');
		}
	}
	public function bindphone1(){
		$user_information_find = db('user')->find(session('user_id'));
		unset($user_information_find['user_password']);
		$this->assign('user',$user_information_find);
		 if(request()->isPost())
        {
             $post=input('post.');
             if ($post['user_code']==cookie((string)$post['user_phone'])) {
			$data = array();
			$data['user_phone'] = $post['user_phone'];
			$data['user_id'] = session('user_id');
			db('user')->update($data);
			$this->success('验证码正确，手机绑定成功');
		}
         }
		return view();
	}
	public function idcard()
	{
		 if(request()->isPost())
        {
             $post=input('post.');
             $post['user_id']=session('user_id');
		   $r=model('realname');
		   if($r->save($post))
		   	$this->success('实名认证成功','data/safety');
        }
		return view();
	}
	public function email()
	{
		$use=db('user')->field('user_email')->find(session('user_id'));
		$this->assign('user',$use['user_email']);
		 if(request()->isPost())
        {
             $post=input('post.');
             $post['user_id']=session('user_id');
             $post['user_email_active']=0;
             db('user')->update($post);
              if($this->active($post['user_email']))
              	$this->success('验证发送成功，请登录邮箱验证','data/safety');
              else
              	$this->error('验证发送失败','data/safety');
         }
		return view();
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
}
?>