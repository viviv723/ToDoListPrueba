const inputBox = document.getElementById("input-box");
const listContainer = document.getElementById("list-container");

function addTask() {
    const task = inputBox.value;
    if (task === '') {
        alert("Debe escribir algo!");
        return;
    }
    
    // Enviar la tarea al servidor
    fetch('add_task.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams('title=' + encodeURIComponent(task))
    })
    .then(response => response.text())
    .then(data => {
        if (data === 'Success') {
            // Crear y añadir la tarea a la lista
            let li = document.createElement("li");
            li.innerHTML = task + '<span>\u00d7</span>';
            listContainer.appendChild(li);
            inputBox.value = ""; // Limpiar el input después de añadir la tarea
        } else {
            alert("No se pudo añadir la tarea.");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Ocurrió un error.");
    });
}

listContainer.addEventListener("click", function(e) {
    if (e.target.tagName === "LI") {
        e.target.classList.toggle("checked");
        const id = e.target.dataset.id;
        fetch('update_task.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                id: id,
                checked: e.target.classList.contains("checked") ? 1 : 0
            })
        })
        .catch(error => console.error('Error:', error));
    }
    else if (e.target.tagName === "SPAN") {
        const li = e.target.parentElement;
        const id = li.dataset.id;
        fetch('delete_task.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams('id=' + id)
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'Success') {
                li.remove();
            } else {
                alert("No se pudo eliminar la tarea.");
            }
        })
        .catch(error => console.error('Error:', error));
    }
}, false);

