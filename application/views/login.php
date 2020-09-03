<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="author" content="Faiz Muhammad Syam">
    <meta name="description" content="Laundry App">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Laundry system, Laundry, Sistem, Cucian, Pencucian, Wash, Sistem Laundry">

    <title>E-LAUNDRY | Login</title>
    <link rel="shortcut icon" href="<?= base_url('img/company.png') ?>" />

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/font-awesome/css/font-awesome.css') ?>" rel="stylesheet">

    <link href="<?= base_url('assets/css/animate.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <style>
        body {
            font-family: "Helvetica, Open Sans, Tahoma, Arial", sans-serif;
        }
    </style>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">EL+</h1>

            </div>
            <h3>Selamat Datang di E-LAUNDRY</h3>
            <p>Sistem Informasi Management Laundry
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Silahkan Login</p>
            <form class="m-t" role="form" id="logmein" method="post">
                <div class="form-group">
                    <input type="text" name="username" id="username" value="" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b" onclick="logmein();">Login</button>
            </form>
            <p class="m-t"> <small>E-Laundry Developer Copyright &copy; <?= date('Y'); ?></small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?= base_url('assets/js/jquery-2.1.1.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>

    <script type="text/javascript">
        $(function() {
            $('#username').focus();
            localStorage.setItem("dm_menu", '');
            localStorage.setItem("dm_nama_menu", '');
            localStorage.setItem("dm_modul", '');


            $('#logmein').submit(function() {

                logmein();
            });

            $('#password').keydown(function(e) {
                if (e.keyCode === 13) {
                    logmein();
                }
            });
        });

        function logmein() {
            $.ajax({
                url: '<?= base_url("users/logmein") ?>',
                data: $('#logmein').serialize(),
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if (data.status === true) {
                        location.href = '<?= base_url(); ?>';
                    } else {
                        message_custom('error', 'Username dan password salah !')
                        location.reload();
                    }
                }
            });
        }
    </script>
</body>

</html>