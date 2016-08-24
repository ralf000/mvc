<?php

require __DIR__ . '/autoload.php';

$result = app\DB::query("SELECT * FROM foo");
app\helpers\Helper::g($result);