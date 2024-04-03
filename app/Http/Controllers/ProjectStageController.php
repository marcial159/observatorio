<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectStage;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ProjectStageController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:project_stages,name',
            'status' => 'required|numeric'
        ], [
            'name.required' => 'El nombre es obligatorio',
            'name.max' => 'El nombre no debe tener más de 255 caracteres',
            'name.unique' => 'El nombre ya está en uso',
            'status.required' => 'El estado es obligatorio',
            'status.numeric' => 'El estado debe ser un número'
        ]);

        try {
            DB::beginTransaction();

            $projectStage = new ProjectStage();
            $projectStage->name = $request->name;
            $projectStage->description = $request->description;
            $projectStage->status = $request->status;
            $projectStage->save();

            DB::commit();

            return response()->json(["status" => "success"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["status" => "error", "message" => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, ProjectStage $projectStage)
    {
        $request->validate([
            'name' => 'required|max:255|unique:project_stages,name,' . $projectStage->id,
            'status' => 'required|numeric'
        ], [
            'name.required' => 'El nombre es obligatorio',
            'name.max' => 'El nombre no debe tener más de 255 caracteres',
            'name.unique' => 'El nombre ya está en uso',
            'status.required' => 'El estado es obligatorio',
            'status.numeric' => 'El estado debe ser un número'
        ]);

        try {
            DB::beginTransaction();

            $projectStage->name = $request->name;
            $projectStage->description = $request->description;
            $projectStage->status = $request->status;
            $projectStage->save();

            DB::commit();

            return response()->json($projectStage, 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["status" => "error", "message" => $e->getMessage()], 500);
        }
    }

    public function destroy(ProjectStage $projectStage)
    {
        try {
            DB::beginTransaction();

            $projectStage->delete();

            DB::commit();

            return response()->json(["status" => "success"], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                DB::rollBack();
                return response(["title" => "Error", "message" => "No se puede eliminar porque está relacionado con otros registros.", "success" => false], 400);
            } else {
                DB::rollBack();
                return response(["title" => "Error", "message" => "Error al eliminar. Por favor, inténtalo más tarde.", "success" => false], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response(["title" => "Error", "message" => "Error al eliminar. Por favor, inténtalo más tarde.", "success" => false], 400);
        }
    }

    public function list(Request $request)
    {
        $projectStages = ProjectStage::select('id', 'name', 'description', 'status')
            ->where('name', 'like', '%' . $request->name . '%')
            ->where('status', 'like', '%' . $request->status . '%')
            ->orderBy($request->parameter ? $request->parameter : 'id', $request->order ? $request->order : 'desc')
            ->paginate($request->rows ? $request->rows : 5);

        return JsonResource::collection($projectStages);
    }

    public function show(ProjectStage $projectStage)
    {
        return $projectStage;
    }
}
