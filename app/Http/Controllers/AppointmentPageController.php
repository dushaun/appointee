<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class AppointmentPageController extends Controller
{
    /**
     * Return view of Appointment
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function appointment($id)
    {
        $appointment = Appointment::findByUID($id);

        return view('appointments.view', compact('appointment'));
    }
}
