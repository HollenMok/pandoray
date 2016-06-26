<?php
/**
 *@desc interface for syncing product data 
 *@author mohuahuan     
 *@date 2016/06/18
 */

class AdminInterfaceController extends AdminController{
    
    public function __construct(){
        
        $act = $_GET['act'];
        if(isset($act)&&$act==1){
            $result = Product::getAtrributes();
            echo json_encode($result);exit;
        }else{
            $check = $_GET['check'];
            if($check==1){
                $key = Product::getProductList();
                echo json_encode($key);exit;
            }else{
                $productList_json = $this->testAction();
                $productList_arr = json_decode($productList_json);
                echo "<pre>";print_r($productList_arr); exit;
            }
        }
             
    }
    /**
     * @desc get product data list by interface 
     * @author mohuahuan 2016/06/18
     */
    public function testAction(){
        $url = $_SERVER[HTTP_HOST]."/yun/index.php?controller=AdminInterface&check=1";
	    $curl = curl_init();  // 启动一个CURL会话
	    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
	    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
	    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
	
	    $tmpInfo = curl_exec($curl); // 执行操作
	    if (curl_errno($curl)) {
	        echo 'Errno'.curl_error($curl);//捕抓异常
	    }
	    curl_close($curl); // 关闭CURL会话
	    return $tmpInfo; // 返回数据  
    }
}
