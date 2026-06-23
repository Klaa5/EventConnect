const modalidad = document.getElementById("modalidad");
const ubicacionDiv = document.getElementById("ubicacionDiv");
const ubicacion = document.getElementById("ubicacion");


function actualizarUbicacion()
{
    if(modalidad.value === "Virtual")
    {
        ubicacionDiv.style.display = "none";
        ubicacion.required = false;
        ubicacion.value = "";
    }
    else
    {
        ubicacionDiv.style.display = "block";
        ubicacion.required = true;
    }
}


modalidad.addEventListener("change", actualizarUbicacion);

actualizarUbicacion();