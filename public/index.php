<!DOCTYPE html>
<html>
<head>
    <title>Evento</title>
</head>
<body>

<h1>Gran Evento 🎉</h1>

<p id="contador"></p>

<a href="https://wa.me/521XXXXXXXXXX" target="_blank">
    <button>Reservar</button>
</a>

<script>
const fechaEvento = new Date("2026-12-31 20:00:00").getTime();

setInterval(() => {
    const ahora = new Date().getTime();
    const diferencia = fechaEvento - ahora;

    const dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));

    document.getElementById("contador").innerHTML =
        "Faltan " + dias + " días";
}, 1000);
</script>

</body>
</html>