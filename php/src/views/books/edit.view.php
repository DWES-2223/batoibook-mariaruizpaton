<!DOCTYPE html>
<html lang="es">
<?php
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}
?>
<head>
    <title>Editar libro</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
<form action="updateBook.php" method="post" enctype="multipart/form-data">
    <h1>Libro: <?= $course->getModule($course->getIdModule()) ?></h1>
    <a href="myBooks.php">Volver a la página anterior</a>
    <div>
        <label for="id">Id libro:</label>
        <input type="number" id="id" name="id" value="<?=$course->getId()?>" readonly>
    </div>
    <div>
        <label for="module">Mòdul:</label>
        <select id="module" name="module">
                <option value="<?=$course->getIdModule()?>"><?=$course->getModule($course->getIdModule())?></option>
        </select>
    </div>
    <div>
        <label for="publisher">Editorial:</label>
        <input type="text" id="publisher" name="publisher" value="<?=$course->getPublisher()?>">
        <span class="error"><?=printError($errores, 'publisher')?></span>
    </div>
    <div>
        <label for="price">Preu:</label>
        <input type="text" id="price" name="price" value="<?=$course->getPrice()?>">
        <span class="error"><?=printError($errores, 'price')?></span>
    </div>
    <div>
        <label for="pages">Pàgines:</label>
        <input type="text" id="pages" name="pages" value="<?=$course->getPages()?>">
        <span class="error"><?=printError($errores, 'pages')?></span>
    </div>
    <div>
        <label for="status">Estat:</label>
        <select id="status" name="status">
                <option value="<?=$course->getStatus()?>"><?=$course->getStatus()?></option>
        </select>
    </div>
    <div>
        <label for="photo">Foto:</label>
        <input type="file" id="photo" name="photo">
    </div>
    <div>
        <label for="comments">Comentaris:</label>
        <textarea id="comments" name="comments"></textarea>
    </div>
    <div>
        <button type="submit" name="subir" value="subir">Editar</button>
    </div>
</form>
</body>
</html>



