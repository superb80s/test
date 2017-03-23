<?php


//注意文件的编码格式需要保存为为UTF-8格式
require ( "sphinxapi.php" );

$cl = new SphinxClient ();
$cl->SetServer ( '127.0.0.1', 9312);
//以下设置用于返回数组形式的结果
$cl->SetArrayResult ( true );

/*
//ID的过滤
$cl->SetIDRange(3,4);

//sql_attr_uint等类型的属性字段，需要使用setFilter过滤，类似SQL的WHERE group_id=2
$cl->setFilter('group_id',array(2));

//sql_attr_uint等类型的属性字段，也可以设置过滤范围，类似SQL的WHERE group_id2>=6 AND group_id2<=8
$cl->SetFilterRange('group_id2',6,8);
*/

//取从头开始的前20条数据，0,20类似SQl语句的LIMIT 0,20
$cl->SetLimits(0,20);

//在做索引时，没有进行 sql_attr_类型 设置的字段，可以作为“搜索字符串”，进行全文搜索
$res = $cl->Query ( '搜索字符串', "*" );    //"*"表示在所有索引里面同时搜索，"索引名称（例如test或者test,test2）"则表示搜索指定的

//如果需要搜索指定全文字段的内容，可以使用扩展匹配模式：
//$cl->SetMatchMode(SPH_MATCH_EXTENDED);
//$res=cl->Query( '@title (测试)' , "*");
//$res=cl->Query( '@title (测试) @content ('网络')' , "*");


echo '<pre>';
print_r($res['matches']);
print_r($res);
print_r($cl->GetLastError());
print_r($cl->GetLastWarning());
echo '</pre>';






	






























	


