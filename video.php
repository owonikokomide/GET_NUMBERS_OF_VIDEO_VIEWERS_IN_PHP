<?php include('config.php'); ?>
<?php
if(isset($_POST['play'])){
    $id = $_POST['hide'];
    $select = "SELECT * FROM link  WHERE id ='$id'";
    $select_query = mysqli_query($connection, $select);
    $row = mysqli_fetch_array($select_query);
    $r = $row['views']+1;
$update = mysqli_query($connection,"UPDATE link SET views ='$r' WHERE id ='$id'");
if($update){
//  echo "succesful"; 
}
} 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="video.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.17.1/dist/xlsx.full.min.js"></script>
  <title>link count</title>

</head>
<body>
  <div class="container">

    <table>
<tr>
<!-- <th>Video name</th> -->
<th>Views</th>
<th>Video</th>
<th>Play</th>
</tr>

    <?php
    $select = "SELECT * FROM link";
    $select_query = mysqli_query($connection, $select);
     while($e=mysqli_fetch_array($select_query)){
    ?>
<tr>
    <!-- <td><?php echo $e['id']; ?></td> -->
    <!-- <td><?php echo $e['video_name']; ?></td> -->
    <td id="view<?php echo $e['id']; ?>"><?php echo $e['views']." views"; ?></td>
    <td style="border:1px solid white; border-radius:0.5rem;">
    <video id="video<?php echo $e['id']; ?>" class="video" data-id="<?php echo $e['id']; ?>" width="440" height="360"  >
    <source src="vid/<?php echo $e['video_name']; ?>" type="video/mp4">
     </video>
    </td>
    <td>
    <!-- <form method="post"> -->
 
        <input type="hidden" name="hide" value="<?php echo $e['id']; ?>" >
    <button type="button" name="play" id="play-button" class="but" data-id="<?php echo $e['id']; ?>">Play</button>
     <!-- </form> -->
    </td>
</tr>

<?php
     }
?>
    </table>
</div>
   


  <!-- </form> -->

    </div>
  
    <script>
        // var video = document.querySelectorAll("#video");
        var playButton = document.querySelectorAll("#play-button");
    //    console.log(playButton.length);// [2];
        for(i = 0; i < playButton.length; i++){
        //     console.log[i];

        playButton[i].addEventListener("click", function() {
            var id = this.dataset.id;
            var video = document.querySelector("#video"+id);
            // console.log(video);
            // console.log(i);
            if (video.paused) {
                video.play();
                this.innerHTML = "Pause";
            } else {
                video.pause();
                this.innerHTML = "Play";
            }
        });

    }
   
        // var playButton = document.querySelectorAll("#play-button");
        var video = document.querySelectorAll(".video");

 
        for(i = 0; i < video.length; i++){
            video[i].addEventListener("ended", function () {
                var productId = $(this).data('id');
                getProductDetails(productId)
         
                // console.log("video ended");
            });
        }
        function getProductDetails(productId) {
           
           $.ajax({
               url: 'getid.php',
               type: 'GET',
               data: { product_id:productId },
               success: function (response) {
                // if(!data.error){
                document.getElementById('view'+productId).innerHTML= response+" views";

                // }


               }
            });

            }
       
    </script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<script>
        // $(document).ready(function() {
        //     $(".play-button").on("click", function() {
        //         var videoId = $(this).data("video-id");
        //         var videoElement = $("#video-" + videoId)[0]; // Get the video element
        //         var buttonText = $(this).text();

        //         if (buttonText === "Play") {
        //             videoElement.play();
        //             $(this).text("Pause");
        //             $(this).addClass("pulsing");
        //         } else {
        //             videoElement.pause();
        //             $(this).text("Play");
        //             $(this).removeClass("pulsing");
        //         }
        //     });
        // });
    </script>

</body>
</html>
