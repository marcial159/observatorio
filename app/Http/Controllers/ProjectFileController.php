<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProjectFileController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'type' => 'required',
            'description' => 'required',
            'issue' => 'required',
            'file' => 'required|file|mimes:pdf'
        ], [
            'type.required' => 'El tipo es requerido.',
            'description.required' => 'La descripción es requerida.',
            'issue.required' => 'Le fecha de emisión es requerida.',
            'file.required' => 'El archivo es requerido.',
            'file.file' => 'El archivo debe ser un archivo.',
            'file.mimes' => 'El archivo debe ser de tipo PDF.',
        ]);

        try {


            $projectFile = new ProjectFile();
            $projectFile->project_id = $request->projectId;
            $projectFile->type = $request->type;
            $projectFile->description = $request->description;
            $projectFile->issue = $request->issue;

            $fileName = $request->type . ' - ' . $projectFile->project->code
                . ' - ' . now()->format('Ymd_His')
                . '.' . $request->file('file')->getClientOriginalExtension();
            $projectFile->file_path = $request->file('file')->storeAs('public/files', $fileName);
            $projectFile->save();

            DB::commit();
            return response()->json(["status" => "success"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["status" => "error", "message" => $e->getMessage()], 500);
        }
    }

    public function list(Request $request)
    {
        $files = ProjectFile::where('project_id', $request->projectId)->get();

        return $files;
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();

        try {
            $projectFile = ProjectFile::find($request->file);

            Storage::delete($projectFile->file_path);

            $projectFile->delete();
            DB::commit();
            return response()->json(["status" => "success"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["status" => "error", "message" => $e->getMessage()], 500);
        }
    }


    public function show(ProjectFile $projectFile)
    {
        return $projectFile;
    }

    public function update(Request $request, ProjectFile $projectFile)
    {
        DB::beginTransaction();

        $request->validate([
            'type' => 'required',
            'description' => 'required',
            'issue' => 'required',
            'file' => 'file|mimes:pdf'
        ], [
            'type.required' => 'El tipo es requerido.',
            'description.required' => 'La descripción es requerida.',
            'issue.required' => 'Le fecha de emisión es requerida.',
            'file.file' => 'El archivo debe ser un archivo.',
            'file.mimes' => 'El archivo debe ser de tipo PDF.',
        ]);

        try {
            $projectFile->type = $request->type;
            $projectFile->description = $request->description;
            $projectFile->issue = $request->issue;




            if ($request->hasFile('file')) {

                $fileName = $request->file('file')->getClientOriginalName();


                $filePath = 'public/files/' . $fileName;
                if (!Storage::exists($filePath)) {
                    Storage::delete($projectFile->file_path);
                    $fileName = $request->type . ' - ' . $projectFile->project->code
                        . ' - ' . now()->format('Ymd_His')
                        . '.' . $request->file('file')->getClientOriginalExtension();
                    $projectFile->file_path = $request->file('file')->storeAs('public/files', $fileName);
                }
            }

            $projectFile->save();

            DB::commit();
            return response()->json(["status" => "success"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["status" => "error", "message" => $e->getMessage()], 500);
        }
    }
}
