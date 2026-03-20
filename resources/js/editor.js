import EditorJS from "@editorjs/editorjs";
import Header from "@editorjs/header";
import List from "@editorjs/list";
import Image from "@editorjs/image";
import Quote from "@editorjs/quote";
import Embed from "@editorjs/embed";
import CodeTool from "@editorjs/code";
import Underline from "@editorjs/underline";
import Marker from "@editorjs/marker";
import InlineCode from "@editorjs/inline-code";
import ChangeCase from "editorjs-change-case";


document.addEventListener("alpine:init", () => {
    console.log("editor.js loaded");

    Alpine.data("editor", (data = {}, readOnly = false) => ({
        open: false,
        editor: null,
        init() {
            let lessonId = document.getElementById("lessonId").value;
            let courseId = document.getElementById("courseId").value;
            console.log("here");
            this.editor = new EditorJS({
                holder: "editor",
                minHeight: 20,
                inlineToolbar: [
                    "link",
                    "bold",
                    "italic",
                    "underline",
                    "marker",
                    "inlineCode",
                    "changeCase",
                ],
                placeholder: "Aquí tu contenido",
                data,
                readOnly,
                tools: {
                    header: {
                        class: Header,
                        inlineToolbar: true,
                    },
                    underline: Underline,
                    inlineCode: {
                        class: InlineCode,
                    },
                    marker: {
                        class: Marker,
                    },
                    changeCase: {
                        class: ChangeCase,
                        config: {
                            showLocaleOption: true,
                            locale: "tr",
                        },
                    },
                    list: {
                        class: List,
                        inlineToolbar: true,
                    },
                    image: {
                        class: Image,
                        config: {
                            endpoints: {
                                byFile: `/post-media/${courseId}/${lessonId}`,
                            },
                            additionalRequestData: {
                                _token: document.querySelector(
                                    'meta[name="csrf"]'
                                )?.content,
                            },
                        },
                    },
                    quote: {
                        class: Quote,
                        inlineToolbar: true,
                        config: {
                            quotePlaceholder: "Enter a quote",
                            captionPlaceholder: "Quote's author",
                        },
                    },
                    embed: {
                        class: Embed,
                        config: {
                            services: {
                                youtube: true,
                                twitter: true,
                                instagram: true,
                                facebook: true,
                            },
                        },
                    },
                    code: {
                        class: CodeTool,
                        config: {
                            placeholder: "Enter a code",
                        },
                    },
                },
            });
        },
        beforeSend() {
            console.log("beforeSend");
            this.editor
                .save()
                .then((outputData) => {
                    document.getElementById("content").value =
                        JSON.stringify(outputData);
                    document.getElementById("post-form").submit();
                })
                .catch((error) => {
                    console.log("Saving failed: ", error);
                });
        },
    }));
});
