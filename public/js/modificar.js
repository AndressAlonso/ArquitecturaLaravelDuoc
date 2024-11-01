document.addEventListener('DOMContentLoaded', function() {
// Escuchar el evento de clic en los botones "Modificar"
document.querySelectorAll('#modificar').forEach(button => {
    button.addEventListener('click', function() {
        // Encontrar la fila del botón clicado
        const row = this.closest('tr');

        // Obtener todos los inputs del formulario
        const formInputs = document.querySelectorAll('#formModificarCrear input[type="text"]');

        // Llenar los inputs con los datos de la fila
        let index = 0; // Para llevar el conteo de inputs
        row.querySelectorAll('td').forEach((cell, cellIndex) => {
            if (cellIndex < formInputs.length) { // Asegurarse de no salir del rango de inputs
                formInputs[index].value = cell.innerText; // Asignar el valor de la celda al input correspondiente
                index++;
            }
        });

        // Si tienes un input oculto para el ID, también puedes configurarlo
        const idInput = document.querySelector('#formModificarCrear input[name="id"]');
        if (idInput) {
            idInput.value = row.querySelector('input[name="id"]').value; // Asignar el ID de la fila
        }
    });
});

    
    });