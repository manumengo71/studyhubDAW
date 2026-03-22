<x-app-layout>
    @section('navigation')
    @endsection

    <div class="container mx-auto py-8 p-10 md:pd-0">
        <h1 class="text-3xl font-bold mb-6">Términos y Condiciones de StudyHub-App</h1>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">1. Introducción</h2>
            <p class="mb-2">Bienvenido a StudyHub-App. Estos términos y condiciones describen las reglas y
                regulaciones para el uso de nuestro sitio web y aplicación, ubicados en <a href="{{ url('/') }}"
                    class="text-blue-500 hover:underline">{{ str_replace('http://', '', env('APP_URL')) }}</a></p>
            <p class="mb-2">Al acceder a este sitio web, asumimos que aceptas estos términos y condiciones. No
                continúes usando StudyHub-App si no estás de acuerdo con todos los términos y condiciones establecidos
                en esta página.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">2. Terminología</h2>
            <p class="mb-2">La terminología siguiente se aplica a estos Términos y Condiciones, Declaración de
                Privacidad y Aviso de Exención de Responsabilidad y todos los Acuerdos:</p>
            <ul class="list-disc list-inside mb-2">
                <li>"Cliente", "Tú" y "Tu" se refieren a ti, la persona que se registra en este sitio web y cumple con
                    los términos y condiciones de la empresa.</li>
                <li>"La Empresa", "Nosotros", "Nuestro" y "Nos" se refieren a nuestra empresa.</li>
                <li>"Parte", "Partes" o "Nosotros" se refiere tanto al Cliente como a nosotros mismos.</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">3. Servicios Ofrecidos</h2>
            <p class="mb-2">StudyHub-App es una plataforma que permite la compra y creación de cursos en línea sobre
                diversas temáticas. Los usuarios pueden registrarse, comprar cursos, crear sus propios cursos y
                gestionar su perfil a través de nuestra aplicación.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">4. Cuentas de Usuario</h2>
            <p class="mb-2">Para acceder a ciertas funcionalidades de nuestra plataforma, debes crear una cuenta. Eres
                responsable de mantener la confidencialidad de tu cuenta y contraseña y de restringir el acceso a tu
                computadora para evitar el acceso no autorizado a tu cuenta.</p>
            <p class="mb-2">Nos reservamos el derecho de rechazar el servicio, cancelar cuentas, eliminar o editar
                contenido, o cancelar pedidos a nuestra discreción.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">5. Pagos y Facturación</h2>
            <p class="mb-2">Todos los pagos por los cursos adquiridos en StudyHub-App deben realizarse a través de
                los métodos de pago disponibles en nuestra plataforma. Los usuarios pueden agregar y eliminar métodos de
                pago en la sección de Información de Pago de su perfil.</p>
            <p class="mb-2">Una vez completada la compra, se generará un recibo que podrá ser descargado en formato
                PDF.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">6. Contenido Generado por el Usuario</h2>
            <p class="mb-2">Los usuarios pueden crear y subir contenido a nuestra plataforma. Eres responsable del
                contenido que publicas y debes asegurarte de que no viola los derechos de terceros ni leyes aplicables.
            </p>
            <p class="mb-2">Nos reservamos el derecho de eliminar cualquier contenido que consideremos inapropiado o
                que infrinja estos términos y condiciones.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">7. Roles y Permisos</h2>
            <p class="mb-2">StudyHub-App incorpora un sistema de roles y permisos para proteger las rutas y
                funcionalidades de la aplicación. Los administradores tienen acceso a un panel de control con
                capacidades CRUD completas y otras funcionalidades avanzadas.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">8. Privacidad</h2>
            <p class="mb-2">Respetamos tu privacidad y estamos comprometidos a proteger tus datos personales. Consulta
                nuestra <a href="{{ url('/politicaPrivacidad') }}" class="text-blue-500 hover:underline">Política de
                    Privacidad</a> para obtener más detalles sobre cómo manejamos tu información.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">9. Limitación de Responsabilidad</h2>
            <p class="mb-2">En ningún caso StudyHub-App será responsable de ningún daño indirecto, incidental,
                especial, consecuente o punitivo, incluyendo, sin limitación, la pérdida de beneficios, datos, uso,
                fondo de comercio u otras pérdidas intangibles, resultantes de (i) tu uso o acceso o la incapacidad de
                usar o acceder a la plataforma; (ii) cualquier conducta o contenido de cualquier tercero en la
                plataforma; (iii) cualquier contenido obtenido de la plataforma; y (iv) el acceso, uso o alteración no
                autorizado de tus transmisiones o contenido, basado en garantía, contrato, agravio (incluyendo
                negligencia) o cualquier otra teoría legal, independientemente de si hemos sido informados de la
                posibilidad de dicho daño, e incluso si se encuentra que un remedio establecido en este documento ha
                fallado en su propósito esencial.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">10. Modificaciones a los Términos y Condiciones</h2>
            <p class="mb-2">Nos reservamos el derecho de modificar estos términos y condiciones en cualquier momento.
                Te notificaremos sobre cualquier cambio publicando los nuevos términos en nuestra plataforma. Es tu
                responsabilidad revisar estos términos periódicamente.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">11. Contacto</h2>
            <p class="mb-2">Si tienes alguna pregunta sobre estos términos y condiciones, por favor, contáctanos en <a
                    href="mailto:hola@StudyHub-App.com"
                    class="text-blue-500 hover:underline">hola@StudyHub-App.com</a>.</p>
        </section>
    </div>

</x-app-layout>
