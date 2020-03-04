<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin as Adm;
use App\Equipment as Eq;
use App\Room as Rm;
use App\Equipment_Room as Eqrm;
use Illuminate\Support\Facades\DB;

class Admin extends Controller
{

    private function get_navs() {
        $navs = array(
            'home' => '',
            'equipment' => '',
            'room' => '',
            'monitor' => '',
            'settings' => ''
        );

        return $navs;
    }

    private function get_equipment_status($equipments) {
        $status = array();

        $i = 0;
        foreach ($equipments as $equipment) {
            $avail = Eqrm::where('equ_ID_FK', $equipment->equ_ID)->where('eqrm_date_returned', NULL)->get();

            $no_borrowed = 0;
            foreach ($avail as $quantity) {
                $no_borrowed += $quantity->eqrm_quantity;
            }

            if ($no_borrowed < $equipment->equ_quantity)
                $status[$i] = $equipment->equ_quantity - $no_borrowed . ' available';
            else 
                $status[$i] = 'Not available';

            $i++;
        }

        return $status;
    }

    public function index(Request $request) {
        if (! $request->session()->has('admin'))
            return redirect(route('guest'));

        $admin = Adm::where('adm_ID', $request->session()->get('admin'))->get()[0];
        
        $navs = $this->get_navs();
        $navs['home'] = 'active';

        $equipment_room_assign = DB::select(
            'select *, equipment.equ_name, equipment.equ_brand_model, admins.adm_fname, admins.adm_mname, admins.adm_lname
            from equipment_room 
            inner join rooms on equipment_room.room_ID_FK = rooms.room_ID
            inner join equipment on equipment_room.equ_ID_FK = equipment.equ_ID
            inner join admins on equipment_room.adm_ID_FK = admins.adm_ID');

        $equipment_room_return = DB::select(
            "select *, equipment.equ_name, equipment.equ_brand_model, admins.adm_fname, admins.adm_mname, admins.adm_lname
            from equipment_room 
            inner join rooms on equipment_room.room_ID_FK = rooms.room_ID
            inner join equipment on equipment_room.equ_ID_FK = equipment.equ_ID
            inner join admins on equipment_room.adm_ID_FK = admins.adm_ID
            where eqrm_date_returned != ''");

        return view('admin.home', compact('admin', 'navs', 'equipment_room_assign', 'equipment_room_return'));
    }

    public function logout(Request $request) {
        $request->session()->flush();

        return redirect(route('guest'));
    }

    public function equipment(Request $request) {
        $navs = $this->get_navs();
        $navs['equipment'] = 'active';

        $equipments = Eq::all();
        $status = $this->get_equipment_status($equipments);

        return view('admin.equipment', compact('navs', 'equipments', 'status'));
    }

    public function equipment_insert(Request $request) {
        $data = array(
            'adm_ID_FK'         => $request->session()->get('admin'),
            'equ_name'          => $request->input('equ_name'),
            'equ_description'   => $request->input('equ_description'),
            'equ_class_of_asset'=> $request->input('equ_class_of_asset'),
            'equ_brand_model'   => $request->input('equ_brand_model'),
            'equ_unit_cost'     => $request->input('equ_unit_cost'),
            'equ_quantity'      => $request->input('equ_quantity'), 
            'equ_date_acquired' => $request->input('equ_date_acquired'), 
            'equ_warranty'      => $request->input('equ_warranty'), 
            'equ_estimated_life'=> $request->input('equ_estimated_life')
        );

        Eq::create($data);

        return redirect(route('equipment'));
    }

    public function room(Request $request) {
        $navs = $this->get_navs();
        $navs['room'] = 'active';

        $rooms = Rm::all();

        return view('admin.room', compact('navs', 'rooms'));
    }

    public function room_insert(Request $request) {

        $data = array(
            'room_name'         => $request->input('room_name'),
            'room_location'     => $request->input('room_location'),
            'room_description'  => $request->input('room_description'),
            'room_size'         => $request->input('room_size')  
        );

        Rm::create($data);

        return redirect(route('room'));
    }

    public function monitor($room_ID = '') {
        $navs = $this->get_navs();
        $navs['monitor'] = 'active';

        if ($room_ID) {
            $room = Rm::where('room_ID', $room_ID)->get();

            if ($room->count()) {
                $rooms = Rm::all();
                $equipments = Eq::all();
                $status = $this->get_equipment_status($equipments);

                $equipment_room = DB::select(
                    'select *, equipment.equ_name, equipment.equ_brand_model, admins.adm_fname, admins.adm_mname, admins.adm_lname
                    from equipment_room 
                    inner join rooms on equipment_room.room_ID_FK = rooms.room_ID
                    inner join equipment on equipment_room.equ_ID_FK = equipment.equ_ID
                    inner join admins on equipment_room.adm_ID_FK = admins.adm_ID
                    where room_ID_FK = ? AND eqrm_date_returned IS NULL'
                    , [$room_ID]);

                return view('admin.monitor', compact('navs', 'room_ID', 'rooms', 'equipments', 'status', 'equipment_room'));
            }
            else 
                return view('admin.monitor_error', compact('navs'));
        }
        else {
            $room = Rm::first();

            if ($room->count())
                return redirect(route('monitor', ['room_ID' => $room->room_ID]));
            else
                return view('admin.monitor_error', compact('navs'));
        }
    }

    public function monitor_eqrm_insert($room_ID, Request $request) {

        $data = array(
            'room_ID_FK'            => $room_ID,
            'adm_ID_FK'             => $request->session()->get('admin'),
            'equ_ID_FK'             => $request->input('equ_ID_FK'),
            'eqrm_borrower_fname'   => $request->input('eqrm_borrower_fname'),
            'eqrm_borrower_mname'   => $request->input('eqrm_borrower_mname'),
            'eqrm_borrower_lname'   => $request->input('eqrm_borrower_lname'),
            'eqrm_quantity'         => $request->input('eqrm_quantity'),
            'eqrm_start_date'       => $request->input('eqrm_start_date'),
            'eqrm_end_date'         => $request->input('eqrm_end_date')
        
        );

        Eqrm::create($data);

        return redirect(route('monitor', ['room_ID' => $room_ID]));
    }

    public function monitor_eqrm_return($eqrm_ID, Request $request) {

        $eqrm = Eqrm::where('eqrm_ID', $eqrm_ID);
        $eqrm->update(['eqrm_date_returned' => today()]);

        return redirect(route('monitor', ['room_ID' => $eqrm->first()->room_ID_FK]));
    }
}
