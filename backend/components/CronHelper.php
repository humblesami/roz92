<?php
namespace backend\components;

class CronHelper {

    function is_process_running($PID)
    {
        exec("ps $PID", $ProcessState);
        return(count($ProcessState) >= 2);
    }

    
}