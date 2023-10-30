<!DOCTYPE html>
<html lang="ca">
<?php
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
?>
<head>
    <meta charset="UTF-8">
    <title>Alta Llibre</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
<form action="../../newBook.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="module">Mòdul:</label>
        <select id="module" name="module">
            <?php foreach ($modulos as $key => $value) { ?>
                <option value="<?=$key?>"><?=$value->getCliteral()?></option>
           <?php }?>
        </select>
        <span class="error"><?=printError($errores, 'module')?></span>
    </div>
    <div>
        <label for="publisher">Editorial:</label>
        <input type="text" id="publisher" name="publisher" value="">
        <span class="error"><?=printError($errores, 'publisher')?></span>
    </div>
    <div>
        <label for="price">Preu:</label>
        <input type="text" id="price" name="price" value="">
        <span class="error"><?=printError($errores, 'price')?></span>
    </div>
    <div>
        <label for="pages">Pàgines:</label>
        <input type="text" id="pages" name="pages" value="">
        <span class="error"><?=printError($errores, 'pages')?></span>
    </div>
    <div>
        <label for="status">Estat:</label>
        <select id="status" name="status">
            <?php foreach ($stats as $key => $stat) { ?>
                <option value="<?=$stat?>"><?=$stat?></option>
            <?php }?>
        </select>
        <span class="error"><?=printError($errores, 'status')?></span>
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
        <button type="submit" name="subir" value="subir">Donar d'alta</button>
    </div>
</form>
</body>
</html>

