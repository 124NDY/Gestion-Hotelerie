@extends('layouts.app')

@section('title', 'Nouvelle Réservation')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">➕ Nouvelle Réservation</h4>
    <a href="{{ route('reservations.index') }}" class="btn btn-secondary">⬅️ Retour</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Client</label>
                    <select name="client_id" class="form-select @error('client_id') is-invalid @enderror">
                        <option value="">-- Choisir un client --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->nom }} {{ $client->prenom }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Chambre Disponible</label>
                    <select name="chambre_id" class="form-select @error('chambre_id') is-invalid @enderror">
                        <option value="">-- Choisir une chambre --</option>
                        @foreach($chambres as $chambre)
                            <option value="{{ $chambre->id }}" {{ old('chambre_id') == $chambre->id ? 'selected' : '' }}>
                                Chambre {{ $chambre->numero }} - {{ ucfirst($chambre->type) }} - {{ number_format($chambre->prix, 0, ',', ' ') }} Ar/nuit
                            </option>
                        @endforeach
                    </select>
                    @error('chambre_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Date d'Arrivée</label>
                    <input type="date" name="date_arrivee" class="form-control @error('date_arrivee') is-invalid @enderror"
                        value="{{ old('date_arrivee') }}" min="{{ date('Y-m-d') }}">
                    @error('date_arrivee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Date de Départ</label>
                    <input type="date" name="date_depart" class="form-control @error('date_depart') is-invalid @enderror"
                        value="{{ old('date_depart') }}" min="{{ date('Y-m-d') }}">
                    @error('date_depart') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Calcul automatique -->
                <div class="col-12">
                    <div class="alert alert-info d-none" id="calcul-info">
                        🌙 <span id="nuits-text"></span> nuit(s) —
                        💰 Montant estimé : <strong id="montant-text"></strong> Ar
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label fw-bold">Remarques</label>
                    <textarea name="remarques" class="form-control" rows="2"
                        placeholder="Remarques optionnelles...">{{ old('remarques') }}</textarea>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-warning">💾 Enregistrer</button>
                    <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Calcul automatique du montant
    const prix = {
        @foreach($chambres as $chambre)
            {{ $chambre->id }}: {{ $chambre->prix }},
        @endforeach
    };

    function calculer() {
        const chambreId = document.querySelector('[name="chambre_id"]').value;
        const arrivee = document.querySelector('[name="date_arrivee"]').value;
        const depart = document.querySelector('[name="date_depart"]').value;

        if (chambreId && arrivee && depart) {
            const diff = (new Date(depart) - new Date(arrivee)) / (1000 * 60 * 60 * 24);
            if (diff > 0) {
                const montant = diff * prix[chambreId];
                document.getElementById('nuits-text').textContent = diff;
                document.getElementById('montant-text').textContent = montant.toLocaleString();
                document.getElementById('calcul-info').classList.remove('d-none');
            }
        }
    }

    document.querySelector('[name="chambre_id"]').addEventListener('change', calculer);
    document.querySelector('[name="date_arrivee"]').addEventListener('change', calculer);
    document.querySelector('[name="date_depart"]').addEventListener('change', calculer);
</script>

@endsection