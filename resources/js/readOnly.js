const editor = new EditorJS({
    /**
     * Id del elemento HTML en el que se inicializará Editor.js
     */
    holder: 'readOnlyEditor',

    /**
     * Habilitar el modo de solo lectura
     */
    readOnly: true,

    /**
     * Pasar los datos JSON
     */
    data: data,

    /**
     * En este punto, puedes especificar las herramientas que utilizaste al crear los datos.
     * Asegúrate de que todas las herramientas estén disponibles en este punto.
     */
    tools: {
        // tus herramientas aquí
    }
});
