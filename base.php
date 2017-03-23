<?php
/**
 * 基类
 *
 * @param 
 * @return
 */
class Base
{
    public $a = 123;
    public $b = 123;
    private $c = 123;
    protected $d = 123;

    public function getVars()
    {
        $vars = get_class_vars(__CLASS__);
        var_export($vars);
       // var_export(__CLASS__);
    }

    public function access()
    {

        
        $a = 111;
        echo time();
        var_export(123);

        if ($a == true) {

        }

    }

    public function name()
    {

    }

}

$base = new Base();
$base->a = 2222;
$base->getVars();

var_export(get_class_vars(get_class($base)));


