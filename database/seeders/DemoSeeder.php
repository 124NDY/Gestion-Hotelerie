<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // Staff
        User::create([
            'nom'       => 'Marie Dupont',
            'email'     => 'receptionniste@hotel.com',
            'password'  => Hash::make('password'),
            'role'      => 'receptionniste',
            'photo_url' => 'default_user.jpg',
        ]);

        // Clients
        $clients = [
            ['nom' => 'Jean Martin',    'email' => 'jean@client.com'],
            ['nom' => 'Sophie Bernard', 'email' => 'sophie@client.com'],
            ['nom' => 'Lucas Petit',    'email' => 'lucas@client.com'],
        ];

        foreach ($clients as $client) {
            User::create([
                'nom'       => $client['nom'],
                'email'     => $client['email'],
                'password'  => Hash::make('password'),
                'role'      => 'client',
                'photo_url' => 'default_user.jpg',
            ]);
        }

        // Chambres
        $rooms = [
            [
                'numero'      => '101',
                'type'        => 'Simple',
                'prix_nuit'   => 89.00,
                'description' => 'Chambre simple elegante avec vue sur le jardin. Lit queen size, salle de bain privee.',
                'statut'      => 'disponible',
            ],
            [
                'numero'      => '102',
                'type'        => 'Simple',
                'prix_nuit'   => 89.00,
                'description' => 'Chambre simple lumineuse au deuxieme etage. Climatisation et wifi inclus.',
                'statut'      => 'disponible',
            ],
            [
                'numero'      => '201',
                'type'        => 'Double',
                'prix_nuit'   => 149.00,
                'description' => 'Chambre double spacieuse avec balcon. Deux lits doubles ou un grand lit king size.',
                'statut'      => 'disponible',
            ],
            [
                'numero'      => '202',
                'type'        => 'Double',
                'prix_nuit'   => 149.00,
                'description' => 'Chambre double avec vue panoramique sur la ville. Minibar et coffre-fort inclus.',
                'statut'      => 'occupee',
            ],
            [
                'numero'      => '301',
                'type'        => 'Suite',
                'prix_nuit'   => 299.00,
                'description' => 'Suite luxueuse avec salon separé, jacuzzi et terrasse privee. Service en chambre 24h/24.',
                'statut'      => 'disponible',
            ],
            [
                'numero'      => '302',
                'type'        => 'Suite',
                'prix_nuit'   => 299.00,
                'description' => 'Suite executive avec bureau, salle de reunion et acces lounge VIP.',
                'statut'      => 'menage',
            ],
            [
                'numero'      => '401',
                'type'        => 'Suite Presidentielle',
                'prix_nuit'   => 599.00,
                'description' => 'La suite presidentielle. Deux chambres, salle a manger privee, cuisine equipee et butler personnel.',
                'statut'      => 'disponible',
            ],
        ];

        foreach ($rooms as $room) {
            Room::create([
                'numero'      => $room['numero'],
                'type'        => $room['type'],
                'prix_nuit'   => $room['prix_nuit'],
                'description' => $room['description'],
                'photo_url'   => 'rooms/default_room.jpg',
                'statut'      => $room['statut'],
            ]);
        }
    }
}