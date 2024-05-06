<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Enrollment;
use App\Models\AssociativeClientEnrollment;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        $client = new Client();

        $client->client_id = $request->id;
        $client->name = (isset($request->name) && !empty($request->name)) ? $request->name : "";
        $client->document = $request->document;
        $client->stage_id = $request->stage_id;
        $client->stage = (isset($request->stage) && !empty($request->stage)) ? $request->stage : "";;
        $client->value = $request->value;
        $client->discount_value = $request->discount_value;
        $client->net_value = $request->net_value;
        $client->gross_value = $request->gross_value;
        $client->credit_value = $request->credit_value;
        $client->extra_value = $request->extra_value;
        $client->enrollment_status = $request->enrollment_status;
        $client->payments_type = $request->payments_type;
        $client->payment_status = $request->payment_status;
        $client->inserted_at = $request->created_at;

        $client->save();

        foreach ($request->enrollments as $k => $request_enrollment) {
            $enrollment = new Enrollment();
            $associativeCE = new AssociativeClientEnrollment();

            $enrollment->enrollment_id = $request_enrollment['id'];
            $enrollment->client_id = $client->client_id;
            $enrollment->group = $request_enrollment['group'];
            $enrollment->modality = $request_enrollment['modality'];
            $enrollment->division = $request_enrollment['division'];
            $enrollment->gross_value = $request_enrollment['gross_value'];
            $enrollment->discount_value = $request_enrollment['discount_value'];
            $enrollment->net_value = $request_enrollment['net_value'];

            $associativeCE->client_id = $client->client_id;
            $associativeCE->enrollment_id = $enrollment['enrollment_id'];

            $enrollment->save();
            $associativeCE->save();
        }
        return $request;
    }
}
