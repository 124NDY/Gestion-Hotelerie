@extends('layouts.app')

@section('title', 'Facture')
@section('page-title', 'Facture')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="flex justify-end gap-3 mb-4">
        <a href="{{ route('payments.facture.pdf', $payment) }}"
           class="bg-gray-800 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded-lg transition text-sm">
            Telecharger PDF
        </a>
        <button onclick="window.print()"
                class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold px-4 py-2 rounded-lg transition text-sm">
            Imprimer
        </button>
    </div>

    <div id="facture" class="bg-white rounded-xl shadow p-10 text-gray-800">

        <!-- En-tete -->
        <div class="flex justify-between items-start mb-10">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Laravel Hotel</h1>
                <p class="text-sm text-gray-500 mt-1">123 Avenue des Palmes, Paris</p>
                <p class="text-sm text-gray-500">contact@hotelluxe.com</p>
            </div>
            <div class="text-right">
                <p class="text-2xl font-bold text-yellow-500">FACTURE</p>
                <p class="text-sm text-gray-500 mt-1">N° {{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</p>
                <p class="text-sm text-gray-500">{{ $payment->date_paiement->format('d/m/Y') }}</p>
            </div>
        </div>

        <!-- Infos client -->
        <div class="bg-gray-50 rounded-lg p-5 mb-8">
            <p class="text-xs text-gray-400 uppercase tracking-wide mb-2">Facture a</p>
            <p class="font-semibold text-gray-800">{{ $payment->booking->user->nom }}</p>
            <p class="text-sm text-gray-500">{{ $payment->booking->user->email }}</p>
        </div>

        <!-- Tableau sejour -->
        <table class="w-full text-sm mb-8">
            <thead>
                <tr class="border-b-2 border-gray-200 text-left">
                    <th class="pb-3 font-semibold text-gray-700">Description</th>
                    <th class="pb-3 font-semibold text-gray-700 text-center">Nuits</th>
                    <th class="pb-3 font-semibold text-gray-700 text-right">Prix/nuit</th>
                    <th class="pb-3 font-semibold text-gray-700 text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-100">
                    <td class="py-4">
                        <p class="font-medium">Chambre {{ $payment->booking->room->numero }} - {{ $payment->booking->room->type }}</p>
                        <p class="text-xs text-gray-400 mt-1">
                            Du {{ $payment->booking->date_debut->format('d/m/Y') }}
                            au {{ $payment->booking->date_fin->format('d/m/Y') }}
                        </p>
                    </td>
                    <td class="py-4 text-center">{{ $payment->booking->nuits }}</td>
                    <td class="py-4 text-right">{{ number_format($payment->booking->room->prix_nuit, 2) }} MGA</td>
                    <td class="py-4 text-right font-semibold">{{ number_format($payment->montant, 2) }} MGA</td>
                </tr>
            </tbody>
        </table>

        <!-- Total -->
        <div class="flex justify-end">
            <div class="w-64">
                <div class="flex justify-between py-2 border-t-2 border-gray-800">
                    <span class="font-bold text-gray-800">Total paye</span>
                    <span class="font-bold text-xl text-yellow-500">{{ number_format($payment->montant, 2) }} MGA</span>
                </div>
                <p class="text-xs text-gray-400 mt-2 text-right">Methode : {{ ucfirst($payment->methode) }}</p>
            </div>
        </div>

        <!-- Pied de page facture -->
        <div class="mt-12 pt-6 border-t border-gray-200 text-center">
            <p class="text-xs text-gray-400">Merci pour votre sejour. Nous esperons vous revoir bientot.</p>
            <p class="text-xs text-gray-400 mt-1">Laravel Hotel - Tous droits reserves</p>
        </div>
    </div>
</div>

<style>
@media print {
    aside, header, button, a { display: none !important; }
    #facture { box-shadow: none; margin: 0; padding: 20px; }
}
</style>

@endsection