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
    <main style="box-sizing: border-box; width: 100 vh;">
        <div class="headers" style="display: flex;">
            <div class="cliente">
                <h1>
                    <b>Confirmación de Usuario</b>
                </h1>
                <b>Ride Moto-Renting</b>
                <span>
                    28006
                    Madrid
                </span>

                <span>Madrid</span>
                <span>
                    CIF:B-4567894X
                </span>
                <span>
                    TELF:964 456 789
                </span>
            </div>
        </div>
        <hr>
        <div class="subheaders" style="display: flex; margin-top: 5em;">
            <p style="padding: 3 em;">
                Bienvenido {{ $user->fullName }} a nuestro portal, estás a sólo un paso de completar tu registro, y puedas rentar
                una motocicleta y disfrutar de la emosión de viajar en dos ruedas....
                <br>
                Sólo tienes que ingresar <a href=""> AQUI </a> para completar tu registro y confirmar tu cuenta....
            </p>
        </div>
    </main>

</body>

</html>