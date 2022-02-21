<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Ingresa un nuevo password</label>
    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Escribe minimo 6 caracteres" name="password1" autofocus required>
    <div id="emailHelp" class="form-text">Ingresa un nuevo password</div>
    <?php
        $validador->getErrorPassword1();
    ?>
</div>
<div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Repite tu nuevo password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Escribe minimo 6 caracteres" name="password2" required>
    <div id="emailHelp" class="form-text">Repite tu nuevo password</div>
    <?php
        $validador->getErrorPassword2();
    ?>
</div>
<button type="submit" class="btn btn-primary btn-lg " name="guardar-password">Guardar password</button>