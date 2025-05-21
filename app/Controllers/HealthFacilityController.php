<?php

namespace App\Controllers;

use App\Models\MapModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class HealthFacilityController extends BaseController
{
    protected $mapModel;

    public function __construct()
    {
        $this->mapModel = new MapModel();
    }

    public function listPuskesmas()
    {
        return $this->listByAmenity('Puskesmas');
    }

    public function listRumahSakit()
    {
        return $this->listByAmenity('Rumah Sakit');
    }

    public function listKlinik()
    {
        return $this->listByAmenity('Klinik');
    }

    private function listByAmenity(string $amenity)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'You must log in first.');
        }

        $facilities = $this->mapModel->getFacilitiesWithCoordinatesByAmenity($amenity);

        return view('dashboard/list_' . strtolower(str_replace(' ', '', $amenity)), [
            'facilities' => $facilities,
            'amenity'    => $amenity,
            'username'   => $session->get('username'),
            'email'      => $session->get('email'),
        ]);
    }

    public function edit(int $id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Anda harus login dulu.');
        }

        $facility = $this->mapModel->getFacilityWithCoordinates($id);


        if (!$facility) {
            throw new PageNotFoundException("Facility dengan ID $id tidak ditemukan.");
        }

        if ($this->request->getMethod() === 'POST') {
            $post = $this->request->getPost();
            log_message('debug', 'POST request detected');


            $facility->fill([
                'code'          => $post['code'] ?: null,
                'name'          => $post['name'] ?: null,
                'address'       => $post['address'] ?: null,
                'district'      => $post['district'] ?: null,
                'amenity'       => $post['amenity'] ?: null,
                'class'         => $post['class'] ?: null,
                'hospital_type' => $post['hospital_type'] ?: null,
                'lat'           => $post['lat'] !== '' ? (float) $post['lat'] : null,
                'lng'           => $post['lng'] !== '' ? (float) $post['lng'] : null,
            ]);

            $ok = $this->mapModel->saveWithLatLng($facility);
            if ($ok) {
                return redirect()->back()->with('message', 'Data berhasil diperbarui.');
            }
            return redirect()->back()->with('error', 'Gagal update.')->withInput();
        }

        return view('dashboard/edit_facility', [
            'facility' => $facility,
            'username' => $session->get('username'),
            'email'    => $session->get('email'),
        ]);
    }

    public function delete(int $id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Anda harus login dulu.');
        }

        $facility = $this->mapModel->find($id);
        if (!$facility) {
            throw new PageNotFoundException("Facility dengan ID $id tidak ditemukan.");
        }

        if ($this->mapModel->delete($id)) {
            return redirect()->back()->with('message', 'Data fasilitas berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data fasilitas.');
        }
    }
}
