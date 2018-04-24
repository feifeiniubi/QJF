<?php
namespace app\index\controller;
//商城首页


class Index extends Common
{
    
    public function index()
    {
      if (isset($_GET['code']))
      {
        $weixin=new WXlogin("wx06a87a5af0b56bfc", "555eef5b0543df377b4d2a60c10f7e81");
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=appid&secret=secret&code=".$_GET['code']."&grant_type=authorization_code";
        $res = $weixin->https_request($url);
        $res=(json_decode($res, true));
        $row=$weixin->get_user_info($res['openid']);
        if ($row['openid']) {
          //这里写上逻辑,存入cookie,数据库等操作
          cookie('weixin',$row['openid'],25920);
        }
        else{
          $this->error('授权出错,请重新授权!');
        }
      }
        
    	$cate = db('cate')->where('cate_type',0)->order('cate_sort')->select();
        //dump($cate);
        $cate1 = db('cate')->where('cate_pid',0)->where('cate_type',0)->order('cate_sort')->limit(10)->select();
        //dump($cate1);
        foreach($cate1 as $key=>&$c)
        {
            
            $ca = db('cate')->where('cate_pid',$c['cate_id'])->where('cate_type',0)->order('cate_sort')->select();
            //dump($ca);
            foreach($ca as &$c1)
            {

                $cb = db('cate')->where('cate_pid',$c1['cate_id'])->where('cate_type',0)->order('cate_sort')->select();
                //dump($cb);
                foreach($cb as &$c2)
                {
                    $cc = db('goods')->where('goods_pid',$c2['cate_id'])->order('goods_id')->where('goods_status',2)
                    ->where('goods_top',2)->select();
                    foreach($cc as &$c3)
                    {
                        $c["goods"][]=$c3;
                    }
                }
            }
            //dump($c["goods"]);die;
            if(isset($c["goods"]))
            {
                foreach($c["goods"] as $k=>$g)
                {
                    if($k>7)
                        unset($c['goods'][$k]);
                }
            }
            else
                $c["goods"]="";
           
        }
        //dump($cate1);die;

        //首页商品推荐个数问题
        /*$getc=model('Cate');
        
        foreach($cate1 as $cat1)
        {
            
            $abc=$getc->Gchilrenid($cate,$cat1['cate_id']);
            
            $c1=implode(',',$abc);       
            dump($c1);
        }*/
       //dump($abc);die;
       

        /*$cate2 = db('cate')->where('cate_pid','in',$c1)->where('cate_type',0)->order('cate_sort')->select();
        //dump($cate2);die;
        foreach($cate2 as $cat2)
        {
            $ca2[]=$cat2['cate_id'];
        }
        //dump($ca2);
        $c2=implode(',',$ca2);
        //dump($c2);die;
        $cate3 = db('cate')->where('cate_pid','in',$c2)->where('cate_type',0)->order('cate_sort')->select();
        //dump($cate3);die;
        foreach($cate3 as $cat3)
        {
            $ca3[]=$cat3['cate_id'];
        }
        //dump($ca3);
        $c3=implode(',',$ca3);
        //dump($c3);die;*/
    	$goods = db('goods')->where('goods_status',2)->where('goods_top',2)->order('goods_pid')->select();
        //dump($goods);die;
    	$base = db('base')->where('base_top',1)->order('base_id')->limit(4)->select();
    	//dump($base);
        $img = db('img')->where('img_bid',0)->order('img_id')->select();
        $mes=db('message')->where('mes_type',2)->order('mes_time desc')->field('mes_id,mes_title,mes_contant,mes_link')->limit(5)->select();
        //dump($img);
    	//$cate_model = model('cate');
    	//$cate_list = $cate_model->getChildren($cate_select);
    	$this->assign('cate',$cate);
        $this->assign('mes',$mes);
        $this->assign('cate1',$cate1);
    	$this->assign('goods',$goods);
    	$this->assign('base',$base);
        $this->assign('img',$img);
        return view();
    }

}
