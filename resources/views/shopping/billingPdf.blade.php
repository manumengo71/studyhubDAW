<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>StudyHub-App</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="public\favicon.ico" />
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">

    <div style="background-color: #fff;">

        <div style="max-width: 21cm; margin: 0 auto;">

            <div style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 0.75rem; margin-top: 1rem;">
                <div >
                    <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <img src="https://i.postimg.cc/4yKH00Nd/9f3469e4-2cf4-44e0-bf77-bc28b015f363.jpg" alt="Logo de StudyHub-App" style="width: 100px; height: auto; border-radius: 50%;">
                    </div>
                    {{-- <h3 style="font-size: 1.125rem; font-weight: bold; text-align: center; margin: 0;">StudyHub-App</h3> --}}
                </div>
                <div>
                    <h3 style="font-size: 1.125rem; font-weight: bold; margin: 0;">Datos del cliente:</h3>
                    <p style="font-size: 0.875rem; font-weight: medium; margin: 0.5rem 0;">{{$billingHistory->billing->owner_surname . " " . $billingHistory->billing->owner_second_surname . ", " . $billingHistory->billing->owner_name}}</p>
                    <p style="font-size: 0.875rem; font-weight: medium; margin: 0.5rem 0;">{{$billingHistory->buyer->email}}</p>
                    <p style="font-size: 0.875rem; font-weight: medium; margin: 0.5rem 0;">Método de pago: •••• {{ substr($billingHistory->billing->credit_card_number, -4) }}</p>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem;">
                <h4 style="font-size: 2rem; font-weight: bold; text-transform: uppercase; letter-spacing: 0.25rem; margin: 0;">Factura</h4>
                <div>
                    <p style="font-size: 1.125rem; font-weight: bold; margin: 0;">Nº Factura: <span style="font-size: 0.875rem; padding-left: 1rem;">{{ str_pad($billingHistory->id, 5, '0', STR_PAD_LEFT) }}</span></p>
                    <p style="font-size: 1.125rem; font-weight: bold; margin: 0; padding-top: 0.5rem;">Fecha: <span style="font-size: 0.875rem; padding-left: 1rem;">{{$billingHistory->purchase_date}}</span></p>
                </div>
            </div>

            <div style="overflow-x: auto; margin-top: 2rem;">
                <table style="border-collapse: collapse; width: 100%; font-size: 0.875rem; margin-bottom: 2rem;">
                    <thead>
                        <tr style="background-color: #f3f4f6;">
                            <th style="padding: 1rem; border: 1px solid #333; border-right: 0; text-align: left; text-transform: uppercase; font-weight: bold;">Curso</th>
                            <th style="padding: 1rem; border: 1px solid #333; text-align: left; text-transform: uppercase; font-weight: bold;">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 1rem; border: 1px solid #333;">{{ ucfirst($billingHistory->course->name) }}</td>
                            <td style="padding: 1rem; border: 1px solid #333; text-align: center; overflow: hidden;">{{ $billingHistory->course->price == 0 ? 'Gratis' : number_format($billingHistory->course->price, 2) . '€' }}</td>
                        </tr>
                        <tr style="background-color: #f3f4f6;">
                            <td colspan="2" style="padding: 1rem; border: 1px solid #333; text-align: left; text-transform: uppercase; font-weight: bold;">Información relativa al curso</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 1rem; border: 1px solid #333; overflow: hidden;">
                                <ul style="list-style-type: none; padding-left: 0;">
                                    <li style="word-wrap: break-word;"><b>Descripción:</b> {{$billingHistory->course->short_description}}</li>
                                    <li style="word-wrap: break-word;"><b>Idioma:</b> {{$billingHistory->course->language}}</li>
                                    <li style="word-wrap: break-word;"><b>Tema:</b> {{$billingHistory->course->courseCategory->name}}</li>
                                    <li style="word-wrap: break-word;"><b>Nº de lecciones:</b> {{$lessonCount}}</li>
                                    <li style="word-wrap: break-word;"><b>Fecha de creación:</b> {{$billingHistory->course->created_at}}</li>
                                    <li style="word-wrap: break-word;"><b>Creador:</b> {{$billingHistory->course->owner->username}}</li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div style="position: fixed; bottom: 0; left: 0; width: 100%;">
        <div style="background-color: #4dc0b5; padding: 0.25rem;"></div>
        <div style="background-color: #000; padding: 0.875rem;"></div>
    </div>

</body>

</html>
