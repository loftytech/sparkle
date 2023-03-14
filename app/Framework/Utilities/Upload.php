<?php
namespace App\Framework\Utilities;

use App\Framework\Database\Database as DB;

class Upload {

	public static function uploadProfileImg($userid, $imgType, $contestid = "") {
		$file = $_FILES['avatar'];

		$fileName = $_FILES['avatar']['name'];
		$fileTmpName = $_FILES['avatar']['tmp_name'];
		$fileSize = $_FILES['avatar']['size'];
		$fileError = $_FILES['avatar']['error'];
		$fileType = $_FILES['avatar']['type'];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg', 'jpeg', 'png', 'pdf');

		if (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 5000000) {
					$fileNameNew = uniqid('', true). ".".$fileActualExt;

					if ($imgType == "fearured_image") {
						$fileDestination = '../img/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						DB::query('UPDATE posts SET featured_image=:source WHERE permalink=:permalink', array(':permalink'=>$userid, ':source'=>$fileNameNew));
					}

					if ($imgType == "fearured_image_update") {
						$fileDestination = '../img/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						DB::query('UPDATE posts SET featured_image=:source WHERE id=:postid', array(':postid'=>$userid, ':source'=>$fileNameNew));
					}

					if ($imgType == "profilePicture") {
						$fileDestination = 'img/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						DB::query('UPDATE users SET avatar=:source WHERE id=:userid', array(':userid'=>$userid, ':source'=>$fileNameNew));
					}

					if ($imgType == "contestUserPhoto") {
						$fileDestination = 'img/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						DB::query('UPDATE applications SET contest_user_photo=:source WHERE user_id=:userid AND contest_id=:contestid AND status = "pending" ORDER BY id DESC', array(':userid'=>$userid, ':source'=>$fileNameNew, ':contestid'=>intval($contestid)));
					}

					if ($imgType == "profilePictureAdmin") {
						$fileDestination = '../img/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						DB::query('UPDATE users SET avatar=:source WHERE id=:userid', array(':userid'=>$userid, ':source'=>$fileNameNew));
					}

					if ($imgType == "profilePictureAdminContest") {
						$fileDestination = '../img/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						DB::query('UPDATE contests SET photo=:source WHERE id=:userid', array(':userid'=>$userid, ':source'=>$fileNameNew));
					}

					if ($imgType == "contestPhoto") {
						$fileDestination = '../img/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						DB::query('UPDATE contests SET photo=:source WHERE id=:userid', array(':userid'=>$userid, ':source'=>$fileNameNew));
					}
					
				} else {
					echo "Your file is too big!";
				}
			} else {
				echo "There was an error uploading your file";
			}
		} else {
			//echo "You cannot upload files of this type";
		}
	}
}