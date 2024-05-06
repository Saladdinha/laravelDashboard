<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function updateClient(Request $request)
    {
        $input = $request->all();
        $client = $input['client'];
        DB::table('clients')->where([
            ['client_id', '=', $client['id']],
        ])->update([
            'name' => $client['name'],
            'value' => $client['value'],
            'stage_id' => $client['stage_id'],
            'discount_value' => $client['discount_value'],
            'net_value' => $client['net_value'],
            'gross_value' => $client['gross_value'],
            'credit_value' => $client['credit_value'],
            'extra_value' => $client['extra_value'],
            'enrollment_status' => $client['enrollment_status'],
            'payments_type' => $client['payments_type'],
            'payment_status' => $client['payment_status'],
        ]);

        return DB::table('clients')->get()->where('client_id', '=', $client['id']);
    }
    public function bulkUpdateClient(Request $request)
    {
        $input = $request->all();
        $clients = $input['clients'];
        $result = [];
        foreach ($clients as $k => $client) {
            DB::table('clients')->where([
                ['client_id', '=', $client['id']],
            ])->update([
                'name' => $client['name'],
                'value' => $client['value'],
                'stage_id' => $client['stage_id'],
                'discount_value' => $client['discount_value'],
                'net_value' => $client['net_value'],
                'gross_value' => $client['gross_value'],
                'credit_value' => $client['credit_value'],
                'extra_value' => $client['extra_value'],
                'enrollment_status' => $client['enrollment_status'],
                'payments_type' => $client['payments_type'],
                'payment_status' => $client['payment_status'],
            ]);
            array_push($result, DB::table('clients')->get()->where('client_id', '=', $client['id']));
        }
        return $result;
    }

    public function deleteClient(Request $request)
    {
        $input = $request->all();
        $client = $input['client'];
        DB::table('clients')->where([
            ['client_id', '=', $client['id']],
        ])->delete();

        return DB::table('clients')->get()->where('client_id', '=', $client['id']);
    }
    public function bulkdeleteClient(Request $request)
    {
        $input = $request->all();
        $clients = $input['clients'];
        $results = [];
        foreach ($clients as $k => $client) {
            DB::table('clients')->where([
                ['client_id', '=', $client['id']],
            ])->delete();
        }
        return;
    }
    public function makeCsv(Request $request)
    {
        $input = $request->all();
        $client = $input['client'];
        $name = $client['name'];
        $date = date("d-m-Y H:i:s");
        $fileName = "$name $date.csv";
        $h = '';
        $data = '';
        $enrollments = [];
        $i = 1;
        foreach ($client as $k => $value) {
            if (empty($value)) {
                $value = "null";
            }
            if ($k != "enrollments") {
                if ($i < count($client) - 1) {
                    $h .= "$k,";
                    $data .= "$value,";
                } else {
                    $h .= "$k";
                    $data .= "$value";
                }
                $i++;
            }
        }
        $h .= ",enrollments";
        if (isset($client['enrollments'])) {
            foreach ($client['enrollments'] as $k => $val) {
                array_push($enrollments, implode(";", $val));
            }
            $data .= implode(",", $enrollments);
        }
        $f = fopen('php://output', 'w');
        if ($f === false) {
            die('Error opening the file ' . $fileName);
        }
        fputcsv($f, [$h]);
        fputcsv($f, [$data]);
        fclose($f);
        return json_encode([$f]);
    }
    public function bulkMakeCsv(Request $request)
    {
        $input = $request->all();
        $clients = $input['clients'];
        foreach ($clients as $kk => $client) {
            $name = $client['name'];
            $date = date("d-m-Y H:i:s");
            $fileName = "$name $date.csv";
            $h = '';
            $data = '';
            $enrollments = [];
            $i = 1;
            foreach ($client as $k => $value) {
                if (empty($value)) {
                    $value = "null";
                }
                if ($k != "enrollments") {
                    if ($i < count($client) - 1) {
                        $h .= "$k,";
                        $data .= "$value,";
                    } else {
                        $h .= "$k";
                        $data .= "$value";
                    }
                    $i++;
                }
            }
            $h .= ",enrollments";
            if (isset($client['enrollments'])) {
                foreach ($client['enrollments'] as $k => $val) {
                    array_push($enrollments, implode(";", $val));
                }
                $data .= implode(",", $enrollments);
            }
            $f = fopen('php://output', 'w');
            if ($f === false) {
                die('Error opening the file ' . $fileName);
            }
            if ($kk == 0) {
                fputcsv($f, [$h]);
            }
            fputcsv($f, [$data]);
        }
        fclose($f);
        return json_encode([$f]);
    }
}
