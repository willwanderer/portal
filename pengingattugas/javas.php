<!-- jQuery 2.0.2 -->
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script> -->
<script type="text/javascript" src="../portal/js/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.10.3 -->
<script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- Morris.js charts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- fullCalendar -->
<script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>   

<script src="../js/sweetalert2/package/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="../js/sweetalert2/package/dist/sweetalert2.min.css">

<script type="text/javascript" src="../js/Fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="../js/Fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

<!-- DATA TABES SCRIPT -->
<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href="../js/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="../js/select2/dist/js/select2.min.js"></script>	

<link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

<script type="text/javascript">
	
	function setmenu()
	{
		$(".left-side").toggleClass("collapse-left");
        $(".right-side").toggleClass("strech");
        $("body").toggleClass("fixed");
    	$("body").addClass("skin-black");

    	setInterval(blink_text, 2000);
	}

	function cekkeluar()
	{
		swal.fire({
			title: "Anda Yakin?",
			text: "Apakah Anda Ingin Keluar dari Aplikasi?",
			icon: "question",
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: 'Batal',
			closeOnConfirm: false
		}).then((hasil) =>
		{
			if(hasil.isConfirmed)
			{
				window.location = "../logout.php";
			}
		});
	}

	function kelogin()
	{
		window.location = "../login.php?app=pengingattugas";
	}

	function blink_text() 
	{
		$('.blink').fadeOut(500);
		$('.blink').fadeIn(500);
	}
</script>     