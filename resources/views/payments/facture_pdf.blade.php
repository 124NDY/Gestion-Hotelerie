<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #1f2937; font-size: 13px; margin: 0; padding: 0; }
        .header { background-color: #111827; color: white; padding: 30px 40px; }
        .header h1 { color: #F59E0B; font-size: 28px; margin: 0; }
        .header p { color: #9ca3af; font-size: 11px; margin: 4px 0 0; }
        .facture-title { color: #F59E0B; font-size: 22px; font-weight: bold; text-align: right; }
        .facture-num { color: #6b7280; font-size: 11px; text-align: right; }
        .section { padding: 20px 40px; }
        .client-box { background: #f9fafb; border-radius: 8px; padding: 16px; margin-bottom: 24px; }
        .client-box p { margin: 3px 0; }
        .label { color: #9ca3af; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        thead tr { border-bottom: 2px solid #e5e7eb; }
        th { padding: 10px 0; text-align: left; font-size: 12px; color: #374151; }
        td { padding: 14px 0; border-bottom: 1px solid #f3f4f6; font-size: 12px; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .total-row { border-top: 2px solid #111827; }
        .total-row td { padding-top: 14px; font-weight: bold; font-size: 14px; }
        .gold { color: #F59E0B; }
        .footer { text-align: center; color: #9ca3af; font-size: 10px; padding: 20px 40px; border-top: 1px solid #e5e7eb; margin-top: 40px; }
    </style>
</head>
<body>

<div class="header">
    <table style="width:100%; border:none;">
        <tr>
            <td style="border:none; padding:0;">
                <h1>Laravel</h1>
                <p>123 Avenue des Palmes, Paris</p>
                <p>contact@laravel.com</p>
            </td>
            <td style="border:none; padding:0; text-align:right; vertical-align:top;">
                <div class="facture-title">FACTURE</div>
                <div class="facture-num">N° {{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</div>
                <div class="facture-num">{{ $payment->date_paiement->format('d/m/Y') }}</div>
            </td>
        </tr>
    </table>
</div>

<div class="section">

    <div class="client-box">
        <p class="label">Facture a</p>
        <p style="font-weight:bold; font-size:14px; margin-top:6px;">{{ $payment->booking->user->nom }}</p>
        <p>{{ $payment->booking->user->email }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th class="text-center">Nuits</th>
                <th class="text-right">Prix / nuit</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>Chambre {{ $payment->booking->room->numero }} - {{ $payment->booking->room->type }}</strong><br>
                    <span style="color:#6b7280; font-size:11px;">
                        Du {{ $payment->booking->date_debut->format('d/m/Y') }}
                        au {{ $payment->booking->date_fin->format('d/m/Y') }}
                    </span>
                </td>
                <td class="text-center">{{ $payment->booking->nuits }}</td>
                <td class="text-right">{{ number_format($payment->booking->room->prix_nuit, 2) }} $</td>
                <td class="text-right"><strong>{{ number_format($payment->montant, 2) }} $</strong></td>
            </tr>
            <tr class="total-row">
                <td colspan="3" class="text-right">Total paye</td>
                <td class="text-right gold">{{ number_format($payment->montant, 2) }} $</td>
            </tr>
        </tbody>
    </table>

    <p style="color:#6b7280; font-size:11px; text-align:right;">
        Methode de paiement : {{ ucfirst($payment->methode) }}
    </p>

</div>

<div class="footer">
    Merci pour votre sejour. Nous esperons vous revoir bientot.<br>
    Laravel - Tous droits reserves
</div>

</body>
</html>