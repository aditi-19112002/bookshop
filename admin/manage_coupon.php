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
    <title>manage coupon</title>
</head>
<body class=" bg-gray-700">
<?php include_once "./admin_header.php";?> 
<div class="flex">
   <?php include_once "sidebar.php";?>
   <div class="flex-1 bg-gray-700 p-4">
   <h2 class="text-white font-semibold text-2xl mb-4">Manage Coupon</h2>
      <div class="w-30% bg-white shadow-md p-4" style="display: inline-block;">
         <div class="font-semibold text-xl">
            <h1>Insert Coupon Details</h1>
         </div>
         <div class="card-body">
            <form action="" method="POST">
               <div class="mb-3">
                  <label for="coupon_code" class="block text-black font-semibold">Coupon code</label>
                  <input type="text" id="coupon_code" name="coupon_code" placeholder="Enter code" class="form-control w-full px-3 py-2 border rounded-lg">
               </div>
               <div class="mb-3">
                  <label for="coupon_amount" class="block text-black font-semibold">Coupon amount</label>
                  <input type="text" id="coupon_amount" name="coupon_amount" placeholder="Enter coupon amount" class="form-control w-full px-3 py-2 border rounded-lg">
               </div>
               <div class="mb-3">
                  <input type="submit" name="create_coupon" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" value="Insert coupon">
               </div>
            </form>
            <?php
            if(isset($_POST['create_coupon'])){
               $coupon_code = $_POST['coupon_code'];
               $coupon_code_amount  = $_POST['coupon_amount'];

               $query = mysqli_query($connect, "INSERT INTO coupon (coupon_code, coupon_amount) VALUES ('$coupon_code', '$coupon_code_amount')");

               if($query){
                  echo "<script>window.open('manage_coupon.php','_self')</script>";
               }
               else{
                  echo "<script>alert('failed')</script>";
               }
            }
            ?>
         </div>
      </div>
      <div style="display: inline-block; vertical-align: top;">
         <table class="mix-w-full divide-y divide-gray-200">
            <thead class="bg-gray-800 text-white">
               <tr>
                  <th class="px-4 py-2 text-left">ID</th>
                  <th class="px-4 py-2 text-left">Code</th>
                  <th class="px-4 py-2 text-left">Amount</th>
                  <th class="px-4 py-2 text-left">Action</th>
               </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
               <?php
               $CallingCoupon = mysqli_query($connect,"select * from coupon");
               while($data = mysqli_fetch_array($CallingCoupon)):
               ?>
               <tr>
                  <td><?= $data['coupon_id'];?></td>
                  <td><?= $data['coupon_code'];?></td>
                  <td><?= $data['coupon_amount'];?></td>
                  <td>
                     <a href="manage_coupon.php?coupon_id=<?= $data['coupon_id'];?>" class=" p-2 bg-red-500 text-white rounded">X</a>
                     <a href="" class=" p-2 bg-yellow-500 text-white rounded">Edit</a>
                     <a href="" class=" p-2 bg-green-500 text-white rounded">view</a>
                  </td>
               </tr>
               <?php endwhile;?>
            </tbody> 
         </table>
      </div>
   </div>
</div>



<style>
  table {
    width:100%;
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
if(isset($_GET['coupon_id'])){
   $id = $_GET['coupon_id'];
   
   $query = mysqli_query($connect, "DELETE FROM coupon WHERE coupon_id='$id'");

   if($query){
       echo "<script>window.open('manage_coupon.php','_self')</script>";
   }
   else{
       echo "<script>alert('Delete failed')</script>";
   }
}

?>