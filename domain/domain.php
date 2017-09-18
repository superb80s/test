<?php

// 词根
//$arr = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
//$arr = [0,1,2,3,4,5,6,7,8,9];
//$arr = [1,3,4,5,6,8,9];
//$num = 6;//所需使用词根的数量
//$res = array(); //结果集
//arrangement($arr, $num);//进行排列运算
//var_export(count($res));//输出排列结果
//die;
//$data = [];
for ($i=1; $i<=999999;$i++) {
    $num = str_pad($i, 6, 0, STR_PAD_LEFT);
    $num = checkNum($num);
    if (!$num) {
        continue;
    }
    $data[] = $num;

}

function checkNum($num){
    $len = strlen($num);
    $data = [];
    for ($i = 0; $i < $len; $i++) {
        if (isset($data[$num[$i]])) {
            $data[$num[$i]] += $data[$num[$i]];
        } else {
            $data[$num[$i]] = 1;
        }
    }
    sort($data);
    $max = array_pop($data);
    if ($max >= 2) {
        return $num;
    } else {
        return 0;
    }
}

var_dump(count($data));die;
file_put_contents('list_number6', implode("\n", $data));die;

$files = [
            "number6aa","number6ab","number6ac","number6ad","number6ae","number6af",
            "number6ag","number6ah"
        ];

foreach ($files as $file) {
    $pid = pcntl_fork();

    if ($pid == -1) {
         die('could not fork');
    } elseif ($pid == 0) {
        $filePath = "./number6/$file";
        work($filePath);
        exit; 
    } elseif ($pid > 0) {
    }
}

function work($filePath){
    echo $filePath . "\n";die;
    $domain = new Domain();
    $domain->xxxFromFile($filePath, $log = 'number-6.log');
}
die;

$domain = new Domain();
//$domain->numLetterNum();
//$domain->number5();
$domain->xxxFromFile('number5aa', $log = 'number-5.log');
die;
//$domain->numberWord('vv');
class Domain
{
    public $letters = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];

    public $file = 'domain.log';

    public $res = [];

    private function setLogFile($file)
    {
        $this->file = $file;
    }

    public function xxxFromFile($file, $log = 'h.log')
    {
        $this->setLogFile($log);
        $ext = '.com';

        $fp = fopen($file,'r');
        while (!feof($fp)) {
            $v = trim(fgets($fp));
            $domain = $v . $ext;
            //echo $domain . "_";
            $this->curl($domain);
        }
        fclose($fp);
    }

    public function number5()
    {
        $this->setLogFile('number-5.log');
        $ext = '.com';
        $arr = [9,8,7,6,5,3,2,1,0];
        $num = 5;//所需使用词根的数量
        $this->res = [];
        $this->arrangement($arr, $num);//进行排列运算
        file_put_contents('list_number5', implode("\n", $this->res));die;
        echo count($this->res);die;
        foreach ($this->res as $v) {
            $domain = $v . $ext;
            echo $domain . "_";
            $this->curl($domain);
        }
    }
    public function number6()
    {
        $this->setLogFile('number-6.log');
        $ext = '.com';
        $arr = [9,8,7,6,5,4,3,2,1];
        $num = 6;//所需使用词根的数量
        $this->res = [];
        $this->arrangement($arr, $num);//进行排列运算
        $data = [];
        foreach ($this->res as $v) {
            if ($v > 499999 && $v < 900000) {
                $data[] = $v;
            }
        }

        file_put_contents('list_number6', implode("\n", $data));die;
        echo count($data);die;


        file_put_contents('list_number6', implode("\n", $this->res));die;
        //echo count($this->res);die;
        foreach ($this->res as $v) {
            $domain = $v . $ext;
            echo $domain . "_";
            $this->curl($domain);
        }
    }

    public function numberWord($word)
    {
        $ext = '.com';
        $this->setLogFile("number{$word}.log");
        $arr = [9,8,7,6,5,3,2,1,0];
        $num = 2;//所需使用词根的数量
        $res = array(); //结果集
        //arrangement($arr, $num);//进行排列运算
        $this->arrangement($arr, $num);//进行排列运算
        //var_export(count($this->res));die;
        foreach ($this->res as $v) {
            $domain = $v . $word . $ext;
            echo $domain . "_";
            $this->curl($domain);
        }

    }

    public function xxWord($word)
    {
        $ext = '.com';
        $this->setLogFile("xx{$word}.log");
        $arr = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
        $num = 3;//所需使用词根的数量
        $res = array(); //结果集
        //arrangement($arr, $num);//进行排列运算
        $this->arrangement($arr, $num);//进行排列运算
        var_export(count($this->res));die;
        foreach ($this->res as $v) {
            $domain = $v . $word . $ext;
            echo $domain . "_";
            $this->curl($domain);
        }

    }

    public function numLetterNum()
    {

        $this->setLogFile('num-letter-num.log');
        $ext = '.com';

        $sum = 0;
        for ($i = 0; $i <=9; $i++) {
            foreach ($this->letters as $v) {
                for ($j = 0; $j <=9; $j++) {
                   // echo $i . $v . $j . "_";
                    $domain = $i . $v . $j . $ext;
                    $this->curl($domain);
                    $sum++;
                }
            }
        }
        echo $sum;

    }

    public function arrangement($arr, $len=0, $str="") {
        $arr_len = count($arr);
        if($len == 0){
            $this->res[] = $str;
        }else{
            for($i=0; $i<$arr_len; $i++){
                $tmp = array_shift($arr);
                //arrangement($arr, $len-1, $str."\t".$tmp);
                $this->arrangement($arr, $len-1, $str.$tmp);
                array_push($arr, $tmp);
            }
        }
    }

    public function curl($domain)
    {
        $url = 'http://panda.www.net.cn/cgi-bin/check.cgi?area_domain=' . $domain;

        $ch = curl_init();         
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);         
        curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)");         
        //curl_setopt($ch,CURLOPT_COOKIE,$HTTP_SESSION);         
        $res = curl_exec($ch);         
        curl_close ($ch);
        $xmlObj = @simplexml_load_string($res);

        $this->log($domain, $xmlObj);
        return $xmlObj;
    }

    private function log($domain, $xmlObj)
    {
        //var_export(stripos($xmlObj->original, '211')!== false);die;
        if (isset($xmlObj->original) && stripos($xmlObj->original, '210') !== false) {
            file_put_contents($this->file, $domain . "\n", FILE_APPEND);
            echo $domain . "_";
            //die;
        }
    }

}




