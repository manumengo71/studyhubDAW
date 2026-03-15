<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> StudyHub-App </title>

    <!-- favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <style>
        {{ file_get_contents(public_path('pdf.css')) }}
    </style>
</head>

<body class="bg-gray-100">

    <div class="fluid-container h-screen min-h-screen">
        <div class="bg-white md:p-16 p-10">
            <div class="flex flex-wrap items-center justify-between gap-6 mt-10">
                <div>
                    <h3 class="text-lg font-bold">Datos del cliente:</h3>
                    <p class="text-sm font-medium tracking-widest my-1">{{$billingHistory->billing->owner_surname . " " . $billingHistory->billing->owner_second_surname . ", " . $billingHistory->billing->owner_name}}</p>
                    <p class="text-sm font-medium tracking-widest my-1">{{$billingHistory->buyer->email}}</p>
                    <p class="text-sm font-medium tracking-widest my-1">Método de pago: •••• {{ substr($billingHistory->billing->credit_card_number, -4) }}</p>
                </div>
                <div class="border-s border-gray-900 ps-8">
                    <div class="m-auto flex flex-col items-center justify-center">
                        <x-application-logo class="w-20 h-20 rounded-full" />
                        <h3 class="text-lg font-bold">StudyHub-App</h3>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between my-10">
                <h4 class="text-5xl font-semibold uppercase tracking-widest">Factura</h4>
                <div>
                    <p class="text-base font-semibold">Nº Factura: <span class="ps-10 text-sm">{{ str_pad($billingHistory->id, 5, '0', STR_PAD_LEFT) }}</span></p>
                    <p class="text-base font-semibold">Fecha: <span class="ps-10 text-sm">{{$billingHistory->purchase_date}}</span></p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="border-collapse table-auto w-full text-sm mt-10 whitespace-pre">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-4 border border-e-0 uppercase text-lg font-medium text-start">Curso</th>
                            <th class="p-4 border-y uppercase text-lg font-medium ">Precio</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr>
                            <td class="p-5 text-base font-medium border">{{$billingHistory->course->name}}</td>
                            <td class="p-5 text-base font-medium border text-center overflow-hidden">Gratis</td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td colspan="4" class="p-1 ps-5 text-base font-medium border overflow-hidden">Información relativa al curso</td>
                        </tr>
                        <tr>
                            <td colspan="2" rowspan="1"
                                class="p-5 text-sm font-medium border border-e-1 overflow-hidden">
                                <ul class="-my-20">
                                    <li class="word-wrap: break-word;"><b>Descripción:</b> {{$billingHistory->course->short_description}}</li>
                                    <li class="word-wrap: break-word;"><b>Idioma:</b> {{$billingHistory->course->language}} </li>
                                    <li class="word-wrap: break-word;"><b>Tema:</b> {{$billingHistory->course->courseCategory->name}} </li>
                                    <li class="word-wrap: break-word;"><b>Nº de lecciones:</b> {{$lessonCount}} </li>
                                    <li class="word-wrap: break-word;"><b>Fecha de creación:</b> {{$billingHistory->course->created_at}} </li>
                                    <li class="word-wrap: break-word;"><b>Creador:</b> {{$billingHistory->course->owner->username}} </li>
                                </ul>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-teal-600 p-1"></div>
        <div class="bg-black p-7"></div>
    </div>

</body>

</html>
