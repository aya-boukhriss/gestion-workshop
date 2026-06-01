<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
        }
        .certificat {
            width: 100%;
            padding: 40px;
            border: 15px solid #1e40af;
            box-sizing: border-box;
            text-align: center;
        }
        .titre {
            font-size: 36px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .sous-titre {
            font-size: 18px;
            color: #555;
            margin-bottom: 40px;
        }
        .nom {
            font-size: 28px;
            font-weight: bold;
            color: #111;
            margin: 20px 0;
            border-bottom: 2px solid #1e40af;
            display: inline-block;
            padding-bottom: 5px;
        }
        .texte {
            font-size: 16px;
            color: #333;
            margin: 10px 0;
        }
        .workshop {
            font-size: 22px;
            font-weight: bold;
            color: #1e40af;
            margin: 15px 0;
        }
        .details {
            font-size: 14px;
            color: #666;
            margin: 5px 0;
        }
        .numero {
            font-size: 12px;
            color: #999;
            margin-top: 40px;
        }
        .signature {
            margin-top: 50px;
            display: inline-block;
            text-align: center;
        }
        .ligne-signature {
            border-top: 1px solid #333;
            width: 200px;
            margin: 0 auto 5px auto;
        }
    </style>
</head>
<body>
    <div class="certificat">
        <div class="titre">🎓 Certificat de Participation</div>
        <div class="sous-titre">Ce certificat est délivré à</div>

        <div class="nom">{{ $participant }}</div>

        <div class="texte">pour avoir participé au workshop</div>

        <div class="workshop">« {{ $workshop }} »</div>

        <div class="details">📅 Date : {{ $date_debut }} — {{ $date_fin }}</div>
        <div class="details">📍 Lieu : {{ $lieu }}</div>
        <div class="details">👨‍🏫 Formateur : {{ $formateur }}</div>

        <div class="signature">
            <div class="ligne-signature"></div>
            <div>Signature du Formateur</div>
        </div>

        <div class="numero">N° Certificat : {{ $numero }}</div>
    </div>
</body>
</html>