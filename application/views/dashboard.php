<!DOCTYPE html>
<!DOCTYPE html>
<html>

<head>
	<title>E-LAUNDRY | <?= $active; ?></title>
	<link rel="shortcut icon" href="<?= base_url('img/company.png') ?>" />

	<meta charset="utf-8">
	<meta name="author" content="Faiz Muhammad Syam">
	<meta name="description" content="Laundry App">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="Laundry system, Laundry, Sistem, Cucian, Pencucian, Wash, Sistem Laundry">

	<link href="<?= base_url('assets/css/bootstrap.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/plugins/iCheck/custom.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/plugins/datapicker/datepicker3.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/plugins/switchery/switchery.css') ?>" rel="stylesheet">

	<link href="<?= base_url('assets/font-awesome/css/font-awesome.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/pace.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/mystyle.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/styleku.css') ?>" rel="stylesheet">

	<link href="<?= base_url('assets/css/animate.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/sweetalert2.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/select2.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/select2.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/plugins/steps/jquery.steps.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/bwizard.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/jquery.bootstrap-touchspin.min.css'); ?>" rel="stylesheet">
	<style>
		body {
			font-family: "Helvetica, Open Sans, Tahoma, Arial", sans-serif;
		}
	</style>
</head>

<body class="pace-done fixed-sidebar" style>
	<div id="wrapper">

		<!-- Layout Kiri -->
		<nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav metismenu" id="side-menu">
					<li class="nav-header">
						<div class="dropdown profile-element">
							<span>
								<a onclick="gotohome('app/dashboard', 'Dashboard', 'Dashboard')">
									<?php if ($this->session->userdata('foto') == NULL) : ?>
										<img src="<?= base_url('img/user.png'); ?>" class="img-circle" width="60" height="60" alt="Foto User">
									<?php else : ?>
										<img alt="Foto User" class="img-circle" width="60" height="60" src="<?= base_url() ?>foto/<?= $this->session->userdata('foto'); ?>" />
									<?php endif ?>
								</a>
							</span>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<span class="clear">
									<span class="block m-t-xs">
										<strong class="font-bold"><?= $this->session->userdata('nama'); ?></strong>
									</span>
									<span class="text-muted text-xs block"><?= $this->session->userdata('level'); ?><b class="caret"></b></span>
									<ul class="dropdown-menu animated fadeInRight m-t-xs">
										<li><a onclick="dashboard()"><i class="fa fa-dashboard"></i>&nbsp;Dashboard</a></li>
										<li><a onclick="my_profil()"><i class="fa fa-user"></i>&nbsp;Profile</a></li>
										<li><a onclick="ganti_password()"><i class="fa fa-refresh"></i>&nbsp;Ganti Password</a></li>
										<li class="divider"></li>
										<li>
											<a onclick="location.href='<?= base_url('users/logout') ?>'">
												<i class="fa fa-sign-out"></i> Log out
											</a>
										</li>
									</ul>
								</span>
							</a>
						</div>
						<div class="logo-element">
							SML+
						</div>
					</li>

					<!-- Menu Bar -->
					<?php foreach ($module as $key => $mod) {
						$activ = "";
						$modul = "";
						$current = "";

						if ($active == $mod->nama) {
							$activ = "";
						} else {
							$modul = $mod->controller;
						}
						$privileges = $this->M_app->get_data_privileges($this->session->userdata('id_group'), $mod->id);
						$module_url = str_replace(' ', '', strtolower($mod->nama));
						?>
						<li>
							<a href="<?= $module_url; ?>"><i class="<?= $mod->icon; ?>"></i> <span class="nav-label"><?= $mod->nama; ?></span> <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<?php if (sizeof($privileges) > 0) {
									foreach ($privileges as $key2 => $value2) { ?>
										<li>
											<a onclick="load_menu('<?= $value2->url ?>','<?= $mod->nama; ?>','<?= $modul ?>','<?= $value2->menu ?>'); return false;">
												<i class="<?= $value2->icon; ?>"></i>&nbsp;<?= $value2->menu; ?>
											</a>
										</li>
									<?php }
								} ?>
							</ul>
						</li>
					<?php } ?>
					<!-- End Menu -->

				</ul>

			</div>
		</nav>
		<!-- End Layout Kiri -->

		<!-- Layout Kanan -->
		<div id="page-wrapper" class="gray-bg">

			<!-- Header -->
			<div class="row border-bottom">
				<nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
						<a id="jam" class="btn btn-primary navbar-minimalize minimalize-styl-2"></a>
					</div>
					<ul class="nav navbar-top-links navbar-right">
						<li>
							<span class="m-r-sm text-muted welcome-message" onclick="gotohome()">Selamat Datang <?= $this->session->userdata('nama'); ?> di E-Laundry <?= date('Y'); ?></span>
						</li>
						<li>
							<a onclick="location.href='<?= base_url('users/logout') ?>'">
								<i class="fa fa-sign-out"></i> Log out
							</a>
						</li>
					</ul>

				</nav>
			</div>
			<!-- End Header -->

			<!-- Breadcump -->
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-sm-4">
					<h2 id="title_menu"><?= $title ?></h2>
					<ol class="breadcrumb">
						<li>
							<a href="#">Home</a>
						</li>
						<li>
							<a href="#" id="active"><?= $active ?></a>
						</li>
						<li class="active">
							<strong id="breadcumb_menu"></strong>
						</li>
					</ol>
				</div>
				<div class="col-sm-8">

				</div>
			</div><br>
			<!-- End Breadcump -->

			<!-- Isi Content -->
			<div id="main_content">
				<?php $this->load->view('home_page'); ?>
			</div>
			<!-- End Isi Content -->

			<!-- Footer -->
			<div class="footer fixed">
				<div>
					<strong>
						<marquee behavior="" direction="">Aplikasi ini sedang dalam tahap pembangunan !!!</marquee>
					</strong>
					<!-- <strong>Copyright</strong> Developer E-Laundry &copy; <?= date('Y'); ?> -->
				</div>
			</div>
			<!-- End Footer -->
		</div>
		<!-- End Layout Kanan -->

	</div>

	<!-- Mainly scripts -->
	<script src="<?= base_url('assets/js/jquery-2.1.1.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/library.js') ?>"></script>
	<script src="<?= base_url('assets/js/pace.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/jquery.multilevelpushmenu.js') ?>"></script>
	<script src="<?= base_url('assets/js/plugins/metisMenu/jquery.metisMenu.js') ?>"></script>
	<script src="<?= base_url('assets/js/plugins/slimscroll/jquery.slimscroll.min.js') ?>"></script>

	<!-- Custom and plugin javascript -->
	<script src="<?= base_url('assets/js/inspinia.js') ?>"></script>
	<script src="<?= base_url('assets/js/plugins/pace/pace.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/jquery.blockUI.js') ?>"></script>
	<script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootbox.js') ?>"></script>
	<script src="<?= base_url('assets/js/plugins/iCheck/icheck.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/plugins/datapicker/bootstrap-datepicker.js') ?>"></script>
	<script src="<?= base_url('assets/js/plugins/switchery/switchery.js') ?>"></script>
	<script src="<?= base_url('assets/js/select2.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/select2.js') ?>"></script>
	<script src="<?= base_url('assets/js/plugins/staps/jquery.steps.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/jquery.bootstrap-touchspin.min.js'); ?>"></script>


	<script type="text/javascript">
		function load_modul(url) {
			localStorage.setItem("dm_menu", '');
			localStorage.setItem("dm_nama_menu", '');
			location.href = url;
		}

		function gotohome(url, modul, menu) {
			localStorage.setItem("dm_modul", '');
			localStorage.setItem("dm_menu", '<?= base_url("'+url+'"); ?>');
			localStorage.setItem("dm_nama_menu", menu);
			set_title_page(menu);
			$.ajax({
				url: '<?= base_url("'+url+'") ?>',
				data: '',
				cache: false,
				success: function(data) {
					//$('form').remove();
					$('#main_content').empty();
					$('#main_content').html(data);
				}
			});
			//location.href = '<?= base_url(); ?>';
		}

		paceOptions = {
			ajax: true,
			document: true,
			eventLag: false
		};

		function show_ajax_indicator() {
			$(document).ajaxStart(function() {
				Pace.restart();
			});
		}

		function hide_ajax_indicator() {
			$('body').unblock();
		}

		function load_menu(url, nama_modul, modul, menu) {
			localStorage.setItem("dm_menu", '<?= base_url("'+url+'") ?>');
			localStorage.setItem("dm_nama_menu", menu);
			localStorage.setItem("dm_modul", nama_modul);
			set_title_page(menu);
			// if (modul != '') {
			//     // Pindah modul
			//     modul = modul.replace(' ','');
			//     modul = modul.replace(' ','');
			//     location.href = '<?= base_url("'+modul+'") ?>';
			// }else{
			$.ajax({
				url: '<?= base_url("'+url+'") ?>',
				data: '',
				cache: false,
				success: function(data) {
					//$('form').remove();
					$('#main_content').empty();
					$('#main_content').html(data);
				}
			});
			// }

		}

		function set_title_page(menu) {
			$('#title_menu').html(strip(menu));
			$('#breadcumb_menu').html(strip(menu));
		}

		function dashboard() {
			$.ajax({
				url: '<?= base_url("app/dashboard") ?>',
				cache: false,
				success: function(data) {
					//$('form').remove();
					$('#breadcumb_menu').html('');
					$('#title_menu, #active').html('Dashboard');
					$('#main_content').empty();
					$('#main_content').html(data);
				}
			});
		}

		function ganti_password() {
			$.ajax({
				url: '<?= base_url("app/ganti_password") ?>',
				cache: false,
				success: function(data) {
					//$('form').remove();
					$('#breadcumb_menu').html('');
					$('#title_menu, #active').html('Ganti Password');
					$('#main_content').empty();
					$('#main_content').html(data);
				}
			});
		}

		function my_profil() {
			$.ajax({
				url: '<?= base_url("app/profil") ?>',
				cache: false,
				success: function(data) {
					//$('form').remove();
					$('#breadcumb_menu').html('')
					$('#title_menu, #active').html('My Profil');
					$('#main_content').empty();
					$('#main_content').html(data);
				}
			});
		}

		$(function() {

			var elem = document.querySelector('.js-switch');
			var switchery = new Switchery(elem, {
				color: '#1AB394'
			});

			$('body').ajaxError(function(e, jqxhr, settings, exeption) {
				var url = settings.url;
				var res = jqxhr.responseText;
				var status = jqxhr.statusText;
				var status_code = jqxhr.status;
				var menu = localStorage.getItem("dm_nama_menu");
				//console.log($(res).find('body'));

				$.each($.parseHTML(res), function(i, el) {
					if (el.nodeName == 'DIV') {
						res = $(el).html();
					};
				});

				//            if (status_code === 401) {
				//            	Swal({
				// 	type: 'error',
				// 	title: 'Session Timeout',
				// 	text: 'Session login anda habis, silahkan login kembali'
				// }, function(){
				// 	location.reload();
				// });

				// return false;
				//            }
				if (status_code === 401) {
					// un authoized
					bootbox.dialog({
						message: "Session login anda habis, silahkan login lagi",
						title: "Session Timeout",
						buttons: {
							ok: {
								label: '<i class="fa fa-check"></i> OK',
								className: "btn-primary",
								callback: function() {
									location.reload();
								}
							}
						}
					});
					return false;
				}
			});

			$('#menu').multilevelpushmenu({
				containersToPush: [$('#pushobj')],
				backText: 'Kembali'
			});

			if (localStorage.getItem("dm_modul") !== '') {
				$('#menu').multilevelpushmenu('expand', localStorage.getItem("dm_modul"));
			};


			if ('<?= $active ?>' == '') {
				localStorage.setItem("dm_menu", '');
				localStorage.setItem("dm_nama_menu", '');
				localStorage.setItem("dm_modul", '');
			};


			var height = $(window).height();
			$('.dashboard-wrapper').css('min-height', height - 55 + 'px');
			var dm_menu = localStorage.getItem("dm_menu");
			var dm_nama_menu = localStorage.getItem("dm_nama_menu");
			if (dm_nama_menu !== '') {
				set_title_page(dm_nama_menu);
			} else {
				//set_title_page('');
			}
			if (dm_menu !== '') {
				$.ajax({
					url: dm_menu,
					data: '',
					cache: false,
					success: function(data) {
						$('#main_content').empty();
						$('#main_content').html(data);
					}
				});
			}
		});

		$(function() {

			function clock() {
				var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

				var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];

				var date = new Date();
				var day = date.getDate();
				var month = date.getMonth();
				var thisDay = date.getDay(),
					thisDay = myDays[thisDay];

				var yy = date.getYear();

				var year = (yy < 1000) ? yy + 1900 : yy;

				var Hari = thisDay + ', ' + day + ' ' + months[month] + ' ' + year;
				//document.write();

				var now = new Date();
				var secs = ('0' + now.getSeconds()).slice(-2);
				var mins = ('0' + now.getMinutes()).slice(-2);
				var hr = ('0' + now.getHours()).slice(-2);
				var Time = " - Jam : " + hr + " : " + mins + " : " + secs + " WIB";
				document.getElementById("jam").innerHTML = Hari + Time;
				requestAnimationFrame(clock);
			}

			requestAnimationFrame(clock);
		});
	</script>

</body>

</html>