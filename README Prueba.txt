To-Do List SunDevs

Descripción

Este proyecto es una aplicación de lista de tareas desarrollada utilizando HTML, CSS, JavaScript, PHP y MySQL. Permite a los usuarios agregar tareas, marcarlas como completadas o no completadas, y eliminarlas de la lista.

Lenguajes utilizados

- Frontend: HTML, CSS, JavaScript
- Backend: PHP
- Base de Datos: MySQL

Funcionalidades

- Agregar nuevas tareas a la lista.
- Marcar tareas como completadas.
- Desmarcar tareas como no completadas.
- Eliminar tareas de la lista.

Estructura del Proyecto

to_do_list/
── db_conn.php
── add_task.php
── delete_task.php
── update_task.php
── IndexToDoList.php
── Css/
    ─ ─ StyleToDoList.css
── Js/
    ─ ─ IndexToDoList.js
── Images/
    ─ ─ icon.png
    ─ ─ checked.png
    ─ ─ unchecked.png


Instalación

1. Clona el repositorio:
       bash
    git clone https://github.com/tu-usuario/to_do_list.git
    

2. Configura la base de datos:
    - Crea una base de datos MySQL llamada `to_do_list`.
    - Crea una tabla llamada `todos` con la siguiente estructura:
        
        CREATE TABLE todos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            checked BOOLEAN DEFAULT FALSE
        );
        ```

3. Configura la vinculación a la base de datos:
    - Abre 'db_conn.php' y ajusta las credenciales de la base de datos:
        
        $host = 'localhost';
        $db = 'to_do_list';
        $user = 'root';
        $pass = '';
       

4. Ejecuta el proyecto:
    - Coloca todos los archivos en el directorio raíz de tu servidor web (por ejemplo, `htdocs` para XAMPP).
    - Abre 'IndexToDoList.php' en tu navegador.


Correcciones o recomendaciones 

Las Correcciones o recomendaciones  son bienvenidas <3 
