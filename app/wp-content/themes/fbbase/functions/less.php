<?php
/*
 * Compilar LESS y Bootsrap
 */
include TEMPLATEPATH . '/lessphp/lessc.inc.php';
function autoCompileLess($inputFile, $outputFile) {
	// load the cache
	$cacheFile = $inputFile.".cache";

	if (file_exists($cacheFile)) {
	  $cache = unserialize(file_get_contents($cacheFile));
	} else {
	  $cache = $inputFile;
	}

	$less = new lessc;
	$newCache = $less->cachedCompile($cache);

	if (!is_array($cache) || $newCache["updated"] > $cache["updated"]) {
	  file_put_contents($cacheFile, serialize($newCache));
	  file_put_contents($outputFile, $newCache['compiled']);
	}
}
/*$inputFile = TEMPLATEPATH."/less/main.less";
$outputFile = TEMPLATEPATH."/css/main.css";
autoCompileLess($inputFile, $outputFile);*/
$inputFile2 = TEMPLATEPATH."/less/bootstrap.less";
$outputFile2 = TEMPLATEPATH."/css/bootstrap.css";
autoCompileLess($inputFile2, $outputFile2);
?>
