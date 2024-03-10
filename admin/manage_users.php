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
<body class=" bg-gray-700">
<?php include_once "./admin_header.php";?> 
<div class="flex">
   <?php include_once "sidebar.php";?>

<div class="flex-1 bg-gray-700 p-4">
  <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-800 text-white">
      <tr>
        <th class="px-6 py-3 text-left">ID</th>
        <th class="px-6 py-3 text-left">Name</th>
        <th class="px-6 py-3 text-left">Email</th>
        <th class="px-6 py-3 text-left">Is admin</th>
        <th class="px-6 py-3 text-left">Action</th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      <?php
       $CallingAccounts = mysqli_query($connect,"select * from accounts");
       while($data = mysqli_fetch_array($CallingAccounts)):
       ?>
       <tr>
        <td><?= $data['user_id'];?></td>
        <td><?= $data['name'];?></td>
        <td><?= $data['email'];?></td>
        <td><?=($data['IsAdmin'])?"True":"False";?></td>
        <td>
        <a href="manage_users.php?u_id=<?= $data['user_id'];?>" class=" p-2 bg-red-500 text-white rounded">X</a>
        <a href="" class=" p-2 bg-yellow-500 text-white rounded">Edit</a>
        <a href="" class=" p-2 bg-green-500 text-white rounded">view</a>
        </td>
</tr>
       <?php endwhile;?>
    </tbody> 
  </table>
</div>
</div>
<style>
  table {
    width:50%;
    border-collapse: collapse;
  }

  th, td {
    padding: 8px;
    text-align: left;
  }

  th {
    background-color: #333;
    color: white;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
  }
</style>

</body>
</html>
<?php
if(isset($_GET['u_id'])){
    $id = $_GET['u_id'];
    
    $query= mysqli_query($connect,"delete from accounts where user_id='$id'");

    if($query){
        echo"<script>window.open('manage_users.php','_self')</script>";
    }
    else{
        echo"<script>alter('delete failed')</script>"; 
    }
}
?>