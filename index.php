<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>upload video</title>
</head>
<body>
  <div class="container">
    <h1>Upload a video</h1>
    <form action="" method="POST" enctype="multipart/form-data">
      <input type="file"  name="video" required accept="video/">
      <input type="submit" name="submit">
    </form>
  </div>
</body>
</html>

<?php


if(isset($_POST['submit'])){
  $video = $_FILES['video']['name'];
  $folder = "folder/";
  $destination = $video.$folder;
  $tmp = $_FILES['video']['tmp_name'];

$n = move_uploaded_file($tmp, $destination);

  $select = "SELECT * FROM link";
// $select_query = mysqli_query($connection, $select);
$checkexist = mysqli_query($connection,"SELECT * FROM link where video_name='$video'");
// 
if(mysqli_num_rows($checkexist)==1){
echo "Video already exist";
}else{
  $add_vid = mysqli_query($connection,"INSERT INTO link (video_name,views)
  VALUES('$video','0')");
  if($add_vid){
    echo "<script> alert('Video Successfully Added')
    location.href='video.php'
    </script>";
    
   }else{
    echo "error inserting";
   }
}

}
?>
