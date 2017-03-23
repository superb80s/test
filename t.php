<?php


class a
{
    private $age = 5;

    public function name()
    {
        var_export($this);
        //(string)$this;
        //var_export((string)$this);
    }

    public function __set($name, $value)
    {
        var_export("$name is not exist". " value=" . $value);
    }
}

$a = new a();
$a->name();
$a->sex = 1;
var_export($a);
die;



class C {
    public function __invoke($name) {
        echo 'Hello ', $name, "\n";
    }
}

$c = new C();
call_user_func($c, 'PHP!');

class MyClass {
    static function myCallbackMethod() {
        echo 'Hello World!';
    }
}

$call = array('MyClass', 'myCallbackMethod');
var_export(is_callable($call)) . "\n";
call_user_func($call);

die;

var_export(is_numeric('12312,123,1232'));die;
$appId = 3174042;
$appSecret = '7ade19cd41b7502576d92a6dd126343f';

//$appId = 3173012;
//$appSecret = '133c62ee140b197d2cfa71171369f365';

$orderId = 678;
$timestamp = time();

$sn = sha1($appId.$orderId.$timestamp.$appSecret);
echo $sn."\n".$timestamp."\n";die;



set_error_handler(array($this,'handleError'),error_reporting());

error_reporting();
restore_error_handler();
restore_exception_handler();

$trace=debug_backtrace();

var_export($trace);
die;
$s = ["1","2","3","4","5","6","7","8","9","10","11","12","13","14"];
var_dump($s);
var_export($s);
print_r($s);

die;

echo 'asdf';

$str = "hello ";

$str = $str . "php";

$ps =  strpos('每天满1个','每天');
var_export($ps!==false);
die;
$money = str_replace(['奖励','元'],'','奖励2元');
$num = str_replace(['满','个'],'','满1个');

echo $num;die;
echo (int)'123我们';
die;

$s = '["1","2","3","4","5","6","7","8","9","10","11","12","13","14"]';
$a = json_decode($s, true);
var_export(implode(',',$a));
die;

try {
    echo $a;
    //throw new Exception('test');
} catch (Exception $e) {

    echo $e->getMessage();

}

die;
if(empty('false')){
    echo 11111;
}

echo (strtotime('20170127') - strtotime('20161019'))/(24*3600);
die;
echo 80483%8;

file_put_contents('asdjflsjf');
echo 13;die;
$abc = 123;
$abc = 123;

function adduser(){
    return true;
}


