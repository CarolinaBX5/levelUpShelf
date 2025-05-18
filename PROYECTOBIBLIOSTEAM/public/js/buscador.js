buscador.addEventListener('keyup', function () {
    let textoBusqueda = buscador.value.toLowerCase().trim();

    if (textoBusqueda === '') {
        pagina = 1;
        copiaJuegos = [...recuperarJuegos];
        mostrarJuegos(pagina);
        paginadorBotones();
    } else {
        let arrayEncontrados = Array.from(recuperarJuegos).filter(item => {
            let titulo = item.querySelector(".game-title").textContent.toLowerCase();
            return titulo.includes(textoBusqueda);
        });

        let contenedor = document.getElementById("catalogo");
        contenedor.innerHTML = '';

        if (arrayEncontrados.length > 0) {
            arrayEncontrados.forEach(item => {
                contenedor.appendChild(item.cloneNode(true)); 
            });
        } else {
            let mensaje = document.createElement('p');
            mensaje.textContent = 'No games';
            contenedor.appendChild(mensaje);
        }

        document.getElementById("paginacion").innerHTML = '';
    }
});
