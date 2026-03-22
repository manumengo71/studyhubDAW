<x-app-layout>
    @section('navigation')
    @endsection

    <div class="container mx-auto py-8 p-10 md:pd-0">
        <h1 class="text-3xl font-bold mb-6">Política de Privacidad de StudyHub-App</h1>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">1. Introducción</h2>
            <p class="mb-2">En StudyHub-App, nos comprometemos a proteger la privacidad de nuestros usuarios. Esta
                Política
                de Privacidad describe cómo recopilamos, usamos y compartimos tu información personal cuando utilizas
                nuestra plataforma, ubicada en <a href="{{ url('/') }}"
                    class="text-blue-500 hover:underline">{{ str_replace('http://', '', env('APP_URL')) }}</a>.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">2. Información que Recopilamos</h2>
            <p class="mb-2">Recopilamos diferentes tipos de información para proporcionar y mejorar nuestro servicio:
            </p>
            <ul class="list-disc list-inside mb-2">
                <li><strong>Información Personal:</strong> Nombre, dirección de correo electrónico, número de teléfono y
                    otros datos similares.</li>
                <li><strong>Información de Pago:</strong> Datos necesarios para procesar pagos, como información de
                    tarjetas de crédito.</li>
                <li><strong>Información de Uso:</strong> Datos sobre cómo accedes y utilizas nuestra plataforma.</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">3. Cómo Usamos tu Información</h2>
            <p class="mb-2">Utilizamos la información recopilada para los siguientes propósitos:</p>
            <ul class="list-disc list-inside mb-2">
                <li>Proveer y mantener nuestro servicio.</li>
                <li>Procesar transacciones y gestionar pagos.</li>
                <li>Mejorar y personalizar tu experiencia en nuestra plataforma.</li>
                <li>Comunicarnos contigo, responder a tus preguntas y proporcionar soporte al cliente.</li>
                <li>Enviar actualizaciones, noticias y ofertas especiales relacionadas con StudyHub-App.</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">4. Compartición de Información</h2>
            <p class="mb-2">No compartimos tu información personal con terceros, excepto en las siguientes
                circunstancias:</p>
            <ul class="list-disc list-inside mb-2">
                <li>Con proveedores de servicios que nos ayudan a operar nuestra plataforma.</li>
                <li>Para cumplir con obligaciones legales, responder a solicitudes de autoridades y proteger nuestros
                    derechos.</li>
                <li>En caso de fusión, adquisición o venta de todos o parte de nuestros activos.</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">5. Seguridad de la Información</h2>
            <p class="mb-2">Implementamos medidas de seguridad adecuadas para proteger tu información personal contra
                accesos no autorizados, alteraciones, divulgación o destrucción.</p>
            <p class="mb-2">Sin embargo, ningún método de transmisión por Internet o almacenamiento electrónico es
                100% seguro. Por lo tanto, no podemos garantizar su seguridad absoluta.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">6. Tus Derechos</h2>
            <p class="mb-2">Tienes derecho a acceder, corregir o eliminar tu información personal en cualquier
                momento. Para ejercer estos derechos, por favor contacta a nuestro equipo de soporte en <a
                    href="mailto:hola@StudyHub-App.com"
                    class="text-blue-500 hover:underline">hola@StudyHub-App.com</a>.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">7. Cookies y Tecnologías Similares</h2>
            <p class="mb-2">Usamos cookies y tecnologías similares para mejorar tu experiencia en nuestra plataforma.
                Las cookies nos ayudan a recordar tus preferencias y a rastrear tu uso del sitio web para proporcionarte
                una experiencia más personalizada.</p>
            <p class="mb-2">Puedes ajustar la configuración de tu navegador para rechazar las cookies o alertarte
                cuando se envíen cookies. Sin embargo, algunas partes de nuestra plataforma pueden no funcionar
                correctamente si deshabilitas las cookies.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">8. Enlaces a Otros Sitios Web</h2>
            <p class="mb-2">Nuestra plataforma puede contener enlaces a otros sitios web que no son operados por
                nosotros. Si haces clic en un enlace de un tercero, serás dirigido al sitio de ese tercero. Te
                recomendamos revisar la política de privacidad de cada sitio que visitas.</p>
            <p class="mb-2">No tenemos control sobre y no asumimos responsabilidad por el contenido, políticas de
                privacidad o prácticas de sitios o servicios de terceros.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">9. Cambios a esta Política de Privacidad</h2>
            <p class="mb-2">Podemos actualizar nuestra Política de Privacidad periódicamente. Te notificaremos
                cualquier cambio publicando la nueva Política de Privacidad en esta página.</p>
            <p class="mb-2">Te recomendamos revisar esta Política de Privacidad periódicamente para cualquier cambio.
                Los cambios a esta Política de Privacidad son efectivos cuando se publican en esta página.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">10. Contacto</h2>
            <p class="mb-2">Si tienes alguna pregunta sobre esta Política de Privacidad, por favor contacta con
                nosotros en <a href="mailto:hola@StudyHub-App.com"
                    class="text-blue-500 hover:underline">hola@StudyHub-App.com</a>.</p>
        </section>
    </div>

</x-app-layout>
