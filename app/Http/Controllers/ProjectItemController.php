<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Project;
use App\Models\ProjectItem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectItemController extends Controller
{
    public function resources(Request $request)
    {
        $projectData = Project::where('code', $request->code)->first();

        return [
            'items' => Item::get(),
            'project' => [
                'id' => $projectData->id,
                'code' => $projectData->code,
                'budget' => $projectData->budget,
            ],
        ];
    }

    public function store(Request $request)
    {
        $project = Project::find($request->projectId);

        $request->validate(
            [
                'item' => 'required|exists:items,id',
                'amount' => 'required|numeric|min:0|max:' . $project->available_balance,
            ],
            [
                'item.required' => 'El rubro es requerido',
                'item.exists' => 'El rubro seleccionado es inválido',
                'amount.required' => 'El campo financiamiento es requerido',
                'amount.numeric' => 'El campo financiamiento debe ser un número',
                'amount.min' => 'El campo financiamiento debe ser un número positivo',
                'amount.max' => 'No puede superar el saldo disponible (S/. ' . number_format($project->available_balance, 2) . ')'
            ]
        );

        try {
            DB::beginTransaction();

            $projectItem = new ProjectItem();
            $projectItem->project_id = $project->id;
            $projectItem->item_id = $request->item;
            $projectItem->amount = $request->amount;
            $projectItem->save();

            DB::commit();

            return response()->json(["status" => "success"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["status" => "error", "message" => "Error al guardar el proyecto"], 500);
        }
    }


    public function list(Request $request)
    {
        $project = Project::where('code', $request->projectCode)->first();

        $list = ProjectItem::with(['item'])
            ->where('project_id', $project->id)
            ->orderBy($request->parameter ? $request->parameter : 'id', $request->order ? $request->order : 'desc')
            ->paginate(($request->rows) ? $request->rows : 5);

        return JsonResource::collection($list);
    }

    public function show(ProjectItem $projectItem)
    {
        return [
            "item" => $projectItem->item_id,
            "amount" => $projectItem->amount,
        ];
    }

    public function update(Request $request, ProjectItem $projectItem)
    {
        $project = Project::find($request->projectId);

        $request->validate(
            [
                'item' => 'required|exists:items,id',
                'amount' => ['required', 'numeric', 'min:' . $projectItem->expenses, 'max:' . ($project->available_balance + $projectItem->amount)],
            ],
            [
                'item.required' => 'El rubro es requerido',
                'item.exists' => 'El rubro seleccionado es inválido',
                'amount.required' => 'El campo financiamiento es requerido',
                'amount.numeric' => 'El campo financiamiento debe ser un número',
                'amount.max' => 'No puede superar el saldo disponible (S/. ' . number_format($project->available_balance + $projectItem->amount, 2) . ')',
                'amount.min' => 'El campo financiamiento no puede ser menor al monto ejecutado (S/. ' . number_format($projectItem->expenses, 2) . ')',
            ]
        );

        try {
            DB::beginTransaction();

            $projectItem->item_id = $request->item;
            $projectItem->amount = $request->amount;
            $projectItem->save();

            $projectItem->load('item');

            DB::commit();

            return response()->json($projectItem, 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["status" => "error", "message" => "Error al actualizar el proyecto"], 500);
        }
    }

    public function destroy(ProjectItem $projectItem)
    {
        try {
            $projectItem->concepts()->delete();
            $projectItem->delete();
            return response()->json(["status" => "success"], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => "error", "message" => "Error al eliminar el proyecto"], 500);
        }
    }
}
