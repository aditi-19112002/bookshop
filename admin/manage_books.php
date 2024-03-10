
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
<div class="w-full flex justify-between items-center mb-4">
         <h2 class="text-white font-semibold text-2xl">Manage Books(3)</h2>
         <a href="insert_book.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Insert Book</a>
      </div>
  <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-800 text-white">
      <tr>
        <th class="px-6 py-3 text-left">ID</th>
        <th class="px-6 py-3 text-left">Title</th>
        <th class="px-6 py-3 text-left">Image</th>
        <th class="px-6 py-3 text-left">Author</th>
        <th class="px-6 py-3 text-left">ISBN</th>
        <th class="px-6 py-3 text-left">price</th>
        <th class="px-6 py-3 text-left">Action</th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      <?php
       $CallingBooks = mysqli_query($connect,"select * from books");
       while($data = mysqli_fetch_array($CallingBooks)):
       ?>
       <!-- Inside the while loop where you display the table rows -->
<tr>
    <td><?= $data['id']; ?></td>
    <td><?= $data['title']; ?></td>
    <td>
        <img width="50px" src="../images/<?= $data['cover_image']; ?>" alt="">
    </td>
    <td><?= $data['author']; ?></td>
    <td><?= $data['isbn']; ?></td>
    <td><?= $data['discount_price']; ?> <del><?= $data['price']; ?><del></td>
    <td class="action-buttons">
        <a href="manage_books.php?b_id=<?= $data['id']; ?>" class="p-2 bg-red-500 text-white rounded">X</a>
        <a href="" class="p-2 bg-yellow-500 text-white rounded">Edit</a>
        <a href="" class="p-2 bg-green-500 text-white rounded">View</a>
    </td>
</tr>
       <?php endwhile;?>
    </tbody> 
  </table>
</div>
</div>
<style>
    table {
        width: 100%;
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

    .action-buttons a {
        display: inline-block;
        margin: 2px;
        padding: 8px;
        text-decoration: none;
        color: white;
        border-radius: 4px;
    }

    .action-buttons a.bg-red-500 { background-color: #ff0000; }
    .action-buttons a.bg-yellow-500 { background-color: #ffd700; }
    .action-buttons a.bg-green-500 { background-color: #00ff00; }
</style>


</body>
</html>

<?php
if(isset($_GET['b_id'])){
    $id = $_GET['b_id'];
    
    $query= mysqli_query($connect,"delete from books where id='$id'");

    if($query){
        echo"<script>window.open('manage_books.php','_self')</script>";
    }
    else{
        echo"<script>alert('delete failed')</script>"; 
    }
}
?>