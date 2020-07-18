<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Order</title>

</head>

<body class="emailPedido">
    <div class="logoHeader">
        <!-- <img src="" alt="Grupo Caps logo"> -->
        <div></div>
    </div>
    <main style="box-sizing: border-box; width: 80 vh;">
        <div>
            <h1>
                <b>Confirmación de Usuario</b>
            </h1>
            <div class="cliente" style="display: flex; justify-content:space-between">
                <b>Ride Moto-Renting</b>
                <span style="margin-left: 2em ;">
                    28006
                    Madrid
                </span>
                <span style="margin-left: 2em ;">
                    CIF:B-4567894X
                </span>
                <span style="margin-left: 2em ;">
                    TLF:964 456 789
                </span>
            </div>
        </div>
        <hr>
        <div class="subheaders" style="display: flex; margin-top: 1em;">
            <p style="padding: 3 em;">
                Bienvenido {{ $user->fullName }} a nuestro portal, estás a sólo
                un paso de completar tu registro, y puedas rentar
                una motocicleta y disfrutar de la emosión de viajar en dos ruedas,
                su codigo de activación es <b>{{$code}}</b> , ingrese este codigo 
                para poder usar su cuenta.  
            </p>
        </div>
    </main>

</body>

</html>