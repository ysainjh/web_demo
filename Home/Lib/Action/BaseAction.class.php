<?php

// 本类由系统自动生成，仅供测试用途
class BaseAction extends Action {

    public function _initialize(){
        $systemConfig = include WEB_ROOT . 'Common/systemConfig.php';
        $this->assign("site", $systemConfig);
    }

    public function _empty($name){
        //把所有城市的操作解析到city方法
        echo '404';
    }

    public function getAd($pname=''){
        $m_ad=M('ad');
        $mname=strtolower(MODULE_NAME);
        $aname=strtolower(ACTION_NAME);
        $map['lang']=LANG_SET;
        if($mname=='index' && $aname=='index'){
            $map['position']='index';
        }else{
            switch($mname){
                case 'news':
                    $map['position']=array(array('eq','news'),array('eq','all'),'or');
                    break;
                case 'product':
                    $map['position']=array(array('eq','product'),array('eq','all'),'or');
                    break;
                case 'message':
                    $map['position']=array(array('eq','message'),array('eq','all'),'or');
                    break;
                case 'page':
                    if($pname)
                    $map['position']=array(array('eq',$pname),array('eq','all'),'or');
                    break;
                default:
                    $map['position']='all';
                    break;
            }
        }
        $info=$m_ad->where($map)->order('sort DESC')->select();
        return $info;
    }
    /**
     * 验证码
     */
    public function verify_code() {
        $w = isset($_GET['w']) ? (int) $_GET['w'] : 50;
        $h = isset($_GET['h']) ? (int) $_GET['h'] : 30;
        import("ORG.Util.Image");
        Image::buildImageVerify(4, 1, 'png', $w, $h);
    }

}