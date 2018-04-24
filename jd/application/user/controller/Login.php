<?php  
namespace app\user\controller;

/**
* 用户登录控制器
*/
class Login extends \think\Controller
{
	
	public function login()
	/*用户登录界面显示*/
	{
		return view();
	}

	public function loginhanddle()
	/*用户登录的提交方法*/
	{
		$post = request()->post();
		$name = $post['name'];
		$user_password = md5($post['user_password']);
		$user_find = db('user')->where("user_email ='".$name."' or user_nickname ='".$name."' or user_phone ='".$name."'")->where('user_password','eq',$user_password)->find();
		if(empty($user_find)){ 
			//用户或密码错误的情况
			$this->error('用户或密码错误，请重新登录','user/login/login');
		}
		else if($user_find['user_email_active']=='0'){
			//用户邮箱没有激活的情况
			$this->error('该邮箱并未激活，请登录该邮箱进行激活',url('user/login/active',array('user_email'=>$user_find['user_email'])));
		}
		else{
			//用户邮箱已经激活的情况
			session('user_id',$user_find['user_id']);
			session('name',$user_find['user_nickname']);
			$this->success('登录成功！','index/index');
		}
	}

	public function loginout()
	/*用户登出的方法*/
	{
		session('user_id',null);
		session('name',null);
		$this->redirect('user/login/login');
	}

	public function active($user_email)
	{
		$title = '特食尚';  //标题
		$address = url('user/login/active1',array('user_email'=>$user_email));
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
  public function oauth2(){
   $weixin=new WXlogin("wx06a87a5af0b56bfc", "555eef5b0543df377b4d2a60c10f7e81");
  	$url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx06a87a5af0b56bfc&redirect_uri=http://shop.utbeta.com&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
  vendor('phpqrcode.phpqrcode');
  $object = new \QRcode();
        $level=3;
        $size=4;
        $ad = "code/".str_replace(array("-","-"," ",":"),"",date("Y-m-d")).rand(0,9).rand(0,9).'.png'; 
        $errorCorrectionLevel =intval($level) ;//容错级别
        $matrixPointSize = intval($size);//生成图片大小
        $object->png($url,  $ad, $errorCorrectionLevel, $matrixPointSize, 2);
  
  $this->assign('code',"/public/".$ad);
/*
  vendor('tcpdf.tcpdf'); 
 $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
         $pdf->SetCreator(PDF_CREATOR);
         
          $pdf->SetHeaderData("", 70, 'wanglibao Agreement' . '', '');
         $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
          $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
          $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
         $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
         $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
         $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
         $pdf->AddPage();
         $pdf->setPageMark();
         $pdf->SetFont('stsongstdlight', '', 13);
         $title ='
';
 
         $pdf->writeHTML($title, true, false, false, false, '');
 //         $pdf->writeHTML($content, true, 0, true, true);
 //         $pdf->writeHTMLCell(0, 0, '', '', $content, 0, 1, 0, true, 'C', true);
         $pdf->lastPage();
        
$pdf->Output('D:\phpStudy\WWW\jd\t1.pdf', 'F');*/
  return view('WXlogin');
}

}
?>