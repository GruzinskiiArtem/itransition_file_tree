<?php

declare(strict_types=1);
$sapi = php_sapi_name();
if ($sapi=='cli')
    $parameterRestrictions = "\r\n";
else
    $parameterRestrictions = "<br>";
showTree($parameterRestrictions);

function showTree(string $parameterRestrictions): void {
    echo "File is located:".'"'.dirname(__FILE__).'"'.$parameterRestrictions;
    echo "File tree:".$parameterRestrictions;
    $allFoldersNearby=showAllFoldersNearby(dirname(__FILE__));
    $fileFloor = 0;
    showAllFilesAndFolders($allFoldersNearby, dirname(__FILE__), $fileFloor, $parameterRestrictions);
}

function showAllFilesAndFolders(array $allFoldersNearby, string $dirname, int &$fileFloor, string $parameterRestrictions) : void {
	$allFoldersNearby = array_diff($allFoldersNearby,array(".",".."));
    foreach ($allFoldersNearby as $element) {
        $fail = $dirname.'\\'.$element;
        if (is_dir($fail)) {
			showAddress($fail, $parameterRestrictions, $fileFloor);
            $fileFloor += 1;
            $newAllFoldersNearby=showAllFoldersNearby($fail);
            showAllFilesAndFolders($newAllFoldersNearby, $fail, $fileFloor, $parameterRestrictions);
        } else {
			showAddress($fail, $parameterRestrictions, $fileFloor);
        }
    }
    $fileFloor -= 1;
}

function showAllFoldersNearby(string $fileLocation): array {
    return scandir($fileLocation);
}

function showAddress(string $fail,string $parameterRestrictions, int $fileFloor): void {
	echo (str_repeat(".....", $fileFloor)).$fail.$parameterRestrictions;
}