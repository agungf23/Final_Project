<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Support\Facades\Log;

class RuleController extends Controller
{
    // INDEX
    public function index()
    {
        return Rule::all();
    }

    // POST
    public function store(Request $request)
    {
        $request->validate([
            'rule_cluster_id' => 'required|integer',
            'sensor_id'       => 'required|exists:datas,id',
            'sensor_operator' => 'required|in:More Than,Less Than',
            'sensor_value'    => 'required|numeric',
            'actuator_id'     => 'required|exists:devices,id',
            'actuator_value'  => 'required|integer',
        ]);

        $rule = new Rule();
        $rule->rule_cluster_id = $request->rule_cluster_id;
        $rule->sensor_id       = $request->sensor_id;
        $rule->sensor_operator = $request->sensor_operator;
        $rule->sensor_value    = $request->sensor_value;
        $rule->actuator_id     = $request->actuator_id;
        $rule->actuator_value  = $request->actuator_value;
        if ($rule->save()) {
            $data = [
                'rule_cluster_id'  => $request->rule_cluster_id,
                'sensor_id'        => $request->sensor_id,
                'sensor_operator'  => $request->sensor_operator,
                'sensor_value'     => $request->sensor_value,
                'actuator_id'      => $request->actuator_id,
                'actuator_value'   => $request->actuator_value
            ];

            try {
                $mqtt = MQTT::connection();
                $mqtt->publish('rule/rules', json_encode($data));
                Log::info('Published rule data to MQTT topic: rule/rules'); // Log successful publish
            } catch (\Exception $e) {
                Log::error('Error publishing data to MQTT: ' . $e->getMessage()); // Log any errors
            }

            return response()->json(["message" => "Rule created and published to MQTT."], 201);
        } else {
            return response()->json(["message" => "Failed to create device."], 500);
        }
    }

    // GET
    public function show(string $id)
    {
        return Rule::find($id);
    }

    // PUT
    public function update(Request $request, string $id)
    {
        $request->validate([
            'rule_cluster_id' => 'sometimes|required|integer',
            'sensor_id'       => 'sometimes|required|exists:datas,id',
            'sensor_operator' => 'sometimes|required|in:more than,less than',
            'sensor_value'    => 'sometimes|required|numeric',
            'actuator_id'     => 'sometimes|required|exists:devices,id',
            'actuator_value'  => 'sometimes|required|numeric',
        ]);

        $rule = Rule::find($id);
        if ($rule) {
            $rule->update($request->all());
            return response()->json(["message" => "Rule updated successfully.", "rule" => $rule], 200);
        } else {
            return response()->json(["message" => "Rule not found."], 404);
        }
    }

    // DELETE
    public function destroy(string $id)
    {
        if (Rule::where('id', $id)->exists()) {
            $rule = Rule::find($id);
            $rule->delete();
            return response()->json(["message" => "Rule deleted."], 201);
        } else {
            return response()->json(["message" => "Rule not found."], 404);
        }
    }
}
