<?php
declare(strict_types=1);
showTree();
function showTree()
{
	echo "File is located:".'"'.dirname(__FILE__).'"'."<br>";
	echo "File tree:"."<br>";
	$AllFoldersNearby=showAllFoldersNearby(dirname(__FILE__));
	$fileFloor=0;
	showAllFilesAndFolders($AllFoldersNearby,dirname(__FILE__),$fileFloor);
}
function showAllFilesAndFolders($AllFoldersNearby, $dirname, &$fileFloor)
{
	for($i=0; $i<count($AllFoldersNearby); $i++){
		if($AllFoldersNearby[$i]==="."| $AllFoldersNearby[$i]===".."){
			continue;
		}
		$fail=$dirname.'\\'.$AllFoldersNearby[$i];
		echo (str_repeat(".....", $fileFloor));
		if(is_dir($fail)){
			$fileFloor+=1;
			echo $fail."<br>";
			$newAllFoldersNearby=showAllFoldersNearby($fail);
			showAllFilesAndFolders($newAllFoldersNearby,$fail,$fileFloor);
		}
		else{
			echo $fail."<br>";
		}
	}
	$fileFloor-=1;
}
function showAllFoldersNearby($fileLocation)
{
	return scandir($fileLocation);
}