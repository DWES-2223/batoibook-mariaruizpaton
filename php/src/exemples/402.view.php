<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<form method="post" action="402.php">
    <div class="form-group row">
        <label for="nom" class="col-4 col-form-label">Nom</label>
        <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-address-book"></i>
                    </div>
                </div>
                <input id="nom" name="nom" placeholder="Escriu el teu nom" type="text" class="form-control"
                       value="<?= $nom ?? '' ?>">
                <?= printError($errores, 'nom') ?>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="cognoms" class="col-4 col-form-label">Cognoms</label>
        <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-address-card-o"></i>
                    </div>
                </div>
                <input id="cognoms" name="cognoms" placeholder="Escriu els teus cognoms" type="text"
                       class="form-control" value="<?= $cognoms ?? '' ?>">
                <?= printError($errores, 'cognoms') ?>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-4 col-form-label">Email</label>
        <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-envelope-open-o"></i>
                    </div>
                </div>
                <input id="email" name="email" placeholder="Escriu el teu email" type="text" class="form-control"
                       value="<?= $email ?? '' ?>">
                <?= printError($errores, 'email') ?>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="url" class="col-4 col-form-label">Url Personal</label>
        <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-envelope-open-o"></i>
                    </div>
                </div>
                <input id="url" name="url" placeholder="Escriu la teua url" type="text" class="form-control"
                       value="<?= $url ?? '' ?>">
                <?= printError($errores, 'url') ?>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="url" class="col-4 col-form-label">Sexe</label>
        <div class="col-8">
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexe" value="Home" id="sexe1">
                    <label class="form-check-label" for="sexe1">
                        Home
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexe" value="Dona" id="sexe2">
                    <label class="form-check-label" for="sexe2">
                        Dona
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="url" class="col-4 col-form-label">Aficions</label>
        <div class="col-8">
            <select class="form-select" name="aficions[]" multiple="true">
                <?php
                foreach ($hobbies as $key => $value) { ?>
                    <option value="<?= $key ?>" <?= in_array($key, $aficions ?? []) ? 'selected' : '' ?>> <?= $value ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="url" class="col-4 col-form-label">Menu</label>
        <div class="col-8">
            <div class="input-group">
                <?php foreach ($menu as $key => $value) { ?>
                    <div class="form-check">
                        <input type="checkbox" name="menus[]" value="<?= $key ?>" id="menu1">
                        <label class="form-check-label" for="menu1">
                            <?= $value ?>
                        </label>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
</body>
</html>
