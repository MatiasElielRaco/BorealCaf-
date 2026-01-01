import Swal from 'sweetalert2';
(function() {

    const categorias = document.querySelector(".categorias");
    
    if(categorias) {

        const btnEliminar = document.querySelectorAll(".categorias__acciones--boton");
        btnEliminar.forEach( boton => {
            boton.addEventListener("click", eliminarCategoria)
        })


        async function eliminarCategoria(e) {
            const id = e.target.parentElement.querySelector("input[name='id']").value;

            Swal.fire({
                title: "¿Eliminar categoría?",
                text: "Si eliminas la categoria se eliminarán todos los productos asociados a ella.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar"
            }).then(async (result) => {
                if (result.isConfirmed) {

                    const datos = new FormData();
                    datos.append("id", id);


                    const url =  "/admin/categorias/eliminar";
                    const respuesta = await fetch(url, {
                        method: "POST",
                        body: datos
                    });


                    const resultado = await respuesta.json();

                        if(resultado) {
                            Swal.fire({
                            title: "Eliminada",
                            text: "La categoria y sus productos fueron eliminados",
                            icon: "success"
                            });
                            
                            setTimeout(() => {
                                location.reload();
                            }, 1200);
                        }
                }
            });
        }

    }
    
})();