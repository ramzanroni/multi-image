<?php
include_once('db.php');
$writeDB = DB::connectWriteDB();
$readDB = DB::connectReadDB();
if ($_POST['check'] == "deleteImage") {
    $imageID = $_POST['imageID'];
    $imageName = './' . $_POST['imageName'];
    $cover = substr($_POST['imageName'], 12);
    $coverImg = './cover/cover_' . $cover;
    $deleteImg = $writeDB->prepare('DELETE FROM `item_ref_file` WHERE `id`=:id');
    $deleteImg->bindParam(':id', $imageID, PDO::PARAM_STR);
    $deleteImg->execute();
    $rowCount = $deleteImg->rowCount();
    if ($rowCount === 0) {

        echo "Something is wrong";
    } else {


        unlink($imageName);
        unlink($coverImg);
        echo 'success';
    }
}
