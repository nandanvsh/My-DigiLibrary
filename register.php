<?php
include 'db.php';
session_start();
if(isset($_POST['submit'])){

   $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
   $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
   $no_telp = mysqli_real_escape_string($conn, $_POST['no_telp']);
   $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
   $tanggal_daftar = mysqli_real_escape_string($conn, $_POST['tanggal_daftar']);
   $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type']; 

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(first name, last name, tanggal lahir, alamat, email, password, user_type) VALUES('$first_name','$last_name', '$tanggal_lahir','$alamat','$email', '$cpass', '$user_type')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:index.php');
      }
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- FONT -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- CSS  -->
   <link href="template/html/css/style.css" rel="stylesheet">
   <!-- Bootstrap Core CSS -->
   <link href="template/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="template/assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="template/assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="template/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="template/assets/plugins/c3-master/c3.min.css" rel="stylesheet">
   <!-- CDN AJAX -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

</head>
<body>

<div class="container">
    <div class="cover">
      <div class="front">
        <img src="images/1678099.jpg" alt="">
        <div class="text">
        </div>
      </div>
      <div class="row justify-content-center">

<div class="col-xl-5 col-lg-6 col-md-8">
    <center>
        <img src="assets/img/logo(2).png" style="max-width: 100px; margin-top: 10%;">
        <h1 class="mt-5">My DigiLibrary</h1>
    </center>
      <div class="card o-hidden border-3 shadow-lg" style="margin-top: 10%; margin-bottom: 25%;">
                    <div class="card-body col-md-12 mx-auto">
                        <!-- Nested Row within Card Body -->
                        <div class=" d-none d-lg-block"></div>
                        <div class=" mt-2">
                            <form action="#" method="POST">
                                <div class="col-md-12">
                                    <h3 align="center">Halaman Register</h3>
                                    <hr>
                                    <div class="mt-3 form-group">
                                        <label for="Nama Depan" style="margin-left:2%;">Nama Depan: </label>
                                        <input type="text" id="nama_depan" name="nama_depan" placeholder="Masukkan nama awal Anda" class="form form-lg form-control mt-2" required>

                                    </div>
                                    <div class="mt-3 form-group">
                                        <label for="Nama Belakang" style="margin-left:2%;">Nama Belakang: </label>
                                        <input type="text" id="nama_belakang" name="nama_belakang" placeholder="Masukkan nama akhir Anda" class="form form-lg form-control mt-2" required>

                                    </div>
                                    <div class="mt-3 form-group">
                                        <label for="No Telpon" style="margin-left:2%;">No Telpon: </label>
                                        <input type="text" id="no_telpon" name="no_telpon" placeholder="Masukkan nomor telepon Anda" class="form form-lg form-control mt-2" required>

                                    </div>
                                    <div class="mt-3 form-group">
                                        <label for="Alamat" style="margin-left:2%;">Alamat: </label>
                                        <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat Anda" class="form form-lg form-control mt-2" required>

                                    </div>
                                    <div class="mt-3 form-group">
                                        <!-- <label for="Kota" style="margin-left:2%;">Kota: </label>
                                        <input type="text" id="Kota" name="Kota" placeholder="Masukkan kota Anda" class="form form-lg form-control mt-2" required>

                                    </div> -->
                                    <div class="mt-3 form-group">
                                        <label for="Tanggal Lahir" style="margin-left:2%;">Tanggal Lahir: </label>
                                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan tanggal lahir Anda" class="form form-lg form-control mt-2" required>

                                    </div>
                                    <div class="mt-3 form-group">
                                        <label for="Tanggal Daftar" style="margin-left:2%;">Tanggal Daftar: </label>
                                        <input type="date" id="tanggal_daftar" name="tanggal_daftar" placeholder="Masukkan tanggal daftar Anda" class="form form-lg form-control mt-2" required>

                                    </div>
                                    <div class="mt-3 form-group">
                                        <label for="Email" style="margin-left:2%;">Email: </label>
                                        <input type="text" id="Email" name="Email" placeholder="Masukkan email anda" class="form form-lg form-control mt-2" required>

                                    </div>
                                    <div class="mt-3 mb-3 form-group">
                                        <label for="password" style="margin-left:2%;">Password: </label>
                                        <input type="password" id="password" name="password" placeholder="Masukkan password anda" class="form form-lg form-control mt-2" required>

                                    </div>
                                    <div class="mt-3 mb-3 form-group">
                                        <label for="cp_password" style="margin-left:2%;">Password: </label>
                                        <input type="password" id="password" name="cp_password" placeholder="Konfirmasi password anda" class="form form-lg form-control mt-2" required>

                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary col-md-12 col-xs-12 mt-3">Register Now</button>
                                    <div class="text sign-up-text">Sudah punya akun? <a href="login.php">login sekarang</a></div> 
                                  </div>
                        </div>
                    </div>
      </div>
</div>      
</body>
<script type="text/javascript">
		function submitForm()
		{
			var first_name = $('input[name=first_name]').val();
			var last_name = $('input[name=last_name]').val();
            var no_telp = $('input[name=no_telp]').val();
            var tanggal_lahir = $('input[name=tanggal_lahir]').val();
            var tanggal_daftar = $('input[name=tanggal_daftar]').val();
            var alamat = $('input[name=alamat]').val();
            var email = $('input[name=email]').val();
			var password = $('input[name=password]').val();
			var cpassword = $('input[name=cpassword]').val(); 

			if(first_name != '' && last_name!= '' && no_telp!= '' && tanggal_lahir!= '' && tanggal_daftar!= '' && alamat!= '' && email!= '' && password != '' && cpassword != '')
			{
				var formData = {first_name: first_name,last_name:last_name,no_telp:no_telp,tanggal_lahir:tanggal_lahir,tanggal_daftar:tanggal_daftar,alamat:alamat, email: email, password: password, cpassword: cpassword};
				$('#message').html('<span style="color: red">Processing form. . . please wait. . .</span>');
				$.ajax({url: "http://localhost/project/register.php", type: 'POST', data: formData, success: function(response)
				{
					var res = JSON.parse(response);
					console.log(res);
					if(res.success == true)
						$('#message').html('<span style="color: green">Form submitted successfully</span>');
					else
						$('#message').html('<span style="color: red">Form not submitted. Some error in running the database query.</span>');
				}
				});
			}
			else
			{
				$('#message').html('<span style="color: red">Please fill all the fields</span>');
			}
		} 
	</script>
</html>