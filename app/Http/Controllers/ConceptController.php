<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concept;
use Illuminate\Support\Facades\DB;
use App\Models\ProjectItem;
use Illuminate\Support\Str;

class ConceptController extends Controller
{


    public function store(Request $request)
    {
        $projectItem = ProjectItem::find($request->projectItem);

        $request->validate(
            [
                'projectItem' => 'required',
                'description' => 'required',
                'siafNumber' => 'nullable',
                'trackingNumber' => 'nullable',
                'orderNumber' => 'nullable',
                'pecosaNumber' => 'nullable',
                'details' => 'required|string',
                'situation' => 'required|string',
                'executedAmount' => 'required|numeric|min:0|max:' . $projectItem->available_amount,
            ],
            [
                'projectItem.required' => 'El rubro es requerido',
                'description.required' => 'La descripción es requerida',
                'details.required' => 'El detalle es requerido',
                'situation.required' => 'La situación es requerida',
                'executedAmount.required' => 'El monto ejecutado es requerido',
                'executedAmount.numeric' => 'El monto ejecutado debe ser un número',
                'executedAmount.min' => 'El monto ejecutado debe ser un número positivo',
                'executedAmount.max' => 'No puede superar el saldo disponible (S/. ' . number_format($projectItem->available_amount, 2) . ')'
            ]
        );

        try {
            DB::beginTransaction();

            $concept = new Concept();
            $concept->item_id = $request->projectItem;
            $concept->description = $request->description;
            $concept->siaf_number = $request->siafNumber;
            $concept->tracking_number = $request->trackingNumber;
            $concept->order_number = $request->orderNumber;
            $concept->pecosa_number = $request->pecosaNumber;
            $concept->details = $request->details;
            $concept->situation = $request->situation;
            $concept->executed_amount = $request->executedAmount;
            $concept->save();

            DB::commit();

            return response()->json(["status" => "success"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["status" => "error", "message" => $e->getMessage()], 500);
        }
    }

    public function list(Request $request)
    {
        $concepts = Concept::where('item_id', $request->projectItem)->get();

        $total = ProjectItem::find($request->projectItem)->amount;
        $balance = $total - $concepts->sum('executed_amount');
        $execution = $concepts->sum('executed_amount');
        $executionPercentage = round(($execution / $total) * 100, 2);

        return $this->keysToCamelCase([
            "list" => $concepts,
            "statistics" => [
                "Total" => $total,
                "Balance" => $balance,
                "Execution" => $execution,
                "ExecutionPercentage" => $executionPercentage
            ]
        ]);
    }

    public function keysToCamelCase($array)
    {
        if (is_object($array)) {
            $array = $array->toArray();
        }

        $result = [];

        foreach ($array as $key => $value) {
            if ($value instanceof \Illuminate\Support\Collection) {
                $value = $value->map(function ($item) {
                    return $this->keysToCamelCase($item);
                });
            } elseif ($value instanceof \Illuminate\Database\Eloquent\Model) {
                $value = $this->keysToCamelCase($value->toArray());
            } elseif (is_array($value)) {
                $value = $this->keysToCamelCase($value);
            }

            $result[Str::camel($key)] = $value;
        }

        return $result;
    }

    public function show(Concept $concept)
    {
        return $this->keysToCamelCase($concept);
    }

    public function update(Request $request, Concept $concept)
    {
        $projectItem = $concept->projectItem;


        $request->validate(
            [
                'description' => 'required',
                'siafNumber' => 'nullable',
                'trackingNumber' => 'nullable',
                'orderNumber' => 'nullable',
                'pecosaNumber' => 'nullable',
                'details' => 'required|string',
                'situation' => 'required|string',
                'executedAmount' => 'required|numeric|min:0|max:' . $projectItem->available_amount + $concept->executed_amount,
            ],
            [
                'description.required' => 'La descripción es requerida',
                'details.required' => 'El detalle es requerido',
                'situation.required' => 'La situación es requerida',
                'executedAmount.required' => 'El monto ejecutado es requerido',
                'executedAmount.numeric' => 'El monto ejecutado debe ser un número',
                'executedAmount.min' => 'El monto ejecutado debe ser un número positivo',
                'executedAmount.max' => 'No puede superar el saldo disponible (S/. ' . number_format($projectItem->available_amount + $concept->executed_amount, 2) . ')'
            ]
        );

        try {
            DB::beginTransaction();

            $concept->description = $request->description;
            $concept->siaf_number = $request->siafNumber;
            $concept->tracking_number = $request->trackingNumber;
            $concept->order_number = $request->orderNumber;
            $concept->pecosa_number = $request->pecosaNumber;
            $concept->details = $request->details;
            $concept->situation = $request->situation;
            $concept->executed_amount = $request->executedAmount;
            $concept->save();

            DB::commit();

            return response()->json(["status" => "success"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["status" => "error", "message" => $e->getMessage()], 500);
        }
    }

    public function destroy(Concept $concept)
    {
        try {
            $concept->delete();
            return response()->json(["status" => "success"], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => "error", "message" => $e->getMessage()], 500);
        }
    }
}
