<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Informations utilisateur</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        .card {
            max-width: 400px;
            margin: auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 30px;
            text-align: center;
        }
        .card h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .info {
            margin: 10px 0;
            font-size: 18px;
            color: #555;
        }
        .label {
            font-weight: bold;
            color: #222;
        }
        .download-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .download-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

    <div class="card">
        <h2>Informations de connexion À  {{$zoneWifi->name}}</h2>
        <div class="info"><span class="label">Nom d'utilisateur :</span> {{ $ticket->username }}</div>
        <div class="info"><span class="label">Mot de passe :</span> {{$ticket->password }}</div>
        <div class="info"><span class="label">Prix :</span> {{ round($transaction->price) }} FCFA</div>
        
        <button class="download-btn" onclick="window.print()">{{$zoneWifi->name}}</button>
    </div>

</body>
</html>

