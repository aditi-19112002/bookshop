<?php include_once "../connect.php";

if(isset($_session['admin'])){
     echo "<script>windows.open('../login.php','_self')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="bg-gray-700">
<?php include_once "./admin_header.php";?> 
<div class="flex">
   <?php include_once "sidebar.php";?>

<div class="flex-1 bg-gray-700">

  <div class="flex space-x-4 mt-6 ml-6">
  <div class="w-1/4 bg-blue-300 p-10 text-white text-2xl">
    <h2><?php
        echo $accountsBooks = mysqli_num_rows(mysqli_query($connect, "select * from books"));
        ?>
   </h2>
    <h2>Total Books</h2>
  </div>
  <div class="w-1/4 bg-green-300 p-10 text-white text-2xl">
  <h2><?php
        echo $accountsCategory = mysqli_num_rows(mysqli_query($connect, "select * from categories"));
        ?></h2>
    <h2>Total category</h2>
  </div>
  <div class="w-1/4 bg-yellow-300 p-10 text-white text-2xl">
  <h2><?php
        echo $accountsUsers = mysqli_num_rows(mysqli_query($connect, "select * from accounts"));
        ?></h2>
     <h2>Total users</h2>
  </div>
</div>
</div>


</div>

</body>
</html>