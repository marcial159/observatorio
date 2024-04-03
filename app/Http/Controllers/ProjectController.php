<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contest;
use App\Models\Laboratory;
use App\Models\ProjectCategory;
use App\Models\ProjectStage;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\Company;
use App\Models\ProjectLaboratory;
use App\Models\ProjectMember;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use App\Models\ProjectFile;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use setasign\Fpdi\Fpdi;

class ProjectController extends Controller
{
    public function list(Request $request)
    {
        $projects = Project::with(['projectStage', 'contest']);

        if ($request->parameter === 'representative') {
            $projects->orderBy(function ($query) use ($request) {
                $query->select(DB::raw("CONCAT(persons.firstname, ' ', persons.lastname) AS representative"))
                    ->from('project_members')
                    ->join('students', 'project_members.student_id', '=', 'students.id')
                    ->join('persons', 'students.person_id', '=', 'persons.id')
                    ->where('project_members.type', 'Representante');
            });
        } else
        if ($request->parameter === 'contest') {
            $projects->orderBy(function ($query) use ($request) {
                $query->select('name as contest')
                    ->from('contests')
                    ->whereColumn('projects.contest_id', 'contests.id');
            });
        } else
        if ($request->parameter === 'stage') {
            $projects->orderBy(function ($query) use ($request) {
                $query->select('name as stage')
                    ->from('project_stages')
                    ->whereColumn('projects.stage_id', 'project_stages.id');
            });
        } else

        if ($request->parameter === 'status') {
            $projects->orderBy(function ($query) use ($request) {
                $query->select(DB::raw("CASE WHEN end_schedule < CURDATE() THEN 'Vencido' WHEN start_schedule > CURDATE() THEN 'Pendiente' ELSE 'En curso' END AS status"));
            });
        } else {
            $projects->orderBy($request->parameter ? $request->parameter : 'id', $request->order ? $request->order : 'desc');
        }

        $projects = $projects->code($request->code)
            ->title($request->title)
            ->status($request->status)
            ->stage($request->stage)
            ->contest($request->contest)
            ->date($request->date)
            ->paginate($request->rows ? $request->rows : 5);

        return JsonResource::collection($projects);
    }

