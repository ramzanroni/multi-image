<?php
function resizeImage($resourceType, $image_width, $image_height, $resizeWidth, $resizeHeight)
{
	// $resizeWidth = 100;
	// $resizeHeight = 100;
	$imageLayer = imagecreatetruecolor($resizeWidth, $resizeHeight);
	imagecopyresampled($imageLayer, $resourceType, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $image_width, $image_height);
	return $imageLayer;
}
for ($i = 0; $i < sizeof($_FILES['upload_files']['name']); $i++) {
	$new_width = 150;
	if ($new_width === 150) {
		$fileName = $_FILES["upload_files"]["tmp_name"][$i];
		$sourceProperties = getimagesize($fileName);
		$resizeFileName = time() . $i;
		$uploadPath = "thump/";
		$fileExt = pathinfo($_FILES['upload_files']['name'][$i], PATHINFO_EXTENSION);
		$uploadImageType = $sourceProperties[2];
		$sourceImageWidth = $sourceProperties[0];
		$sourceImageHeight = $sourceProperties[1];
		$new_height = ($sourceImageHeight / $sourceImageWidth) * $new_width;
		switch ($uploadImageType) {
			case IMAGETYPE_JPEG:
				$resourceType = imagecreatefromjpeg($fileName);
				$imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
				imagejpeg($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
				break;

			case IMAGETYPE_GIF:
				$resourceType = imagecreatefromgif($fileName);
				$imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
				imagegif($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
				break;

			case IMAGETYPE_PNG:
				$resourceType = imagecreatefrompng($fileName);
				$imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
				imagepng($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
				break;
			default:
				$imageProcess = 0;
				break;
		}
	}
	$new_width = 512;
	if ($new_width === 512) {
		$fileName = $_FILES["upload_files"]["tmp_name"][$i];
		$sourceProperties = getimagesize($fileName);
		$resizeFileName = time() . $i;
		$uploadPath = "cover/";
		$fileExt = pathinfo($_FILES['upload_files']['name'][$i], PATHINFO_EXTENSION);
		$uploadImageType = $sourceProperties[2];
		$sourceImageWidth = $sourceProperties[0];
		$sourceImageHeight = $sourceProperties[1];
		$new_height = ($sourceImageHeight / $sourceImageWidth) * $new_width;
		switch ($uploadImageType) {
			case IMAGETYPE_JPEG:
				$resourceType = imagecreatefromjpeg($fileName);
				$imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
				imagejpeg($imageLayer, $uploadPath . "cover_" . $resizeFileName . '.' . $fileExt);
				break;

			case IMAGETYPE_GIF:
				$resourceType = imagecreatefromgif($fileName);
				$imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
				imagegif($imageLayer, $uploadPath . "cover_" . $resizeFileName . '.' . $fileExt);
				break;

			case IMAGETYPE_PNG:
				$resourceType = imagecreatefrompng($fileName);
				$imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
				imagepng($imageLayer, $uploadPath . "cover_" . $resizeFileName . '.' . $fileExt);
				break;
			default:
				$imageProcess = 0;
				break;
		}
	}
}
