@vite(['resources/css/app.css', 'resources/js/app.js'])

@vite(['resources/js/alpine.js'])

<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

<body class="leading-normal tracking-normal text-gray-900" style="font-family: 'Source Sans Pro', sans-serif;">
    <div class="area">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>

    <div class="container mx-auto py-8 p-10 md:pd-0 px-4 content-above">
        <div class="max-w-lg mx-auto">
            <h1 class="text-4xl font-bold text-center mb-8">Preguntas Frecuentes (FAQS) </h1>
            <div class="relative mb-4">
                <input type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                    id="faqSearch" placeholder="Buscar preguntas...">
            </div>

            {{-- <div id="faqList">
                    <div x-data="accordion(1)"
                        class=" mt-4 relative transition-all duration-700 border-2  rounded-xl hover:shadow-2xl faq-item">
                        <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                            <div class="flex items-center justify-between">
                                <span class="tracking-wide faq-title">PLANTILLA</span>
                                <span :class="handleRotate()"
                                    class="transition-transform duration-500 transform fill-current ">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div x-ref="tab" :style="handleToggle()"
                            class="relative overflow-hidden transition-all duration-700 max-h-0 faq-content">
                            <div class="px-6 pb-4 text-gray-600">
                                HOLA
                            </div>
                        </div>
                    </div> --}}

            <div id="faqList">

                <div x-data="accordion(8)"
                    class="bg-white mt-4 relative transition-all duration-700 border-2  rounded-xl hover:shadow-2xl faq-item">
                    <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                        <div class="flex items-center justify-between">
                            <span class="tracking-wide faq-title font-bold">¿Qué encontraré en StudyHub-App?</span>
                            <span :class="handleRotate()"
                                class="transition-transform duration-500 transform fill-current ">
                                <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div x-ref="tab" :style="handleToggle()"
                        class="relative overflow-hidden transition-all duration-700 max-h-0 faq-content">
                        <div class="px-6 pb-4 text-gray-600">
                            <p class="mb-2 font-bold">En StudyHub-App, encontrarás una amplia variedad de cursos
                                tanto gratuitos como de pago en
                                línea sobre diferentes temáticas, incluyendo:</p>
                            <ul class="list-disc list-inside mb-2">
                                <li>Desarrollo Web y Programación</li>
                                <li>Diseño Gráfico y Multimedia</li>
                                <li>Marketing Digital y Redes Sociales</li>
                                <li>Idiomas y Traducción</li>
                                <li>Finanzas y Negocios</li>
                            </ul>
                            <p class="mb-2">Nuestros cursos están diseñados para ayudarte a adquirir
                                nuevas
                                habilidades, mejorar tu currículum y avanzar en tu carrera profesional.</p>

                            <p class="mb-2">Regístrate y descubre por ti mismo todo lo que StudyHub-App
                                puede ofrecerte.</p>
                        </div>
                    </div>
                </div>

                <div x-data="accordion(1)"
                    class="bg-white mt-4 relative transition-all duration-700 border-2  rounded-xl hover:shadow-2xl faq-item">
                    <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                        <div class="flex items-center justify-between">
                            <span class="tracking-wide faq-title font-bold">Registrarse e iniciar sesión</span>
                            <span :class="handleRotate()"
                                class="transition-transform duration-500 transform fill-current ">
                                <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div x-ref="tab" :style="handleToggle()"
                        class="relative overflow-hidden transition-all duration-700 max-h-0 faq-content">
                        <div class="px-6 pb-4 text-gray-600">
                            <p class="mb-2 font-bold">Para registrarte en StudyHub-App, sigue estos pasos:</p>
                            <ol class="list-decimal list-inside mb-2">
                                <li>Ingresa a la página de registro haciendo clic en el botón "Registrarse" en la
                                    esquina superior derecha.</li>
                                <li>Completa el formulario con tu nombre, dirección de correo electrónico y
                                    contraseña.</li>
                                <li>Presiona el botón "Registrarse" para crear tu cuenta.</li>
                            </ol>
                            <p class="mb-2 font-bold">Para iniciar sesión en StudyHub-App, sigue estos pasos:</p>
                            <ol class="list-decimal list-inside mb-2">
                                <li>Ingresa a la página de inicio de sesión haciendo clic en el botón "Iniciar
                                    Sesión" en la esquina superior derecha.</li>
                                <li>Ingresa tu dirección de correo electrónico o username y contraseña.</li>
                                <li>Presiona el botón "Iniciar Sesión" para acceder a tu cuenta.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div x-data="accordion(2)"
                    class="bg-white mt-4 relative transition-all duration-700 border-2  rounded-xl hover:shadow-2xl faq-item">
                    <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                        <div class="flex items-center justify-between">
                            <span class="tracking-wide faq-title font-bold">Restablecer contrseña</span>
                            <span :class="handleRotate()"
                                class="transition-transform duration-500 transform fill-current ">
                                <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div x-ref="tab" :style="handleToggle()"
                        class="relative overflow-hidden transition-all duration-700 max-h-0 faq-content">
                        <div class="px-6 pb-4 text-gray-600">
                            <p class="mb-2 font-bold">Si olvidaste tu contraseña, puedes restablecerla siguiendo
                                estos
                                pasos:</p>
                            <ol class="list-decimal list-inside mb-2">
                                <li>Ingresa a la página de inicio de sesión haciendo clic en el botón "Iniciar
                                    Sesión" en la esquina superior derecha.</li>
                                <li>Presiona el enlace "¿Has olvidado tu contraseña?" debajo del formulario de
                                    inicio
                                    de
                                    sesión.</li>
                                <li>Ingresa tu dirección de correo electrónico y presiona el botón "Enviar
                                    Email".</li>
                                <li>Recibirás un correo electrónico con un enlace para restablecer tu contraseña.
                                </li>
                                <li>Haz clic en el enlace y sigue las instrucciones para crear una nueva
                                    contraseña.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div x-data="accordion(3)"
                    class="bg-white mt-4 relative transition-all duration-700 border-2  rounded-xl hover:shadow-2xl faq-item">
                    <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                        <div class="flex items-center justify-between">
                            <span class="tracking-wide faq-title font-bold">¿Cómo agrego una información de
                                pago?</span>
                            <span :class="handleRotate()"
                                class="transition-transform duration-500 transform fill-current ">
                                <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div x-ref="tab" :style="handleToggle()"
                        class="relative overflow-hidden transition-all duration-700 max-h-0 faq-content">
                        <div class="px-6 pb-4 text-gray-600">
                            <p class="mb-2 font-bold">Para agregar una información de pago en StudyHub-App, sigue
                                estos
                                pasos:</p>
                            <ol class="list-decimal list-inside mb-2">
                                <li>Inicia sesión en tu cuenta de StudyHub-App.</li>
                                <li>Dirígete a la sección de "Información de Pago".</li>
                                <li>Presiona el botón "Añadir".</li>
                                <li>Completa el formulario con los datos de tu tarjeta de crédito o débito.</li>
                                <li>Presiona el botón de subida para agregar la información de pago a tu cuenta.
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div x-data="accordion(4)"
                    class="bg-white mt-4 relative transition-all duration-700 border-2  rounded-xl hover:shadow-2xl faq-item">
                    <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                        <div class="flex items-center justify-between">
                            <span class="tracking-wide faq-title font-bold">¿Son todos los cursos de pago?</span>
                            <span :class="handleRotate()"
                                class="transition-transform duration-500 transform fill-current ">
                                <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div x-ref="tab" :style="handleToggle()"
                        class="relative overflow-hidden transition-all duration-700 max-h-0 faq-content">
                        <div class="px-6 pb-4 text-gray-600">
                            <p class="mb-2">No, en StudyHub-App ofrecemos una amplia variedad de cursos
                                gratuitos y de pago. Puedes explorar nuestra plataforma y acceder a los cursos
                                gratuitos sin necesidad de pagar.</p>
                            <p class="mb-2">Para acceder tanto a los cursos de pago como los gratuitos, es
                                necesario añadir una información de pago a su cuenta. </p>
                        </div>
                    </div>
                </div>

                <div x-data="accordion(6)"
                    class="bg-white mt-4 relative transition-all duration-700 border-2  rounded-xl hover:shadow-2xl faq-item">
                    <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                        <div class="flex items-center justify-between">
                            <span class="tracking-wide faq-title font-bold">Convertirse en creador de
                                contenido</span>
                            <span :class="handleRotate()"
                                class="transition-transform duration-500 transform fill-current ">
                                <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div x-ref="tab" :style="handleToggle()"
                        class="relative overflow-hidden transition-all duration-700 max-h-0 faq-content">
                        <div class="px-6 pb-4 text-gray-600">
                            <p class="mb-2 font-bold">En StudyHub-App buscamos democratizar el conocimiento, por
                                lo que queremos que cualquier usuario pueda aportar sus conocimientos a esta
                                plataforma. Es por ello que para crear un curso, es tan sencillo como seguir estsos
                                pasos:</p>
                            <ol class="list-decimal list-inside mb-2">
                                <li>Inicia sesión en tu cuenta de StudyHub-App.</li>
                                <li>Dirígete a la sección de "Marketplace", donde encontrarás el botón "Nuevo
                                    curso".</li>
                                <li>Completa el formulario con la información de tu curso, incluyendo el título,
                                    descripción, idioma, etc...</li>
                                <li>El precio de tus conocimientos lo decides TÚ.</li>
                                <li>Las ganancias obtenidas de tu curso, se repartirán de la siguiente forma. Un 80%
                                    para ti y un 20% para StudyHub-App para que todo este proyecto siga creciendo.
                                    Tus ganancias las recibirás a principio de cada mes en la tarjeta asociada a tu
                                    cuenta.
                                </li>
                                <li>Presiona el botón "Crear Curso", el cual te mostrará un nuevo formulario para
                                    comenzar a crear las lecciones de tu curso.</li>
                                <li>Existen diferentes tipos de lecciones (PDF, VIDEO, IMAGEN Y UN EDITOR DE TEXTO
                                    ENRIQUECIDO). </li>
                                <li>Una vez que te decidas a publicar tu curso, este tendrá que ser validado por uno
                                    de nuestros administradores para asegurarnos de que tu contenido es adecuado
                                    para todos los públicos.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div x-data="accordion(7)"
                    class="bg-white mt-4 relative transition-all duration-700 border-2  rounded-xl hover:shadow-2xl faq-item">
                    <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                        <div class="flex items-center justify-between">
                            <span class="tracking-wide faq-title font-bold">Soy creador de contenido, y elimino mi
                                cuenta. ¿Qué pasa con los cursos?</span>
                            <span :class="handleRotate()"
                                class="transition-transform duration-500 transform fill-current ">
                                <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div x-ref="tab" :style="handleToggle()"
                        class="relative overflow-hidden transition-all duration-700 max-h-0 faq-content">
                        <div class="px-6 pb-4 text-gray-600">
                            <p class="mb-2">Si decides eliminar tu cuenta de StudyHub-App, todos los
                                cursos que hayas creado pasarán a ser propiedad de StudyHub-App. Si decides volver
                                mas tarde, esos cursos no serán entregados de vuelta a su propietario. </p>
                            <p class="mb-2">No podemos eliminar tus cursos definitivamente, ya que
                                quienes los han comprado deben seguir teniendo acceso a ellos de por vida.</p>
                            <p class="mb-2">Al eliminar tu cuenta, también perderemos acceso a todos los
                                datos de ella, por lo que las ganancias futuras del curso no serán transferidas a su
                                creador.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const searchInput = document.getElementById(
                'faqSearch'); // Asume que tienes un input con id 'faqSearch'
            const faqItems = document.querySelectorAll(
                '.faq-item'); // Asume que cada pregunta frecuente tiene la clase 'faq-item'

            searchInput.addEventListener('input', (e) => {
                const searchText = e.target.value.toLowerCase();

                faqItems.forEach(item => {
                    const title = item.querySelector('.faq-title').textContent
                        .toLowerCase(); // Asume que el título tiene la clase 'faq-title'
                    const content = item.querySelector('.faq-content').textContent
                        .toLowerCase(); // Asume que el contenido tiene la clase 'faq-content'

                    if (title.includes(searchText) || content.includes(searchText)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <script>
        // Faq
        document.addEventListener("alpine:init", () => {
            Alpine.store("accordion", {
                tab: 0
            });

            Alpine.data("accordion", (idx) => ({
                init() {
                    this.idx = idx;
                },
                idx: -1,
                handleClick() {
                    this.$store.accordion.tab =
                        this.$store.accordion.tab === this.idx ? 0 : this.idx;
                },
                handleRotate() {
                    return this.$store.accordion.tab === this.idx ? "-rotate-180" : "";
                },
                handleToggle() {
                    return this.$store.accordion.tab === this.idx ?
                        `max-height: ${this.$refs.tab.scrollHeight}px` :
                        "";
                }
            }));
        });
        //  end faq
    </script>
</body>