    public function validateData(Request $request)
    {

        $type = $request->type;
        if ($type == 'project') {
            $request->validate([
                'code' => 'bail|required|string|max:50|unique:projects,code' . ($request->method == 'update' ? ',' . $request->projectId : ',code'),
                'title' => 'bail|required|string|unique:projects,title' . ($request->method == 'update' ? ',' . $request->projectId : ',title'),
                'stage' => 'bail|required',
                'category' => 'bail|required',
                'contest' => 'bail|required',
                'budget' => 'bail|required|numeric',
                'resolution' => 'bail|required|string|max:100',
                'resolutionIssuance' => 'bail|required|date',
                'startSchedule' => 'bail|required|date',
                'endSchedule' => 'bail|required|date|after:startSchedule',
                'generalObjective' => 'bail|required|string',
                'specificObjectives' => 'bail|required|string',
            ], [
                'code.required' => 'El campo código es requerido.',
                'code.string' => 'El campo código debe ser una cadena de texto.',
                'code.max' => 'El campo código no puede tener más de 50 caracteres.',
                'code.unique' => 'El código ya está en uso.',
                'title.required' => 'El campo título es requerido.',
                'title.string' => 'El campo título debe ser una cadena de texto.',
                'title.unique' => 'El título ya está en uso.',
                'stage.required' => 'El campo etapa es requerido.',
                'category.required' => 'El campo categoría es requerido.',
                'contest.required' => 'El campo concurso es requerido.',
                'budget.required' => 'El campo presupuesto es requerido.',
                'budget.numeric' => 'El campo presupuesto debe ser un valor numérico.',
                'resolution.required' => 'El campo resolución es requerido.',
                'resolution.string' => 'El campo resolución debe ser una cadena de texto.',
                'resolution.max' => 'El campo resolución no puede tener más de 100 caracteres.',
                'resolutionIssuance.required' => 'El campo fecha de emisión de la resolución es requerido.',
                'resolutionIssuance.date' => 'El campo fecha de emisión de la resolución debe ser una fecha válida.',
                'startSchedule.required' => 'El campo fecha de inicio de programación es requerido.',
                'startSchedule.date' => 'El campo fecha de inicio de programación debe ser una fecha válida.',
                'endSchedule.required' => 'El campo fecha de fin de programación es requerido.',
                'endSchedule.date' => 'El campo fecha de fin de programación debe ser una fecha válida.',
                'endSchedule.after' => 'La fecha de fin de programación debe ser posterior a la fecha de inicio.',
                'generalObjective.required' => 'El campo objetivo general es requerido.',
                'generalObjective.string' => 'El campo objetivo general debe ser una cadena de texto.',
                'specificObjectives.required' => 'El campo objetivos específicos es requerido.',
                'specificObjectives.string' => 'El campo objetivos específicos debe ser una cadena de texto.',
            ]);
        }

        if ($type == 'team') {
            $request->validate([
                'advisor' => 'required',
                'representative' => 'required',
                'memberOne' => 'required',
                'memberTwo' => 'required',
            ], [
                'advisor.required' => 'El campo Asesor es requerido.',
                'representative.required' => 'El campo Representante es requerido.',
                'memberOne.required' => 'El campo Integrante 1 es requerido.',
                'memberTwo.required' => 'El campo Integrante 2 es requerido.',
            ]);
        }

        if ($type == 'company') {
            $request->validate([
                'manager' => 'required',
                'companyName' => 'required|unique:companies,name' . ($request->method == 'update' ? ',' . $request->companyId : ',name'),
                'email' => 'required|email|max:100|unique:companies,email' . ($request->method == 'update' ? ',' . $request->companyId : ',email'),
                'date' => 'required|date',
                'address' => 'required',
            ], [
                'manager.required' => 'El campo gerente es requerido.',
                'companyName.required' => 'El campo nombre de la empresa es requerido.',
                'companyName.unique' => 'El nombre de la empresa ya está en uso.',
                'email.required' => 'El campo correo electrónico es requerido.',
                'email.email' => 'El campo correo electrónico debe ser una dirección de correo válida.',
                'email.max' => 'El campo correo electrónico no puede tener más de 100 caracteres.',
                'email.unique' => 'El correo electrónico ya está en uso.',
                'date.required' => 'El campo fecha es requerido.',
                'date.date' => 'El campo fecha debe ser una fecha válida.',
                'address.required' => 'El campo dirección es requerido.',
            ]);
        }

        return response()->json(["status" => "success"], 200);
    }

