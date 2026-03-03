<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #2c3e50; font-size: 24px; }
        .header p { margin: 2px 0; }
        .badge { background: #27ae60; color: white; padding: 4px 10px; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background: #2c3e50; color: white; padding: 8px; text-align: left; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        .total { font-size: 16px; font-weight: bold; text-align: right; 
                 margin-top: 20px; color: #2c3e50; }
        .footer { text-align: center; margin-top: 40px; 
                  font-size: 11px; color: #888; }
    </style>
</head>
<body>

    <div class="header">
        <h1>🏨 GestionHotelerie</h1>
        <p>Facture N° : <strong>{{ $facture->numero_facture }}</strong></p>
        <p>Date d'émission : {{ \Carbon\Carbon::parse($facture->date_emission)->format('d/m/Y') }}</p>
        <span class="badge">PAYÉE</span>
    </div>

    <hr>

    <h3>Informations Client</h3>
    <table>
        <tr>
            <td><strong>Nom complet</strong></td>
            <td>{{ $facture->reservation->client->prenom }} {{ $facture->reservation->client->nom }}</td>
        </tr>
        <tr>
            <td><strong>Email</strong></td>
            <td>{{ $facture->reservation->client->email }}</td>
        </tr>
        <tr>
            <td><strong>Téléphone</strong></td>
            <td>{{ $facture->reservation->client->telephone }}</td>
        </tr>
    </table>

    <h3>Détails de la Réservation</h3>
    <table>
        <tr>
            <th>Chambre</th>
            <th>Type</th>
            <th>Arrivée</th>
            <th>Départ</th>
            <th>Nuits</th>
            <th>Prix/Nuit</th>
        </tr>
        <tr>
            <td>N° {{ $facture->reservation->chambre->numero }}</td>
            <td>{{ $facture->reservation->chambre->type }}</td>
            <td>{{ \Carbon\Carbon::parse($facture->reservation->date_arrivee)->format('d/m/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($facture->reservation->date_depart)->format('d/m/Y') }}</td>
            <td>
                {{ \Carbon\Carbon::parse($facture->reservation->date_arrivee)->diffInDays($facture->reservation->date_depart) }}
            </td>
            <td>{{ number_format($facture->reservation->chambre->prix_nuit, 2) }} Ar</td>
        </tr>
    </table>

    <div class="total">
        MONTANT TOTAL : {{ number_format($facture->montant_total, 2) }} Ar
    </div>

    <div class="footer">
        <p>Merci de votre confiance — GestionHotelerie &copy; {{ date('Y') }}</p>
    </div>

</body>
</html>
```

---

## ⚙️ Générer le PDF dans `FactureController.php`

Ouvre le fichier :
```
app/Http/Controllers/FactureController.php