<div class="formulario">
    <h2>Registrate</h2>
    <form action="<?=BASE_URL?>registro" method="post">
        <label for="email">Email</label>
        <input type="email" name="datos[email]" id="email" placeholder="Introduce tu email">
        <label for="password">Contrase&ntilde;a</label>
        <input type="password" name="datos[password]" id="password" placeholder="Introduce tu contrase&ntilde;a">
        <input type="submit" value="Registrar">
    </form>
</div>