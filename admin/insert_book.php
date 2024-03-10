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
         <h2 class="text-white font-semibold text-2xl">Insert New Books</h2>
         <a href="manage_books.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Go Back</a>
      </div>
    <div class="w-1/2 bg-white text-black shadow-md p-4">
      <div class="font-semibold text-xl">
        <h1>Insert Book Details</h1>
      </div>
      <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="title" class="block text-black"> title:</label>
            <input type="text" id="title" name="title" class=" form-control w-full px-3 py-2 border rounded-lg">
          </div>
          <div class="mb-3">
            <lable for="author"class="block text-black">author:</lable>
            <input type="text" name="author" id="author" class="form-control w-full px-3 py-2 border rounded-lg">
         </div>
         <div class="mb-3">
            <lable for="no_of_pages"class="block text-black">no_of_pages:</lable>
            <input type="text" name="no_of_pages" id="no_of_pages" class="form-control w-full px-3 py-2 border rounded-lg">
         </div>
         
         <div class="mb-3">
            <lable for="category"class="block text-black">category:</lable>
            <select name="category" id="category" class="form-select w-full px-3 py-2 border rounded-lg">
              <option value="">select category here</option>
              <?php
              $query=mysqli_query($connect,"select * from categories");
              while($row = mysqli_fetch_array($query)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo"<option value='$cat_id'>$cat_title</option>"; 
              }
              ?>
        </select> 
         </div>
         <div class="mb-3">
            <lable for="description"class="block text-black">description:</lable>
            <textarea rows= "6" name="description" id="description" class="form-control w-full px-3 py-2 border rounded-lg"></textarea>
         </div>
        
         <div class="mb-3">
            <lable for="price"class="block text-black">price:</lable>
            <input type="text" name="price" id="price" class="form-control w-full px-3 py-2 border rounded-lg">
         </div>
         <div class="mb-3">
            <lable for="discount_price"class="block text-black">discount_price:</lable>
            <input type="text" name="discount_price" id="discount_price" class="form-control w-full px-3 py-2 border rounded-lg">
         </div>
         <div class="mb-3">
            <lable for="qty"class="block text-black">qty:</lable>
            <input type="text" name="qty" id="qty" class="form-control w-full px-3 py-2 border rounded-lg">
         </div>
          <div class="mb-3">
            <label for="cover_image" class="block text-black">cover_Image:</label>
            <input type="file" id="cover_image" name="cover_image"class="form-control">
          </div>
          <div class="mb-3">
            <lable for="isbn"class="block text-black">isbn:</lable>
            <input type="text" name="isbn" id="isbn" class="form-control w-full px-3 py-2 border rounded-lg">
         </div>
          
          <div class="mb-3">
            <input type="submit" name="create_book" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" value="Insert book">
          </div>
        </form>
         <?php
        if(isset($_POST['create_book'])){
          $_title=$_POST['title'];
          $_author=$_POST['author'];
          $_isbn=$_POST['isbn'];
          $_description=$_POST['description'];
          $_price=$_POST['price'];
          $_discount_price=$_POST['discount_price'];
          $_category=$_POST['category'];
          $_qty=$_POST['qty'];
          $_no_of_pages=$_POST['no_of_pages'];

          $_cover_image=$_FILES['cover_image']['name']; 
          $_tmp_cover_image=$_FILES['cover_image']['tmp_name']; 

          move_uploaded_file($_tmp_cover_image,"../images/$_cover_image");
          
          $query=mysqli_query($connect,"INSERT INTO books(title,author,isbn,description,price,discount_price,category,qty,no_of_pages,cover_image)
          VALUE('$_title','$_author','$_isbn','$_description','$_price','$_discount_price','$_category','$_qty','$_no_of_pages','$_cover_image')");

          if($query){
            echo"<script>window.open('manage_books.php','_self')</script>";
          }
          else{
            echo"<script>alert('failed')</script>";
          }
        }
        ?>
    </div>
</div>

</div>
</body>
</html>