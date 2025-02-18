## Ejercicio definitivos de web

La idea es que puedas realizar todos los ejercicios solamente mirando el código de la web.
Una vez realizado todos los ejercicio contacta con el profesor Juan Manuel Camara Díaz para
la validación. ```(Si hay un ejercicio sin hacer suspendes directamente sin recuperacion.)```

Notacion:
    R = Ejercicio resuelto que puedes usar como ayuda.
    F = Ejercicio facil.
    M = Ejercicio medio.
    D = Ejercicio dificil.

### Resueltos

[x] (R) Crea el sistema de rutas en el "index"
[x] (R) Modifica el sistema de rutas para que no de error en caso de no indicar una ruta.
[x] (R) Lista las categorias en el "resource_llistar_categories", utilizando un patron MVC

### Empezando

[x] (F) Modifica el "resource_portada", agrega un link para ir al resource "resource_llistar_categories"
[x] (F) Mofifica el "resource_portada", agrega el mensaje con el id 1 de la tabla MENSAJES.
        Dentro del div con el id "mensaje-1". (Obligatorio MVC, vista tiene que devolver el mensaje dentro de un parrafo <p>)

[x] (F) Muestra el texto de las categorias y sus descripciones a prueba de cross-site scripting.

### Validacion

[x] (F) Crea una nueva ruta llamada "registre", y crea una pagina con los siguientes campos:
        username
        password
        first_name
        email
        postal

        El formulario tiene que enviar los resultados a la ruta "registre-session.php"
        Utiliza la siguiente plantilla:

        ```
        <h2> [Este mensaje tienes que cogerlo de la base de datos, id del mensaje es el 2] </h2>
        <form action="?action=registre-session.php" method="post">
                ...
                <input type="submit" value="Enviar">
        </form>
        ```

[X] (M) Guarda en $_SESSION todos los datos del registro, al hacer clic en el boton "Enviar" (Sin ajax)
        Una vez guardados, muestra una pagina de que los datos se han guardado correctamente y los datos introducidos.

[X] (M) Crea una validacion de servidor antes de guardar los datos en $_SESSION igual que la validacion del cliente.
        Los campos tienen que cumplir los siguientes requisitos.
                username: debe tener entre 4 y 20 caracteres
                password: debe tener entre 4 y 20 caracteres
                first_name: debe tener entre 4 y 40 caracteres
                email: debe tener un formato de email
                postal: debe tener 5 catacteres !!numericos!!
                "TODOS": deben ser obligatorio.
        Pista: utiliza la funcion "filter_var" y "strlen"

[ ] (F) Crea una validacion de cliente, los campos tienen que cumplir los siguientes requisitos.
        username: debe tener entre 4 y 20 caracteres
        password: debe tener entre 4 y 20 caracteres
        first_name: debe tener entre 4 y 40 caracteres
        email: debe tener un formato de email
        postal: debe tener 5 catacteres !!numericos!! Pista: pattern="[0-9]+"
        "TODOS": deben ser obligatorio.
        Pista: no hace falta usar js, desde el html se puede hacer
        
### BD

[X] (M) Despues de guardar los datos en el $_SESSION crea una sentencia INSERT para guardar SOLO el nombre y la
        contraseña del usuario en la base de datos. (No guardes el resto de los datos), la consulta tinene que ser parametrizada.

        (La contraseña tiene que estar encriptada)

        Ej de consultas parametrizadas:
        $sql = "INSERT INTO dbo.files(file_name, file_source) VALUES(:file_name, :file_source)";
        $gsent->bindParam(':calories', $calorías, PDO::PARAM_INT);
        $gsent->bindParam(':colour', $color, PDO::PARAM_STR, 12);

        Si no se podido hacer un insert, mostrar un error personalizado:
                $error = "No se pudo registrar el usuario, el usuario ya existe";

[X] (F) Crea una pagina (resource, MVC) que muestre todos los productos

[X] (M) Crea una pagina (resource, MVC) que muestre los productos por categoria, pasando por parametro "get" la categoria que queremos mostrar.
        La consulta tambien tiene que ser parametrizada. Si no se indica la categoria en la url muestra la categoria 1 por defecto.

[X] (M) Crea una pagina para iniciar sesion y que sea funcional. Tienes que comprobar si el usuario y la password corresponde con las
        que hayas creado anteriormente.

### AJAX y JS

[] (M) Crea un boton en la resource_ajax.php que mediante una peticion ayax realice una consulta a la base de datos a la tabla MENSAJES,
        coja el mensaje con el id 3 y se muestre en la pagina "resource_ajax.php" dentro del div con el id "resultado-ajax".

[ ] (M) En el "calculadora-resource", haz que al hacer clic en el boton mostrar, coja el valor de los inputs con los id "uno" y
        "dos", realice una suma de esos numeros y muestre la frase " Juanma es el puto amo [i] " tantas veces como el numero resultado
        de la suma.

        Ej.

        3 + 2 = 

        <h2> Juanma es el puto amo programando 1 </h2>
        <h2> Juanma es el puto amo programando 2 </h2>
        <h2> Juanma es el puto amo programando 3 </h2>
        <h2> Juanma es el puto amo programando 4 </h2>
        <h2> Juanma es el puto amo programando 5 </h2>

### BD y AJAX y JS

[ ] (D) Crea una pagina (resource_llistar_categories_ajax.php) con varias etiquetas <a> (con el texto de cada categoria y que las categorias sean dinamicas, es decir que sean cogidas de la base de datos) y que al hacer click carge un listado de productos de dicha categoria en el div con el identificador "categoria-seleccionada" (Por ayax)

[ ] (D) Crea un buscador en la pagina de todos los productos para filtrar por nombre. (Por ayax)