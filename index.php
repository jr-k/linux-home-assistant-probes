<?php

function get_server_cpu_usage(){
    $cpu = file_get_contents('/home/cpuload');
    return round($cpu);
}

function get_server_memory_usage(){
    $free = shell_exec('free');
    $free = (string)trim($free);
    $free_arr = explode("\n", $free);
    $mem = explode(" ", $free_arr[1]);
    $mem = array_filter($mem);
    $mem = array_merge($mem);
    $memory_usage = ($mem[2]/$mem[1])*100;
    return round($memory_usage).'%';
}

function get_server_storage_usage() {
    $df = shell_exec('df');
    $df = (string)trim($df);
    $df_arr = explode("\n", $df);
    $storage = explode(" ", $df_arr[1]);
    return $storage[12];
}

function get_server_temperature() {
    $tp = shell_exec('cat /sys/class/thermal/thermal_zone0/temp');
    return round($tp*0.001).'°C';
}

Header('Content-Type: application/json');

$response = array(
        'cpu' => get_server_cpu_usage(),
        'ram' => get_server_memory_usage(),
        'disk' => get_server_storage_usage(),
        'temp' => get_server_temperature()
);

echo json_encode($response);
