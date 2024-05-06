<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $inputs = $request->all();
        if (!$inputs) {
            $clients = DB::table('clients')->get();
        } else {
            $keyword = $inputs['keyword'];
            $fields = explode(',', $inputs['fields']);
            $query = DB::table('clients')->where(function ($query) use ($keyword, $fields, $inputs) {
                if (in_array("name", $fields)) {
                    $query->orWhere("name", 'LIKE', $keyword);
                }
                if (in_array("document", $fields)) {
                    $query->orWhere("document", 'LIKE', $keyword);
                }
                if (in_array("stage", $fields)) {
                    $query->orWhere("stage", 'LIKE', $keyword);
                }
                foreach ($inputs as $column => $value) {
                    if ($column != "keyword" && $column != "fields" && !empty($value)) {
                        $query->orWhere($column, 'LIKE', $value);
                    }
                }
            });
            $clients = $query->get();
        }
        foreach ($clients as $key => $client) {
            $client->enrollments = DB::table('enrollments')->get()->where('client_id', $client->client_id);
        }
        $route = Route::current()->getName();
        return view('dashboard')->with(array('clients' => $clients, 'route' => $route));
    }
    public function emails()
    {
        return view('emails');
    }
    public function csv()
    {
        $clients = DB::table('clients')->get();
        foreach ($clients as $key => $client) {
            $client->enrollments = DB::table('enrollments')->get()->where('client_id', $client->client_id);
        }
        $route = Route::current()->getName();
        return view('csv')->with(array('clients' => $clients, 'route' => $route));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
