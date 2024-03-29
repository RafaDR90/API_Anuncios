<?php
use utils\Utils,
    lib\Pages;
if (!Utils::isLogued()){
    $pages=new Pages();
    $pages->render('landingPage/LandingPageView');
    exit();
}
?>
<div class="verToken">
    <?php if (isset($token)):
    ?>
    <p>Usa este token desde tu proyecto para poder hacer peticiones a la API:</p>
    <pre>
        <code>
            Bearer <?=$token?>
        </code>
    </pre>
    <?php else:?>
    <p>Pulsa para crear un nuevo token</p>
    <?php endif;?>
    <a href="<?=BASE_URL?>actualiza-token">Actualizar token</a>
</div>