    public function resources()
    {
        $students = Student::select(
            'students.id as value',
            DB::raw('CONCAT(persons.firstname, " ", persons.lastname, " - ", students.code) as label')
        )
            ->join('persons', 'students.person_id', '=', 'persons.id')
            ->get();

        $laboratories = Laboratory::select('id as value', DB::raw('CONCAT(name, " - ", ambient) as label'))
            ->get();

        $professors = User::join('types', 'users.type_id', '=', 'types.id')
            ->join('persons', 'users.person_id', '=', 'persons.id')
            ->where('types.name', 'Docente')
            ->select(
                'users.id as value',
                DB::raw('CONCAT(users.firstname, " ", users.lastname, " - ", persons.document) as label')
            )
            ->get();


        return response()->json([
            'categories' => ProjectCategory::get(),
            'stages' => ProjectStage::get(),
            'contests' => Contest::get(),
            'students' => $students,
            'laboratories' => $laboratories,
            'professors' => $professors
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $projectData = $request->project;
            $teamData = $request->team;
            $companyData = $request->company;
            $othersData = $request->others;

            $project = new Project();
            $project->code = $projectData['code'];
            $project->title = $projectData['title'];
            $project->stage_id = $projectData['stage'];
            $project->category_id = $projectData['category'];
            $project->contest_id = $projectData['contest'];
            $project->budget = $projectData['budget'];
            $project->resolution = $projectData['resolution'];
            $project->resolution_issuance = $projectData['resolutionIssuance'];
            $project->start_schedule = $projectData['startSchedule'];
            $project->end_schedule = $projectData['endSchedule'];
            $project->general_objective = $projectData['generalObjective'];
            $project->specific_objectives = $projectData['specificObjectives'];
            $project->advisor_id = $teamData['advisor'];
            $project->laboratory_observation = $othersData['observation'];
            $project->laboratory_production = $othersData['production'];

            $project->save();

            $representative = new ProjectMember();
            $representative->student_id = $teamData['representative'];
            $representative->project_id = $project->id;
            $representative->type = 'Representante';
            $representative->save();

            $memberOne = new ProjectMember();
            $memberOne->student_id = $teamData['memberOne'];
            $memberOne->project_id = $project->id;
            $memberOne->type = 'Integrante 1';
            $memberOne->save();

            $memberTwo = new ProjectMember();
            $memberTwo->student_id = $teamData['memberTwo'];
            $memberTwo->project_id = $project->id;
            $memberTwo->type = 'Integrante 2';
            $memberTwo->save();

            if (isset($teamData['memberThree'])) {
                $memberThree = new ProjectMember();
                $memberThree->student_id = $teamData['memberThree'];
                $memberThree->project_id = $project->id;
                $memberThree->type = 'Integrante 3';
                $memberThree->save();
            }

            if (isset($teamData['memberFour'])) {
                $memberFour = new ProjectMember();
                $memberFour->student_id = $teamData['memberFour'];
                $memberFour->project_id = $project->id;
                $memberFour->type = 'Integrante 4';
                $memberFour->save();
            }

            if (isset($othersData['laboratoryOne'])) {
                $laboratoryOne = new ProjectLaboratory();
                $laboratoryOne->laboratory_id = $othersData['laboratoryOne'];
                $laboratoryOne->project_id = $project->id;
                $laboratoryOne->save();
            }

            if (isset($othersData['laboratoryTwo'])) {
                $laboratoryTwo = new ProjectLaboratory();
                $laboratoryTwo->laboratory_id = $othersData['laboratoryTwo'];
                $laboratoryTwo->project_id = $project->id;
                $laboratoryTwo->save();
            }

            if (isset($othersData['laboratoryThree'])) {
                $laboratoryThree = new ProjectLaboratory();
                $laboratoryThree->laboratory_id = $othersData['laboratoryThree'];
                $laboratoryThree->project_id = $project->id;
                $laboratoryThree->save();
            }

            if (isset($othersData['laboratoryFour'])) {
                $laboratoryFour = new ProjectLaboratory();
                $laboratoryFour->laboratory_id = $othersData['laboratoryFour'];
                $laboratoryFour->project_id = $project->id;
                $laboratoryFour->save();
            }

            if ($companyData) {
                $company = new Company();
                $company->manager_id = $companyData['manager'];
                $company->name = $companyData['companyName'];
                $company->email = $companyData['email'];
                $company->date = $companyData['date'];
                $company->address = $companyData['address'];
                $company->save();

                $project->company_id = $company->id;
                $project->save();
            }


            DB::commit();
            return response()->json(["status" => "success"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["status" => "error", "message" => $e->getMessage()], 500);
        }
    }

    public function show(Project $project)
    {
        $project->makeHidden([
            'created_at', 'updated_at', 'laboratories',
            'members', 'company'
        ]);

        $data = [
            "project" => $project,
            "members" => $project->members->map(function ($member) {
                return [
                    "id" => $member->student_id,
                    "type" => $member->type
                ];
            }),
            "laboratories" => $project->laboratories->map(function ($laboratory) {
                return [
                    "id" => $laboratory->id
                ];
            }),
            "company" => $project->company ? $project->company->makeHidden(['created_at', 'updated_at']) : null
        ];

        return $this->keysToCamelCase($data);
    }

    public function update(Request $request, Project $project)
    {
        DB::beginTransaction();

        try {

            $projectData = $request->project;
            $teamData = $request->team;
            $companyData = $request->company;
            $othersData = $request->others;

            $project->code = $projectData['code'];
            $project->title = $projectData['title'];
            $project->stage_id = $projectData['stage'];
            $project->category_id = $projectData['category'];
            $project->contest_id = $projectData['contest'];
            $project->budget = $projectData['budget'];
            $project->resolution = $projectData['resolution'];
            $project->resolution_issuance = $projectData['resolutionIssuance'];
            $project->start_schedule = $projectData['startSchedule'];
            $project->end_schedule = $projectData['endSchedule'];
            $project->general_objective = $projectData['generalObjective'];
            $project->specific_objectives = $projectData['specificObjectives'];
            $project->advisor_id = $teamData['advisor'];
            $project->laboratory_observation = $othersData['observation'];
            $project->laboratory_production = $othersData['production'];

            $project->save();

            $project->members()->delete();
            $project->projectLaboratories()->delete();

            $representative = new ProjectMember();
            $representative->student_id = $teamData['representative'];
            $representative->project_id = $project->id;
            $representative->type = 'Representante';
            $representative->save();

            $memberOne = new ProjectMember();
            $memberOne->student_id = $teamData['memberOne'];
            $memberOne->project_id = $project->id;
            $memberOne->type = 'Integrante 1';
            $memberOne->save();

            $memberTwo = new ProjectMember();
            $memberTwo->student_id = $teamData['memberTwo'];
            $memberTwo->project_id = $project->id;
            $memberTwo->type = 'Integrante 2';
            $memberTwo->save();

            if (isset($teamData['memberThree'])) {
                $memberThree = new ProjectMember();
                $memberThree->student_id = $teamData['memberThree'];
                $memberThree->project_id = $project->id;
                $memberThree->type = 'Integrante 3';
                $memberThree->save();
            }

            if (isset($teamData['memberFour'])) {
                $memberFour = new ProjectMember();
                $memberFour->student_id = $teamData['memberFour'];
                $memberFour->project_id = $project->id;
                $memberFour->type = 'Integrante 4';
                $memberFour->save();
            }

            if (isset($othersData['laboratoryOne'])) {
                $laboratoryOne = new ProjectLaboratory();
                $laboratoryOne->laboratory_id = $othersData['laboratoryOne'];
                $laboratoryOne->project_id = $project->id;
                $laboratoryOne->save();
            }

            if (isset($othersData['laboratoryTwo'])) {
                $laboratoryTwo = new ProjectLaboratory();
                $laboratoryTwo->laboratory_id = $othersData['laboratoryTwo'];
                $laboratoryTwo->project_id = $project->id;
                $laboratoryTwo->save();
            }

            if (isset($othersData['laboratoryThree'])) {
                $laboratoryThree = new ProjectLaboratory();
                $laboratoryThree->laboratory_id = $othersData['laboratoryThree'];
                $laboratoryThree->project_id = $project->id;
                $laboratoryThree->save();
            }

            if (isset($othersData['laboratoryFour'])) {
                $laboratoryFour = new ProjectLaboratory();
                $laboratoryFour->laboratory_id = $othersData['laboratoryFour'];
                $laboratoryFour->project_id = $project->id;
                $laboratoryFour->save();
            }

            if ($companyData) {
                if ($project->company) {
                    $project->company->manager_id = $companyData['manager'];
                    $project->company->name = $companyData['companyName'];
                    $project->company->email = $companyData['email'];
                    $project->company->date = $companyData['date'];
                    $project->company->address = $companyData['address'];
                    $project->company->save();
                } else {
                    $company = new Company();
                    $company->manager_id = $companyData['manager'];
                    $company->name = $companyData['companyName'];
                    $company->email = $companyData['email'];
                    $company->date = $companyData['date'];
                    $company->address = $companyData['address'];
                    $company->save();

                    $project->company_id = $company->id;
                    $project->save();
                }
            } else {
                if ($project->company) {

                    $project->company_id = null;
                    $project->save();

                    $project->company->delete();
                }
            }

            $project->load('projectStage', 'contest');

            DB::commit();
            return response()->json($project, 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["status" => "error", "message" => $e->getMessage()], 500);
        }
    }

    public function destroy(Project $project)
    {
        DB::beginTransaction();

        try {
            $project->members()->delete();
            $project->projectLaboratories()->delete();
            $project->files()->each(function ($file) {
                if ($file->file_path) {
                    Storage::delete($file->file_path);
                }
            });
            $project->files()->delete();
            $project->items()->each(function ($item) {
                $item->concepts()->delete();
            });
            $project->items()->delete();

            if ($project->company) {
                $project->company_id = null;
                $project->save();
                $project->company->delete();
            }

            $project->delete();

            DB::commit();
            return response()->json(["status" => "success"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["status" => "error", "message" => $e->getMessage()], 500);
        }
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

    public function reportItems(Request $request)
    {
        try {
            $project = Project::with(['projectStage', 'contest', 'category', 'advisor', 'advisor.person', 'items', 'laboratories'])->find($request->id);


            $items = $project->items;



            $data = [
                "project" => $project,
                "items" => $items
            ];


            $pdf = PDF::loadView('reports.project-general', $data);
            $pdf->setPaper('A3', 'portrait');
            $pdf->render();

            $pdfContent = $pdf->output();


            $fileName = "Proyecto Nombre";

            return response($pdfContent, 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="Reporte Proyecto - ' .
                    $fileName . '.pdf"');
        } catch (\Exception $e) {
            return response(["message" => $e->getMessage(), "success" => false], 400);
        }
    }
}
