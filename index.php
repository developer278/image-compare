<?php
error_reporting(1);
if(isset($_POST['submit'])){

$folder = "";
$img1name = $folder."image1.png";
$img2name= $folder."image2.png";
if(move_uploaded_file($_FILES['image1']['tmp_name'], $img1name)&&move_uploaded_file($_FILES['image2']['tmp_name'], $img2name))
{
// Load the two images to be compared
$image1 = new \Imagick($img1name);
$image2 = new \Imagick($img2name);

// Compare the two images and generate a diff image
$diff = $image1->compareImages($image2, Imagick::METRIC_MEANSQUAREERROR);
if ($_POST['d'] == 'img') {

    $diff[0]->setImageFormat("png");
    header("Content-Type: image/png");
    echo $diff[0]; die;
}

// Get the difference score
$diffScore = $diff[1];
echo $diffScore;
echo"<br>";
// If the images are identical, the score will be 0
if ($diffScore == 0) {
    echo "The images are identical!";

} else {
    echo "The images are different. Difference score: " . $diffScore;
}

}
else {
    echo "something went wrong";

}
}
else{


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
    <title>Document</title>
    <style>
        .container1{
            top:50%;
            left:50%;
            position:absolute;
            transform:translate(-50%,-50%);
            background-image: linear-gradient(224deg, rgba(63, 63, 63, 0.1) 0%, rgba(63, 63, 63, 0.1) 50%,rgba(155, 155, 155, 0.1) 50%, rgba(155, 155, 155, 0.1) 100%),linear-gradient(89deg, rgba(75, 75, 75, 0.02) 0%, rgba(75, 75, 75, 0.02) 50%,rgba(99, 99, 99, 0.02) 50%, rgba(99, 99, 99, 0.02) 100%),linear-gradient(151deg, rgba(14, 14, 14, 0.02) 0%, rgba(14, 14, 14, 0.02) 50%,rgba(74, 74, 74, 0.02) 50%, rgba(74, 74, 74, 0.02) 100%),linear-gradient(7deg, rgba(31, 31, 31, 0.04) 0%, rgba(31, 31, 31, 0.04) 50%,rgba(210, 210, 210, 0.04) 50%, rgba(210, 210, 210, 0.04) 100%),linear-gradient(291deg, rgba(153, 153, 153, 0.07) 0%, rgba(153, 153, 153, 0.07) 50%,rgba(32, 32, 32, 0.07) 50%, rgba(32, 32, 32, 0.07) 100%),linear-gradient(90deg, rgb(4, 164, 188),rgb(9, 51, 170));
            opacity: 0.9;
            padding:2rem;
            border-radius:20px;
            border:2px solid lightgrey;
        }
        body{
            background-image:url('pexels-pixabay-268533.jpg');
            background-size:cover;
            background-repeat:no-repeat;
            /* background:grey; */
        }
    </style>
</head>
<body>
   
   <div class="container1">
    <h3 class="text-center text-dark p-3"> Upload Images to Compare</h3>
   <form action="index.php"  method="post" enctype="multipart/form-data">
       <div style="display:flex;justify-content:space-between;">
       <input type="file" name="image1" id="file">
        <input type="file" name="image2" id="file">
       </div>
       <br>
       <select name="d" id="">
       <option value="">score</option>
        <option value="img">Image</option>
       </select>
       <br> <br>
        <!-- <button type="submit" name="submit" class="btn btn-primary">Get Image</button> -->
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
    </form>
   </div>
</body>
</html>
<?php
}
?>
