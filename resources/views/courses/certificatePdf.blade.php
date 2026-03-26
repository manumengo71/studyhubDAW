<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Certificado de Finalización</title>
    <style>
        @page {
            margin: 0px;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
            color: #1e293b;
        }
        .container {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            background: #ffffff;
            border: 15px solid #4f46e5;
        }
        .inner-border {
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border: 2px solid #e2e8f0;
            text-align: center;
            padding-top: 40px;
        }
        .content-wrapper {
            position: relative;
            z-index: 10;
        }
        .logo {
            font-size: 32px;
            font-weight: bold;
            color: #4f46e5;
            letter-spacing: 2px;
            margin-bottom: 30px;
        }
        .title {
            font-size: 48px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .subtitle {
            font-size: 18px;
            color: #64748b;
            margin-bottom: 50px;
        }
        .text {
            font-size: 20px;
            color: #334155;
            margin-bottom: 20px;
        }
        .name {
            font-size: 36px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 20px;
            text-decoration: underline;
        }
        .course-name {
            font-size: 28px;
            font-weight: bold;
            color: #4338ca;
            margin-top: 20px;
            margin-bottom: 50px;
        }
        .footer {
            margin-top: 60px;
            font-size: 16px;
            color: #475569;
        }
        .signature {
            margin-top: 40px;
            width: 300px;
            margin-left: auto;
            margin-right: auto;
            border-top: 1px solid #94a3b8;
            padding-top: 10px;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 150px;
            color: rgba(79, 70, 229, 0.03);
            white-space: nowrap;
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="watermark">StudyHub</div>
        <div class="inner-border">
            <div class="content-wrapper">
                <div class="logo">STUDYHUB</div>
                
                <div class="title">Certificado de Finalización</div>
                <div class="subtitle">Otorgado oficialmente por completar exitosamente el curso</div>
                
                <div class="text">Se certifica que</div>
                <div class="name">{{ mb_strtoupper($user->name . ' ' . $user->last_name) }}</div>
                
                <div class="text">ha completado satisfactoriamente todos los módulos y evaluaciones del curso:</div>
                <div class="course-name">"{{ mb_strtoupper($course->name) }}"</div>
                
                <div class="footer">
                    <p>Fecha de finalización: <strong>{{ $date }}</strong></p>
                    <div class="signature">
                        <strong>StudyHub Platform</strong><br>
                        <small>Director Académico</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
