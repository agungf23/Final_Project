<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Support\Facades\Log;

class DataController extends Controller
{
    // INDEX
    public function index()
    {
        return Data::all();
    }

    // POST
    public function store(Request $request)
    {
        $request->validate([
            'device_id' => 'required|exists:devices,id',
            'value'     => 'required|numeric',
            'max_value' => 'required|integer',
            'min_value' => 'required|integer',
        ]);

        $datalog = new Data();
        $datalog->device_id = $request->device_id;
        $datalog->value     = $request->value;
        $datalog->max_value = $request->max_value;
        $datalog->min_value = $request->min_value;
        if ($datalog->save()) {
            $data = [
                'device_id' => $request->device_id,
                'value'     => $request->value,
                'max_value' => $request->max_value,
                'min_value' => $request->min_value,
            ];

            try {
                $mqtt = MQTT::connection();
                $mqtt->publish('data/datas', json_encode($data));
                Log::info('Published data to MQTT topic: data/datas'); // Log successful publish
            } catch (\Exception $e) {
                Log::error('Error publishing data to MQTT: ' . $e->getMessage()); // Log any errors
            }

            return response()->json(["message" => "Data created and published to MQTT."], 201);
        } else {
            return response()->json(["message" => "Failed to create device."], 500);
        }
    }

    // GET
    public function show(string $id)
    {
        return Data::find($id);
    }

    // PUT
    public function update(Request $request, string $id)
    {
        $request->validate([
            'device_id' => 'sometimes|required|exists:devices,id',
            'value'     => 'sometimes|required|numeric',
            'max_value' => 'sometimes|required|integer',
            'min_value' => 'sometimes|required|integer',
        ]);

        if (Data::where('id', $id)->exists()) {
            $datalog = Data::find($id);
            $datalog->device_id =   $request->input('device_id', $datalog->device_id);
            $datalog->value     =   $request->input('value', $datalog->value);
            $datalog->max_value =   $request->input('max_value', $datalog->max_value);
            $datalog->min_value =   $request->input('min_value', $datalog->min_value);
            $datalog->save();

            return response()->json(["message" => "Device updated."], 201);
        } else {
            return response()->json(["message" => "Device not found."], 404);
        }
    }

    // DELETE
    public function destroy(string $id)
    {
        if (Data::where('id', $id)->exists()) {
            $datalog = Data::find($id);
            $datalog->delete();
            return response()->json(["message" => "Data deleted."], 201);
        } else {
            return response()->json(["message" => "Data not found."], 404);
        }
    }
}
