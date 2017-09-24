<?php
$value = config('app.timezone');

config(['app.timezone' => 'Asia/Manila']);

echo date();
?>