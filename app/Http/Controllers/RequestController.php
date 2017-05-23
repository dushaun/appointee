<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestAppointment;
use App\Mail\RequestApproved;
use App\Mail\RequestRejected;
use App\Mail\RequestSubmitted;
use App\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{
    /**
     * @param RequestAppointment $request
     */
    public function request(RequestAppointment $request)
    {
        $submission = Request::create([
            'name' => $request->name,
            'email' => $request->email
        ]);

        Mail::to(config('mail.admin.address'))->send(new RequestSubmitted($submission));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        $requests = Request::whereNull('approved')->get();

        return response()->json([
            'requests' => $requests
        ], 200);
    }

    /**
     * @param HttpRequest $http
     */
    public function approve(HttpRequest $http)
    {
        $request = Request::find($http->id);
        $request->approved = 1;
        $request->save();

        Mail::to($request->email)->send(new RequestApproved());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function approved()
    {
        $requests = Request::where('approved', 1)
            ->orderBy('updated_at')
            ->get();

        return response()->json([
            'requests' => $requests
        ], 200);
    }

    /**
     * @param HttpRequest $http
     */
    public function reject(HttpRequest $http)
    {
        $request = Request::find($http->id);
        $request->approved = 0;
        $request->save();

        Mail::to($request->email)->send(new RequestRejected());
    }
}
