<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'App\Http\Controllers\UserController@login');
Route::post('loginWithGoogle', 'App\Http\Controllers\UserController@loginWithGoogle');
Route::post('authenticate', 'App\Http\Controllers\UserController@authenticate');
Route::post('recover', 'App\Http\Controllers\UserController@recover');
Route::post('reset', 'App\Http\Controllers\UserController@reset');

Route::group(['middleware' => ['jwt.verify']], function()
{
    Route::post('admin/dashboard', 'App\Http\Controllers\HomeController@admin');
    
    // Rutas para sesión
    Route::post('me', 'App\Http\Controllers\UserController@me');
    Route::post('refresh', 'App\Http\Controllers\UserController@refresh');
    Route::post('logout', 'App\Http\Controllers\UserController@logout');
    Route::post('report/resources', 'App\Http\Controllers\ReportController@resources');

    // Rutas  para roles
    Route::post('role/list', 'App\Http\Controllers\RoleController@list')->middleware('can:role.list');
    Route::get('role/{role}', 'App\Http\Controllers\RoleController@show')->middleware('can:role.list');
    Route::post('role', 'App\Http\Controllers\RoleController@store')->middleware('can:role.store');
    Route::put('role/{role}', 'App\Http\Controllers\RoleController@update')->middleware('can:role.update');
    Route::delete('role/{role}', 'App\Http\Controllers\RoleController@destroy')->middleware('can:role.destroy');

    // Rutas para personas
    Route::get('person/{document}', 'App\Http\Controllers\PersonController@search');

    // Rutas para usuarios
    Route::post('user/list', 'App\Http\Controllers\UserController@list')->middleware('can:user.list');
    Route::get('user/{user}', 'App\Http\Controllers\UserController@show')->middleware('can:user.list');
    Route::get('user/search/{document}', 'App\Http\Controllers\UserController@search');
    Route::post('user/find', 'App\Http\Controllers\UserController@find');
    Route::post('user/repassword', 'App\Http\Controllers\UserController@repassword');
    Route::post('user', 'App\Http\Controllers\UserController@store')->middleware('can:user.store');
    Route::put('user/{user}', 'App\Http\Controllers\UserController@update')->middleware('can:user.update');
    Route::delete('user/{user}', 'App\Http\Controllers\UserController@destroy')->middleware('can:user.destroy');
    Route::post('user/resources', 'App\Http\Controllers\UserController@resources');

    //Rutas para Sedes
    Route::post( 'headquarter/list', 'App\Http\Controllers\HeadquarterController@list' )->middleware( 'can:headquarter.list' );
    Route::get( 'headquarter/{headquarter}', 'App\Http\Controllers\HeadquarterController@show' )->middleware( 'can:headquarter.list' );
    Route::post( 'headquarter', 'App\Http\Controllers\HeadquarterController@store' )->middleware( 'can:headquarter.store' );
    Route::put( 'headquarter/{headquarter}', 'App\Http\Controllers\HeadquarterController@update' )->middleware( 'can:headquarter.update' );
    Route::delete( 'headquarter/{headquarter}', 'App\Http\Controllers\HeadquarterController@destroy' )->middleware( 'can:headquarter.destroy' );

    //Rutas para Facultades
    Route::post( 'faculty/list', 'App\Http\Controllers\FacultyController@list' )->middleware( 'can:faculty.list' );
    Route::get( 'faculty/{faculty}', 'App\Http\Controllers\FacultyController@show' )->middleware( 'can:faculty.list' );
    Route::post( 'faculty', 'App\Http\Controllers\FacultyController@store' )->middleware( 'can:faculty.store' );
    Route::put( 'faculty/{faculty}', 'App\Http\Controllers\FacultyController@update' )->middleware( 'can:faculty.update' );
    Route::delete( 'faculty/{faculty}', 'App\Http\Controllers\FacultyController@destroy' )->middleware( 'can:faculty.destroy' );

    //Rutas para Carreras
    Route::post( 'career/list', 'App\Http\Controllers\CareerController@list' )->middleware( 'can:career.list' );
    Route::get( 'career/{career}', 'App\Http\Controllers\CareerController@show' )->middleware( 'can:career.list' );
    Route::post( 'career', 'App\Http\Controllers\CareerController@store' )->middleware( 'can:career.store' );
    Route::put( 'career/{career}', 'App\Http\Controllers\CareerController@update' )->middleware( 'can:career.update' );
    Route::delete( 'career/{career}', 'App\Http\Controllers\CareerController@destroy' )->middleware( 'can:career.destroy' );

    //rutas para Laboratorios
    Route::post( 'laboratory/list', 'App\Http\Controllers\LaboratoryController@list' )->middleware( 'can:laboratory.list' );
    Route::get( 'laboratory/{laboratory}', 'App\Http\Controllers\LaboratoryController@show' )->middleware( 'can:laboratory.list' );
    Route::post( 'laboratory', 'App\Http\Controllers\LaboratoryController@store' )->middleware( 'can:laboratory.store' );
    Route::put( 'laboratory/{laboratory}', 'App\Http\Controllers\LaboratoryController@update' )->middleware( 'can:laboratory.update' );
    Route::delete( 'laboratory/{laboratory}', 'App\Http\Controllers\LaboratoryController@destroy' )->middleware( 'can:laboratory.destroy' );

    //Rutas para Concursos
    Route::post( 'announcement/list', 'App\Http\Controllers\AnnouncementController@list' )->middleware( 'can:announcement.list' );
    Route::get( 'announcement/{announcement}', 'App\Http\Controllers\AnnouncementController@show' )->middleware( 'can:announcement.list' );
    Route::post( 'announcement', 'App\Http\Controllers\AnnouncementController@store' )->middleware( 'can:announcement.store' );
    Route::put( 'announcement/{announcement}', 'App\Http\Controllers\AnnouncementController@update' )->middleware( 'can:announcement.update' );
    Route::delete( 'announcement/{announcement}', 'App\Http\Controllers\AnnouncementController@destroy' )->middleware( 'can:announcement.destroy' );

    //rutas inv Estudiantes
    Route::post( 'investigation_student/list', 'App\Http\Controllers\InvestigationStudentController@list' )->middleware( 'can:investigation_student.list' );
    Route::get( 'investigation_student/{investigation_student}', 'App\Http\Controllers\InvestigationStudentController@show' )->middleware( 'can:investigation_student.list' );
    Route::post( 'investigation_student', 'App\Http\Controllers\InvestigationStudentController@store' )->middleware( 'can:investigation_student.store' );
    Route::put( 'investigation_student/{investigation_student}', 'App\Http\Controllers\InvestigationStudentController@update' )->middleware( 'can:investigation_student.update' );
    Route::delete( 'investigation_student/{investigation_student}', 'App\Http\Controllers\InvestigationStudentController@destroy' )->middleware( 'can:investigation_student.destroy' );

    // rutas Estudiantes
    Route::post( 'student/list', 'App\Http\Controllers\StudentController@list' )->middleware( 'can:student.list' );
    Route::get( 'student/{student}', 'App\Http\Controllers\StudentController@show' )->middleware( 'can:student.list' );
    Route::post( 'student', 'App\Http\Controllers\StudentController@store' )->middleware( 'can:student.store' );
    Route::put( 'student/{student}', 'App\Http\Controllers\StudentController@update' )->middleware( 'can:student.update' );
    Route::delete( 'student/{student}', 'App\Http\Controllers\StudentController@destroy' )->middleware( 'can:student.destroy' );

    /*Route::post( 'item/list', 'App\Http\Controllers\ItemController@list' )->middleware( 'can:item.list' );
    Route::get( 'item/{item}', 'App\Http\Controllers\ItemController@show' )->middleware( 'can:item.list' );
    Route::post( 'item', 'App\Http\Controllers\ItemController@store' )->middleware( 'can:item.store' );
    Route::put( 'item/{item}', 'App\Http\Controllers\ItemController@update' )->middleware( 'can:item.update' );
    Route::delete( 'item/{item}', 'App\Http\Controllers\ItemController@destroy' )->middleware( 'can:item.destroy' );*/
    
    //Ruta de los rubros
    Route::post('item/list', 'App\Http\Controllers\ItemController@list');
    Route::post('item', 'App\Http\Controllers\ItemController@store');
    Route::delete('item/{item}', 'App\Http\Controllers\ItemController@destroy');
    Route::put('item/{item}', 'App\Http\Controllers\ItemController@update');
    Route::get('item/{item}', 'App\Http\Controllers\ItemController@show');

    //proyectos incubadora de empresas
    Route::post('project/validate-data', 'App\Http\Controllers\ProjectController@validateData');
    Route::post('project/resources', 'App\Http\Controllers\ProjectController@resources');
    Route::post('project/list', 'App\Http\Controllers\ProjectController@list');
    Route::get('project/{project}', 'App\Http\Controllers\ProjectController@show');
    Route::post('project', 'App\Http\Controllers\ProjectController@store');
    Route::put('project/{project}', 'App\Http\Controllers\ProjectController@update');
    Route::delete('project/{project}', 'App\Http\Controllers\ProjectController@destroy');
    Route::post('project/report-items', 'App\Http\Controllers\ProjectController@reportItems');


    Route::post('project-file', 'App\Http\Controllers\ProjectFileController@store');
    Route::post('project-file/list', 'App\Http\Controllers\ProjectFileController@list');
    Route::delete('project-file/{file}', 'App\Http\Controllers\ProjectFileController@destroy');
    Route::post('project-file/update/{projectFile}', 'App\Http\Controllers\ProjectFileController@update');
    Route::get('project-file/{projectFile}', 'App\Http\Controllers\ProjectFileController@show');


    Route::post('project-item/validate-data', 'App\Http\Controllers\ProjectItemController@validateData');
    Route::post('project-item/resources', 'App\Http\Controllers\ProjectItemController@resources');
    Route::post('project-item/list', 'App\Http\Controllers\ProjectItemController@list');
    Route::post('project-item', 'App\Http\Controllers\ProjectItemController@store');
    Route::delete('project-item/{projectItem}', 'App\Http\Controllers\ProjectItemController@destroy');
    Route::put('project-item/{projectItem}', 'App\Http\Controllers\ProjectItemController@update');
    Route::get('project-item/{projectItem}', 'App\Http\Controllers\ProjectItemController@show');

    Route::post('concept/list', 'App\Http\Controllers\ConceptController@list');
    Route::post('concept', 'App\Http\Controllers\ConceptController@store');
    Route::delete('concept/{concept}', 'App\Http\Controllers\ConceptController@destroy');
    Route::put('concept/{concept}', 'App\Http\Controllers\ConceptController@update');
    Route::get('concept/{concept}', 'App\Http\Controllers\ConceptController@show');

    Route::post('project-stage/list', 'App\Http\Controllers\ProjectStageController@list');
    Route::post('project-stage', 'App\Http\Controllers\ProjectStageController@store');
    Route::delete('project-stage/{projectStage}', 'App\Http\Controllers\ProjectStageController@destroy');
    Route::put('project-stage/{projectStage}', 'App\Http\Controllers\ProjectStageController@update');
    Route::get('project-stage/{projectStage}', 'App\Http\Controllers\ProjectStageController@show');

    Route::post('project-category/list', 'App\Http\Controllers\ProjectCategoryController@list');
    Route::post('project-category', 'App\Http\Controllers\ProjectCategoryController@store');
    Route::delete('project-category/{projectCategory}', 'App\Http\Controllers\ProjectCategoryController@destroy');
    Route::put('project-category/{projectCategory}', 'App\Http\Controllers\ProjectCategoryController@update');
    Route::get('project-category/{projectCategory}', 'App\Http\Controllers\ProjectCategoryController@show');

    Route::post('contest/list', 'App\Http\Controllers\ContestController@list');
    Route::post('contest', 'App\Http\Controllers\ContestController@store');
    Route::delete('contest/{contest}', 'App\Http\Controllers\ContestController@destroy');
    Route::put('contest/{contest}', 'App\Http\Controllers\ContestController@update');
    Route::get('contest/{contest}', 'App\Http\Controllers\ContestController@show');

});
