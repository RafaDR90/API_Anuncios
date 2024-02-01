<main>
    <div class="titulo__container">
        <h1>Bienvenido a CursoAPI</h1>
    </div>
    <div class="que-es-cursoapi">
        <h2>¿Qué es CursoAPI?</h2>
        <p>CursoAPI es un proyecto de prueba para la creaci&oacute;n de una API REST con PHP y MySQL.
            Esta API incluye la validaci&oacute;n por token utilizando la arquitectura Bearer.</p>
    </div>
    <div class="informacion">
        <div>
            <h2>Para usar CursoAPI</h2>
            <p class="texto">Para usar CursoAPI, debes registrarte en la p&aacute;gina de registro. Una vez registrado, tendr&aacute;s que
                activar tu cuenta desde el correo que te llegue, entonces podr&aacute;s iniciar sesi&oacute;n y
                obtener tu token de acceso.</p>
            <p class="texto">El token caduca cada 15 minutos, adem&aacute;s cada vez que se realice una solicitud, este caducar&aacute; y habr&aacute; que solicitar un nuevo token.</p>
            <p class="texto">Para poner el token tendr&aacute;s que añadir un encabezado "Authorization" que contenga Bearer seguido del token, ejemplo:</p>
            <p class="ejemplo">Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MDY4MTEyMTgsImV4cCI6MTcwNjgxMzAxOCwiZGF0YSI6eyJlbWFpbCI6InJhZmExODIyMGRlbGdhZG9AZ21haWwuY29tIiwicm9sIjoidXNlciJ9fQ.nDlulnvRW3NO-4trmiaAyG2J2xSZHf__RbRA9G8ZHPg</p>
        </div>
        <div>
            <h2>Para crear un anuncio</h2>
            <p>Se debe hacer por <span>POST</span> y el cuerpo de la solicitud debe contener un JSON que incluya: "titulo", "descripcion", "precio" y "img_url".</p>
        </div>
        <div>
            <h2>Para editar un anuncio</h2>
            <p>Se debe hacer por <span>PUT</span> y el cuerpo de la solicitud debe contener un JSON que incluya: "id", "titulo", "descripcion", "precio" y "img_url".</p>
        </div>
        <div>
            <h2>Para eliminar un anuncio</h2>
            <p>Se debe hacer por <span>DELETE</span> y el cuerpo de la solicitud debe contener un JSON que incluya: "id".</p>
        </div>
        <div>
            <h2>Para obtener los anuncios</h2>
            <p>Se debe hacer por <span>GET</span>; este no requiere token, y si dispones de uno, no caducar&aacute; despu&eacute;s de solicitar los anuncios.</p>
        </div>
    </div>
</main>