function number6()
{

}

function letter3()
{
    $fp = fopen("./3letter.txt",'r');
    while (!feof($fp)) {
        $letter = trim(fgets($fp));
        echo $letter . "_";
        makeLetterDomain($letter, $ext = '.cc');
    }
    fclose($fp);
    die;
}

//http://panda.www.net.cn/cgi-bin/check.cgi?area_domain=v12308.com
//
function makeLetterDomain($letter = "abc", $ext = '.cc')
{
     $domain = $letter;
     $domain .= $ext;

     $xmlObj = curl($domain);
     //var_export(stripos($xmlObj->original, '211')!== false);die;
     if (isset($xmlObj->original) && stripos($xmlObj->original, '210') !== false) {
         $file =  "xxbaby.txt";
         file_put_contents($file, $domain . "\n", FILE_APPEND);
         //echo $domain . "_";
         //die;
     }
}

/**
 * 排列枚举算法
 */
function arrangement($arr, $len=0, $str="") {
	global $res;
	$arr_len = count($arr);
	if($len == 0){
		$res[] = $str;
	}else{
		for($i=0; $i<$arr_len; $i++){
			$tmp = array_shift($arr);
			//arrangement($arr, $len-1, $str."\t".$tmp);
			arrangement($arr, $len-1, $str.$tmp);
			array_push($arr, $tmp);
		}
	}
}

/**
 * 组合枚举算法
 */
function combination($arr, $len=0, $str="") {
	global $res;
	$arr_len = count($arr);
	if($len == 0){
		$res[] = $str;
	}else{
		for($i=0; $i<$arr_len-$len+1; $i++){
			$tmp = array_shift($arr);
			//combination($arr, $len-1, $str."\t".$tmp);
			combination($arr, $len-1, $str.$tmp);
		}
	}
}


function getLetter($len)
{
    $letter = "abcdefghijklmnopqrstuvwxyz";
    for ($i = 0; $i < strlen($letter); $i++) {
    }
}

$letter = "abcdefghijklmnopqrstuvwxyz";

//makeLetterNumberDomain($letter, $min = 0, $max = 99, $len = 2, $ext = ".cc");

function makeLetterNumberDomain($letter = 'v', $min = 9000, $max = 9999, $len = 4, $ext = ".com")
{
    for ($i = 0; $i < strlen($letter); $i++) {
        for ($j = $min; $j <= $max; $j++) {

            $domain = $letter[$i];
            $number = str_pad($j, $len, '0', STR_PAD_LEFT);
            $domain .= $number;
            $domain .= $ext;

            $xmlObj = curl($domain);
            //var_export(stripos($xmlObj->original, '211')!== false);die;
            if (isset($xmlObj->original) && stripos($xmlObj->original, '210') !== false) {
                $file = $letter . substr($number, 0, 1) . "-" . $len . ".txt";
                file_put_contents($file, $domain . "\n", FILE_APPEND);
                echo $domain . "_";
                //die;
            }
        }

    }
}

function curl($domain){
    $url = 'http://panda.www.net.cn/cgi-bin/check.cgi?area_domain=' . $domain;

    $ch = curl_init();         
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);         
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)");         
    //curl_setopt($ch,CURLOPT_COOKIE,$HTTP_SESSION);         
    $res = curl_exec($ch);         
    curl_close ($ch);
    $xmlObj = @simplexml_load_string($res);
    return $xmlObj;
}
