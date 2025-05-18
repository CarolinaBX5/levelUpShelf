let recuperarJuegos=document.querySelectorAll('.game-card');

let copiaJuegos=[...recuperarJuegos];


let numeroElementos=24;

let pagina=1;



function mostrarJuegos (pagina){

    

    let inicioJuego=(pagina-1) * numeroElementos;
    let finalJuego= inicioJuego + numeroElementos;

    let resultJuegos= copiaJuegos.slice(inicioJuego, finalJuego);

    let contenedor= document.getElementById("catalogo");

    contenedor.innerHTML="";


    resultJuegos.forEach(item => {
        contenedor.appendChild(item.cloneNode(true));
    });


}


function paginadorBotones() {
    let operacionPaginas = Math.ceil(copiaJuegos.length / numeroElementos);
    let paginador = document.getElementById("paginacion");
    paginador.innerHTML = "";

    for (let i = 1; i <= operacionPaginas; i++) {
        let boton = document.createElement("button");
        boton.innerText = i;
        boton.classList.add("pagina");

        if (i === pagina) {
            boton.classList.add("active");
        }

        boton.addEventListener("click", () => {
            pagina = i;
            mostrarJuegos(pagina);
            paginadorBotones();
        });

        paginador.appendChild(boton);
    }
}


paginadorBotones();

mostrarJuegos(pagina);