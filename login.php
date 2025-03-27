<!DOCTYPE html>
<html lang="en">
<head>
	<title>Portal Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="img/logo/SS3Logo.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="login/fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">

</head>
<body style="background-image: url('img/gedung-bpk.jpg');">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form id="formlogin" class="login100-form validate-form">
					<span class="login100-form-title p-b-26">
						<img src="img/Logo BPK.png" style="width:auto; height: 70px;" alt="" /> 
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<img src="img/logo/SS3Logo.png" style="width:auto; height: 70px;" alt="" />
					</span>
					<span class="login100-form-title p-b-26">
						Selamat Datang
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Masukkan Email BPK @bpk.go.id">
						<span class="domainemail">
							@bpk.go.id
						</span>
						<input class="input100" type="text" name="txtuser" id="txtuser">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Masukkan Password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="txtpassword" id="txtpassword">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" onclick="ceklogin()">
								Masuk
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="login/vendor/animsition/js/animsition.min.js"></script>
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="login/vendor/select2/select2.min.js"></script>
	<script src="login/vendor/daterangepicker/moment.min.js"></script>
	<script src="login/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="login/vendor/countdowntime/countdowntime.js"></script>
	<script src="login/js/main.js"></script>

	<script src="js/sweetalert2/package/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="js/sweetalert2/package/dist/sweetalert2.min.css">

	<script type="text/javascript">
		
		function ceklogin()
		{
			event.preventDefault();
			swal.fire(
            {
                title:"Mencoba Masuk",
                text: "Mengecek Username dan Password. Silahkan Menunggu.",
                showConfirmButton: false,
                imageUrl: "js/sweetalert2/img/load.gif"
            });

			var myform = document.getElementById('formlogin');
			var fd=new FormData(myform);
			$.ajax({
				url: "modul/login/ceklogin.php",
				type: "POST",
				data: fd,
				contentType: false,
				cache: false,
				processData:false,
				success: function(data)
				{
					if(data==0)
                    {
                        window.location="index.php"
                    }
                    else
                    {
                        swal.fire("Gagal","Login Gagal. Silahkan Periksa Email dan Password atau hubungi administrator.","error");
						// swal.fire("Gagal","Login Gagal. Silahkan Periksa Email dan Password atau hubungi administrator." + data,"error");
                    }
				}
			});
		}

	</script>
</body>
</html>