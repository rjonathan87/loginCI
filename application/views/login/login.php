<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Regtech System Login</title>

    <!-- Bootstrap -->
    <link href="https://colorlib.com/polygon/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="login">
    <form id="frmLogin" method="POST">
        <h1>Login</h1>
        <div>
            <input type="text" name="usuario" id="usuario" 
                class="form-control" placeholder="Usuario" />
        </div>
        <div>
            <input type="password" id="password" name='password' class="form-control"
                placeholder="Contraseña" />
        </div>
        <div>
            <button type="submit" class="btn btn-info btn-block">Entrar</button>
        </div>
    </form>
    <script src="<?php echo base_url('resources/js/login.js'); ?>"></script>
</body>
</html>