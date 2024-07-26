<?php 
require 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List SunDevs</title>
    <link rel="stylesheet" href="Css/StyleToDoList.css">
</head>
<body>
<div class="container">
    <div class="todo-app">
        <h2> To - Do list <img src="Images/icon.png" alt="To-Do list"></h2>
        <div class="row">
            <input type="text" id="input-box" placeholder="Agregue su texto">
            <button onclick="addTask()"> Añadir </button>
        </div>
        <ul id="list-container">
            <?php 
            $stmt = $conn->query("SELECT * FROM todos ORDER BY id DESC");
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $checked = $row['checked'] ? 'checked' : '';
                $imgSrc = $row['checked'] ? 'Images/unchecked.png' : 'Images/checked.png';
                echo "<li data-id='{$row['id']}' class='$checked'><img src='$imgSrc' alt='Checkbox'> {$row['title']}<span>×</span></li>";
            }
            ?>
        </ul>
    </div>
</div>
<footer>
    <p> To do list icons created by Freepik - Flaticon </p>
</footer>
<script src="Js/IndexToDoList.js"></script>
<script>
function addTask() {
    const inputBox = document.getElementById("input-box");
    const task = inputBox.value;
    if (task === '') {
        alert("Debe escribir algo!");
    } else {
        fetch('add_task.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: new URLSearchParams('title=' + encodeURIComponent(task))
        }).then(response => response.text()).then(data => {
            if (data === 'Success') {
                const li = document.createElement("li");
                li.innerHTML = `<img src="Images/checked.png" alt="Checkbox"> ${task}<span>×</span>`;
                document.getElementById("list-container").appendChild(li);
                inputBox.value = ""; // Limpiar el input después de añadir la tarea
            }
        });
    }
}

document.getElementById("list-container").addEventListener("click", function(e) {
    const target = e.target;
    const li = target.closest('li');
    if (target.tagName === "LI" || target.tagName === "IMG") {
        const id = li.getAttribute('data-id');
        fetch('update_task.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: new URLSearchParams('id=' + encodeURIComponent(id))
        }).then(response => response.text()).then(data => {
            if (data === 'checked') {
                li.classList.add('checked');
                target.src = 'Images/unchecked.png';
            } else {
                li.classList.remove('checked');
                target.src = 'Images/checked.png';
            }
        });
    } else if (target.tagName === "SPAN") {
        const id = li.getAttribute('data-id');
        fetch('delete_task.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: new URLSearchParams('id=' + encodeURIComponent(id))
        }).then(response => response.text()).then(data => {
            if (data === 'Success') {
                li.remove();
            }
        });
    }
});
</script>
</body>
</html>
