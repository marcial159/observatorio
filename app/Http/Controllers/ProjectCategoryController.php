<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ProjectCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:project_categories,name',
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

            $projectCategory = new ProjectCategory();
            $projectCategory->name = $request->name;
            $projectCategory->description = $request->description;
            $projectCategory->status = $request->status;
            $projectCategory->save();

            DB::commit();

            return response()->json(["status" => "success"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["status" => "error", "message" => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, ProjectCategory $projectCategory)
    {
        $request->validate([
            'name' => 'required|max:255|unique:project_categories,name,' . $projectCategory->id,
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

            $projectCategory->name = $request->name;
            $projectCategory->description = $request->description;
            $projectCategory->status = $request->status;
            $projectCategory->save();

            DB::commit();

            return response()->json($projectCategory, 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["status" => "error", "message" => $e->getMessage()], 500);
        }
    }

    public function destroy(ProjectCategory $projectCategory)
    {
        try {
            DB::beginTransaction();

            $projectCategory->delete();

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
        $projectStages = ProjectCategory::select('id', 'name', 'description', 'status')
            ->where('name', 'like', '%' . $request->name . '%')
            ->where('status', 'like', '%' . $request->status . '%')
            ->orderBy($request->parameter ? $request->parameter : 'id', $request->order ? $request->order : 'desc')
            ->paginate($request->rows ? $request->rows : 5);

        return JsonResource::collection($projectStages);
    }

    public function show(ProjectCategory $projectCategory)
    {
        return $projectCategory;
    }
}
