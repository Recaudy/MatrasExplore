<?php

namespace App\Controllers;

use App\Models\AccommodationModel;
use App\Models\DestinationModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Accommodation extends BaseController
{
    public function index(): string
    {
        $accModel = new AccommodationModel();
        $destModel = new DestinationModel();

        $search = $this->request->getVar('search');
        $destinationId = $this->request->getVar('destination');
        $sort = $this->request->getVar('sort');

        $query = $accModel;

        // Apply Search
        if (!empty($search)) {
            $query = $query->like('name', $search);
        }

        // Apply Destination Filter
        if (!empty($destinationId)) {
            $query = $query->where('destination_id', $destinationId);
        }

        // Apply Sorting
        if ($sort === 'price_asc') {
            $query = $query->orderBy('price', 'ASC');
        } elseif ($sort === 'price_desc') {
            $query = $query->orderBy('price', 'DESC');
        } else {
            $query = $query->orderBy('name', 'ASC');
        }

        $accommodations = $query->findAll();

        // Attach associated destination name
        foreach ($accommodations as &$hotel) {
            $dest = $destModel->find($hotel['destination_id']);
            $hotel['destination_name'] = $dest ? $dest['name'] : 'Matras';
        }

        $data = [
            'title' => 'Resorts & Accommodations - Explore Bangka Beaches',
            'meta_description' => 'Find the best hotels, beach cottages, and luxury resorts situated near Bangka\'s coastlines. Book rooms and get property contact details.',
            'accommodations' => $accommodations,
            'search' => $search,
            'destination_id' => $destinationId,
            'sort' => $sort,
            'pageStyles' => ['accommodation.css']
        ];

        return view('accommodation/index', $data);
    }

    public function detail(int $id): string
    {
        $accModel = new AccommodationModel();
        $destModel = new DestinationModel();

        $accommodation = $accModel->find($id);

        if (!$accommodation) {
            throw PageNotFoundException::forPageNotFound("Accommodation property not found: " . esc($id));
        }

        $dest = $destModel->find($accommodation['destination_id']);
        $accommodation['destination_name'] = $dest ? $dest['name'] : 'Matras';

        $data = [
            'title' => $accommodation['name'] . ' - Explore Bangka Beaches',
            'meta_description' => esc($accommodation['description']),
            'accommodation' => $accommodation,
            'pageStyles' => ['accommodation.css']
        ];

        return view('accommodation/detail', $data);
    }
}
