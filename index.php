<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style/style.css">
    <title>Achtbanen</title>
</head>

<body>
    <h1 class="title">De 5 snelste achtbanen van Europa</h1>
    <div class="card">
        <h1>Invoer Achtbaan</h1>
        <form action="client/create.php" method="POST">

            <div class="achtbaan">
                <label for="achtbaan">
                    Naam Achtbaan:
                    <input type="text" name="achtbaan" id="achtbaan">
                </label>
            </div>
            <div class="pretpark">
                <label for="pretpark">
                    Naam Pretpark:
                    <input type="text" name="pretpark" id="pretpark">
                </label>
            </div>
            <div class="land">
                <label for="land">
                    Naam Land:
                    <input type="text" name="land" id="land">
                </label>
            </div>
            <div class="topsnelheid">
                <label for="topsnelheid">
                    Topsnelheid (km/u):
                    <input type="number" name="topsnelheid" id="topsnelheid" min="1" max="200">
                </label>
            </div>
            <div class="hoogte">
                <label for="hoogte">
                    Hoogte (m):
                    <input type="number" name="hoogte" id="hoogte" min="1" max="200">
                </label>
            </div>
            <div class="datum">
                <label for="datum">
                    Datum eerste opening:
                    <input type="date" name="datum" id="datum">
                </label>
            </div>
            <div class="cijfer">
                <label for="cijfer">
                    Cijfer voor achtbaan:
                    <div class="dis">
                        <input type="range" name="cijfer" id="cijfer" min="1" max="10" step=".1" oninput="getal(this.value)">
                        <p id="cijferOutput">5.5</p>
                    </div>
                </label>
            </div>
            <input type="submit" value="Sla op">
        </form>
    </div>

    <script src="script.js"></script>
</body>

</html>