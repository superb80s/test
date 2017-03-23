<?php
//echo PHP_OS;

class Signal
{

    public static function shutDownNow()
    {
    }

    public static function shutdown()
    {
    }

    public static function killChild()
    {
    }

    public static function pauseProcessing()
    {
    }

    public static function unPauseProcessing()
    {
    }
}

pcntl_signal(SIGTERM, array('Signal', 'shutDownNow'));
pcntl_signal(SIGINT, array('Signal', 'shutDownNow'));
pcntl_signal(SIGQUIT, array('Signal', 'shutdown'));
pcntl_signal(SIGUSR1, array('Signal', 'killChild'));
pcntl_signal(SIGUSR2, array('Signal', 'pauseProcessing'));
pcntl_signal(SIGCONT, array('Signal', 'unPauseProcessing'));


//$pid = pcntl_fork();
//var_export('pid: '. $pid . "\n");

var_export('---start---: '. getmypid() . "\n");

$i = 1;
while ($i <= 10) {
    echo "times:$i\n";

    $pid = pcntl_fork();
    var_export('pid: '. $pid . "\n");

    $forked = 'Forked ' . $pid . ' at ' . strftime('%F %T');
    $processTitle = 'resque: start';

    if(function_exists('cli_set_process_title') && PHP_OS !== 'Darwin') {
        cli_set_process_title($processTitle);
    } elseif (function_exists('setproctitle')) {
        setproctitle($processTitle);
    }

    if ($pid == -1) {
        //错误处理：创建子进程失败时返回-1.
         die('could not fork');
    } elseif ($pid == 0) {
        var_export('child: '. getmypid() . "\n");
        //子进程执行完毕 结束掉
        exit; 
    } elseif ($pid > 0) {
        var_export('parent: '. getmypid() . "\n");

        var_export("wait: \n");
        pcntl_wait($status);
        var_export("status: " . $status . "\n") ;

        $exitStatus = pcntl_wexitstatus($status);
        var_export("exitStatus: " . $exitStatus . "\n\n") ;

		usleep(1 * 1000000);
    }

    $i++;
}


function test()
{
    for ($i = 0; $i < 2; $i++) {
        $pid  =  pcntl_fork();

        //父进程和子进程都会执行下面代码
        if ($pid == -1) {
            //错误处理：创建子进程失败时返回-1.
            die('could not fork');
        } elseif ($pid > 0) {
            //echo 'before'. PHP_EOL;
            echo "父进程运行:". getmypid().PHP_EOL;
            //父进程会得到子进程号，所以这里是父进程执行的逻辑
            pcntl_wait ($status);//等待子进程中断，防止子进程成为僵尸进程。
            //pcntl_wait ($status, WUNTRACED);//等待子进程中断，防止子进程成为僵尸进程。
            //echo "ok" . PHP_EOL;
        } elseif ($pid == 0) {
            //子进程得到的$pid为0, 所以这里是子进程执行的逻辑。
            echo "子进程运行:". getmypid().PHP_EOL;
            //sleep(3);
            exit;
        }

        //echo "父进程运行". getmypid().PHP_EOL;

    }
}
//test();die;


