<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Support\Facades\Log;
class DeviceController extends Controller
{
    // Index
    public function index(Request $request)
    {
        $device_name = $request->device_name;
        $devices = Device::orderBy("id", "asc");
        if($device_name){
            $devices = $devices->where("device_name", $device_name);
        }
        $devices = $devices->get();
        return response() -> json($devices);
        // return Device::all();
    }

    // POST
    public function store(Request $request)
    {

        $request->validate([
            'device_name' => 'required|string|max:255',
            'device_type' => 'required|in:Sensor,Actuator',
        ]);

        $device = new Device();
        $device->device_name = $request->device_name;
        $device->device_type = $request->device_type;
        if ($device->save()) {
            $data = [
                'device_name' => $request->device_name,
                'device_type' => $request->device_type,
            ];

            try {
                $mqtt = MQTT::connection();
                $mqtt->publish('device/devices', json_encode($data));
                Log::info('Published device data to MQTT topic: device/devices'); // Log successful publish
            } catch (\Exception $e) {
                Log::error('Error publishing data to MQTT: ' . $e->getMessage()); // Log any errors
            }

            return response()->json(["message" => "Device created and published to MQTT."], 201);
        } else {
            return response()->json(["message" => "Failed to create device."], 500);
        }

    }

    // GET
    public function show(string $id)
    {
        return Device::find($id);
    }

    // PUT
    public function update(Request $request, string $id)
    {
        $request->validate([
            'device_name' => 'sometimes|required',
            'device_type' => 'sometimes|required|in:Sensor,Actuator',
        ]);

        if (Device::where('id', $id)->exists()) {
            $device = Device::find($id);
            $device->device_name = $request->input('device_name', $device->device_name);
            $device->device_type = $request->input('device_type', $device->device_type);
            $device->save();

            return response()->json(["message" => "Device updated."], 201);
        } else {
            return response()->json(["message" => "Device not found."], 404);
        }
    }

    // DELETE
    public function destroy(string $id)
    {
        if (Device::where('id', $id)->exists()) {
            $device = Device::find($id);
            $device->delete();
            return response()->json(["message" => "Device deleted."], 201);
        } else {
            return response()->json(["message" => "Device not found."], 404);
        }
    }
}
