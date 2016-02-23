<?php
// After using grep, cut, sort, and uniq to organize some apache log files
// this script was used to count how many times the same files were downloaded.
// I later discovered sort -n could do the same job but better. 
$handle = @fopen("list.txt", "r");
if ($handle) {
	$last_buffer = '';
	$line_count = 0;
    while (($buffer = fgets($handle, 4096)) !== false) {
	if ($buffer === $last_buffer) {
		$line_count++;
	} else {
		echo "$line_count $buffer" . PHP_EOL;
		$last_buffer = $buffer;
		$line_count = 0;
	}
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
} else {
	echo 'Problem opening file.'. PHP_EOL;
}
