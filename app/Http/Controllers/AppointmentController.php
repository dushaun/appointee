<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Http\Requests\ConvertRequest;
use App\Http\Requests\UpdateAppointment;
use App\Mail\AppointmentCreated;
use App\Mail\AppointmentUpdated;
use App\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    /**
     * @param ConvertRequest $http
     */
    public function convert(ConvertRequest $http)
    {
        $request = Request::find($http['request']['id']);

        $appointment = Appointment::create([
            'name' => $request->name,
            'email' => $request->email,
            'info' => $http->info,
            'date' => date('Y-m-d H:i:s', strtotime($http->date)),
            'unique_link' => str_random(30)
        ]);

        $request->delete();
        Mail::to($appointment->email)->send(new AppointmentCreated($appointment));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function appointments()
    {
        $appointments = Appointment::where('date', '>=', date('Y-m-d'))
            ->get();

        return response()->json([
            'appointments' => $appointments
        ], 200);
    }

    /**
     * @param UpdateAppointment $http
     */
    public function update(UpdateAppointment $http)
    {
        $appointment = Appointment::find($http['appointment']['id']);

        $appointment->name = $http['appointment']['name'];
        $appointment->email = $http['appointment']['email'];
        $appointment->info = $http['appointment']['info'];
        $appointment->date = date('Y-m-d H:i:s', strtotime($http['appointment']['date']));
        $appointment->save();

        Mail::to($appointment->email)->send(new AppointmentUpdated($appointment));
    }
}
