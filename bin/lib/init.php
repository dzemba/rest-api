<?php

error_reporting(E_ALL);

foreach (glob("bin/lib/*.php") as $file){ 
	require_once($file);
}

?>