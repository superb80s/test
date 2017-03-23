<?php

$i = 1;
while ($i <= 2) {
    echo "times:$i\n";

    $child = pcntl_fork();
    var_export('pid: '. $child . "\n");

    $forked = 'Forked ' . $child . ' at ' . strftime('%F %T');
    $processTitle = 'resque: start';

    //if(function_exists('cli_set_process_title') && PHP_OS !== 'Darwin') {
    //    cli_set_process_title($processTitle);
    //} elseif (function_exists('setproctitle')) {
    //    setproctitle($processTitle);
    //}

    if ($child == -1) {
        //错误处理：创建子进程失败时返回-1.
         die('could not fork');
    } elseif ($child == 0) {
        var_export('child: '. $child . "\n");
    } elseif ($child > 0) {
        var_export("wait: \n");
        pcntl_wait($status);
        var_export("status: " . $status . "\n") ;

        $exitStatus = pcntl_wexitstatus($status);
        var_export("exitStatus: " . $exitStatus . "\n") ;

		usleep(3 * 1000000);
    }

    $i++;
}

