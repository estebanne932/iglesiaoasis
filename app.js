// 🔥 CONFIGURACIÓN
const fechaEvento = new Date(2026, 8, 12, 19, 0, 0).getTime();

// 🔍 DEBUG (puedes quitar después)
console.log("Fecha evento:", new Date(2026, 8, 12, 19, 0, 0));
console.log("Fecha actual:", new Date());

setInterval(() => {

    try {

        const ahora = new Date().getTime();
        let diferencia = fechaEvento - ahora;

        // 🚨 Si ya pasó el evento
        if (diferencia <= 0) {
            document.getElementById("dias").innerText = "00";
            document.getElementById("horas").innerText = "00";
            document.getElementById("min").innerText = "00";
            document.getElementById("seg").innerText = "00";
            return;
        }

        // 🔢 CÁLCULO CORRECTO (progresivo)
        const dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
        diferencia -= dias * (1000 * 60 * 60 * 24);

        const horas = Math.floor(diferencia / (1000 * 60 * 60));
        diferencia -= horas * (1000 * 60 * 60);

        const min = Math.floor(diferencia / (1000 * 60));
        diferencia -= min * (1000 * 60);

        const seg = Math.floor(diferencia / 1000);

        // 🎯 ACTUALIZAR UI
        document.getElementById("dias").innerText = dias;
        document.getElementById("horas").innerText = horas;
        document.getElementById("min").innerText = min;
        document.getElementById("seg").innerText = seg;

    } catch (error) {

        console.error("Error en contador:", error);

        // fallback visual
        document.getElementById("dias").innerText = "--";
        document.getElementById("horas").innerText = "--";
        document.getElementById("min").innerText = "--";
        document.getElementById("seg").innerText = "--";
    }

}, 1000);