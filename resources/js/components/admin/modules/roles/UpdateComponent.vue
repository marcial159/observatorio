<template>
    <div class="modal fade" id="roleUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit="updateEvent" id="roleUpdateForm">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h5 class="modal-title text-sm d-inline-block">
                                    <i class="lni lni-pencil-alt me-1 fw-bold text-success"></i>
                                    Modificar rol
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label">Nombre del rol (*)</label>
                                <input name="name" class="form-control form-control-sm" type="text" maxlength="30" minlength="2" autocomplete="off">
                                <p error="name" class="error"></p>
                            </div>
                        </div>
                        <label class="label-flask text-xs mb-2">Lista de permisos:</label>
                        <div class="row mt-2 mb-3 scroll-permission">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `update-role` )">Roles:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-role" type="checkbox" name="1" value="1" id="u1">
                                    <label class="custom-control-label text-xs" for="u1">Ver roles</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-role" type="checkbox" name="2" value="2" id="u2">
                                    <label class="custom-control-label text-xs" for="u2">Crear roles</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-role" type="checkbox" name="3" value="3" id="u3">
                                    <label class="custom-control-label text-xs" for="u3">Editar roles</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-role" type="checkbox" name="4" value="4" id="u4">
                                    <label class="custom-control-label text-xs" for="u4">Pdf de roles</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-role" type="checkbox" name="5" value="5" id="u5">
                                    <label class="custom-control-label text-xs" for="u5">Excel de roles</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-role" type="checkbox" name="6" value="6" id="u6">
                                    <label class="custom-control-label text-xs" for="u6">Eliminar roles</label>
                                </div>
                            </div>
                            <hr class="separator mt-3">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `update-user` )">Usuarios:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-user" type="checkbox" name="7" value="7" id="u7">
                                    <label class="custom-control-label text-xs" for="u7">Ver usuarios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-user" type="checkbox" name="8" value="8" id="u8">
                                    <label class="custom-control-label text-xs" for="u8">Crear usuarios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-user" type="checkbox" name="9" value="9" id="u9">
                                    <label class="custom-control-label text-xs" for="u9">Editar usuarios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-user" type="checkbox" name="10" value="10" id="u10">
                                    <label class="custom-control-label text-xs" for="u10">Asignar usuario</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-user" type="checkbox" name="11" value="11" id="u11">
                                    <label class="custom-control-label text-xs" for="u11">Pdf de usuarios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-user" type="checkbox" name="12" value="12" id="u12">
                                    <label class="custom-control-label text-xs" for="u12">Excel de usuarios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-user" type="checkbox" name="13" value="13" id="u13">
                                    <label class="custom-control-label text-xs" for="u13">Eliminar usuarios</label>
                                </div>
                            </div>
                            <hr class="separator">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `update-headquarter` )">Sedes:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-headquarter" type="checkbox" name="14" value="14" id="u14">
                                    <label class="custom-control-label text-xs" for="u14">Ver sedes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-headquarter" type="checkbox" name="15" value="15" id="u15">
                                    <label class="custom-control-label text-xs" for="u15">Crear sedes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-headquarter" type="checkbox" name="16" value="16" id="u16">
                                    <label class="custom-control-label text-xs" for="u16">Editar sedes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-headquarter" type="checkbox" name="17" value="17" id="u17">
                                    <label class="custom-control-label text-xs" for="u17">Pdf de sedes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-headquarter" type="checkbox" name="18" value="18" id="u18">
                                    <label class="custom-control-label text-xs" for="u18">Excel de sedes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-headquarter" type="checkbox" name="19" value="19" id="u19">
                                    <label class="custom-control-label text-xs" for="u19">Eliminar sedes</label>
                                </div>
                            </div>
                            <hr class="separator">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `update-faculty` )">Facultades:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-faculty" type="checkbox" name="20" value="20" id="u20">
                                    <label class="custom-control-label text-xs" for="u20">Ver planes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-faculty" type="checkbox" name="21" value="21" id="u21">
                                    <label class="custom-control-label text-xs" for="u21">Crear facultades</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-faculty" type="checkbox" name="22" value="22" id="u22">
                                    <label class="custom-control-label text-xs" for="u22">Editar facultades</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-faculty" type="checkbox" name="23" value="23" id="u23">
                                    <label class="custom-control-label text-xs" for="u23">Pdf de facultades</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-faculty" type="checkbox" name="24" value="24" id="u24">
                                    <label class="custom-control-label text-xs" for="u24">Excel de facultades</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-faculty" type="checkbox" name="25" value="25" id="u25">
                                    <label class="custom-control-label text-xs" for="u25">Eliminar facultades</label>
                                </div>
                            </div>
                            <hr class="separator">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `update-career` )">Carreras:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-career" type="checkbox" name="26" value="26" id="u26">
                                    <label class="custom-control-label text-xs" for="u26">Ver carreras</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-career" type="checkbox" name="27" value="27" id="u27">
                                    <label class="custom-control-label text-xs" for="u27">Crear carreras</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-career" type="checkbox" name="28" value="28" id="u28">
                                    <label class="custom-control-label text-xs" for="u28">Editar carreras</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-career" type="checkbox" name="29" value="29" id="u29">
                                    <label class="custom-control-label text-xs" for="u29">Pdf de carreras</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-career" type="checkbox" name="30" value="30" id="u30">
                                    <label class="custom-control-label text-xs" for="u30">Excel de carreras</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-career" type="checkbox" name="31" value="31" id="u31">
                                    <label class="custom-control-label text-xs" for="u31">Eliminar carreras</label>
                                </div>
                            </div>
                            <hr class="separator">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `update-laboratory` )">Laboratorios:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-laboratory" type="checkbox" name="32" value="32" id="u32">
                                    <label class="custom-control-label text-xs" for="u32">Ver laboratorios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-laboratory" type="checkbox" name="33" value="33" id="u33">
                                    <label class="custom-control-label text-xs" for="u33">Crear laboratorios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-laboratory" type="checkbox" name="34" value="34" id="u34">
                                    <label class="custom-control-label text-xs" for="u34">Editar laboratorios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-laboratory" type="checkbox" name="35" value="35" id="u35">
                                    <label class="custom-control-label text-xs" for="u35">Pdf de laboratorios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-laboratory" type="checkbox" name="36" value="36" id="u36">
                                    <label class="custom-control-label text-xs" for="u36">Excel de laboratorios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-laboratory" type="checkbox" name="37" value="37" id="u37">
                                    <label class="custom-control-label text-xs" for="u37">Eliminar laboratorios</label>
                                </div>
                            </div>
                            <hr class="separator">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `update-convocatory` )">Convocatorias:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-convocatory" type="checkbox" name="38" value="38" id="u38">
                                    <label class="custom-control-label text-xs" for="u38">Ver convocatorias</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-convocatory" type="checkbox" name="39" value="39" id="u39">
                                    <label class="custom-control-label text-xs" for="u39">Crear convocatorias</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-convocatory" type="checkbox" name="40" value="40" id="u40">
                                    <label class="custom-control-label text-xs" for="u40">Editar convocatorias</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-convocatory" type="checkbox" name="41" value="41" id="u41">
                                    <label class="custom-control-label text-xs" for="u41">Pdf de convocatorias</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-convocatory" type="checkbox" name="42" value="42" id="u42">
                                    <label class="custom-control-label text-xs" for="u42">Excel de convocatorias</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-convocatory" type="checkbox" name="43" value="43" id="u43">
                                    <label class="custom-control-label text-xs" for="u43">Eliminar convocatorias</label>
                                </div>
                            </div>
                            <hr class="separator">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `update-line` )">Lineas de investigación:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-line" type="checkbox" name="44" value="44" id="u44">
                                    <label class="custom-control-label text-xs" for="u44">Ver lineas</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-line" type="checkbox" name="45" value="45" id="u45">
                                    <label class="custom-control-label text-xs" for="u45">Crear lineas</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-line" type="checkbox" name="46" value="46" id="u46">
                                    <label class="custom-control-label text-xs" for="u46">Editar lineas</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-line" type="checkbox" name="47" value="47" id="u47">
                                    <label class="custom-control-label text-xs" for="u47">Pdf de lineas</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-line" type="checkbox" name="48" value="48" id="u48">
                                    <label class="custom-control-label text-xs" for="u48">Excel de lineas</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-line" type="checkbox" name="49" value="49" id="u49">
                                    <label class="custom-control-label text-xs" for="u49">Eliminar lineas</label>
                                </div>
                            </div>
                            <hr class="separator">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `update-process` )">Procesos:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-process" type="checkbox" name="50" value="50" id="u50">
                                    <label class="custom-control-label text-xs" for="u50">Ver procesos</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-process" type="checkbox" name="51" value="51" id="u51">
                                    <label class="custom-control-label text-xs" for="u51">Crear procesos</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-process" type="checkbox" name="52" value="52" id="u52">
                                    <label class="custom-control-label text-xs" for="u52">Editar procesos</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-process" type="checkbox" name="53" value="53" id="u53">
                                    <label class="custom-control-label text-xs" for="u53">Pdf de procesos</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-process" type="checkbox" name="54" value="54" id="u54">
                                    <label class="custom-control-label text-xs" for="u54">Excel de procesos</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-process" type="checkbox" name="55" value="55" id="u55">
                                    <label class="custom-control-label text-xs" for="u55">Eliminar procesos</label>
                                </div>
                            </div>
                            <hr class="separator">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `update-lecturer` )">Docentes:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-lecturer" type="checkbox" name="56" value="56" id="u56">
                                    <label class="custom-control-label text-xs" for="u56">Ver docentes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-lecturer" type="checkbox" name="57" value="57" id="u57">
                                    <label class="custom-control-label text-xs" for="u57">Crear docentes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-lecturer" type="checkbox" name="58" value="58" id="u58">
                                    <label class="custom-control-label text-xs" for="u58">Editar docentes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-lecturer" type="checkbox" name="59" value="59" id="u59">
                                    <label class="custom-control-label text-xs" for="u59">Pdf de docentes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-lecturer" type="checkbox" name="60" value="60" id="u60">
                                    <label class="custom-control-label text-xs" for="u60">Excel de docentes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-lecturer" type="checkbox" name="61" value="61" id="u61">
                                    <label class="custom-control-label text-xs" for="u61">Eliminar docentes</label>
                                </div>
                            </div>
                            <hr class="separator">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `update-student` )">Estudiantes:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-student" type="checkbox" name="62" value="62" id="u62">
                                    <label class="custom-control-label text-xs" for="u62">Ver estudiantes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-student" type="checkbox" name="63" value="63" id="u63">
                                    <label class="custom-control-label text-xs" for="u63">Crear estudiantes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-student" type="checkbox" name="64" value="64" id="u64">
                                    <label class="custom-control-label text-xs" for="u64">Editar estudiantes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-student" type="checkbox" name="65" value="65" id="u65">
                                    <label class="custom-control-label text-xs" for="u65">Pdf de estudiantes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-student" type="checkbox" name="66" value="66" id="u66">
                                    <label class="custom-control-label text-xs" for="u66">Excel de estudiantes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-student" type="checkbox" name="67" value="67" id="u67">
                                    <label class="custom-control-label text-xs" for="u67">Eliminar estudiantes</label>
                                </div>
                            </div>
                            <hr class="separator">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `update-undergraduate` )">Tesis:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-undergraduate" type="checkbox" name="68" value="68" id="u68">
                                    <label class="custom-control-label text-xs" for="u68">Ver tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-undergraduate" type="checkbox" name="69" value="69" id="u69">
                                    <label class="custom-control-label text-xs" for="u69">Crear tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-undergraduate" type="checkbox" name="70" value="70" id="u70">
                                    <label class="custom-control-label text-xs" for="u70">Editar tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-undergraduate" type="checkbox" name="71" value="71" id="u71">
                                    <label class="custom-control-label text-xs" for="u71">Asignar tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-undergraduate" type="checkbox" name="72" value="72" id="u72">
                                    <label class="custom-control-label text-xs" for="u72">Proceso de tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-undergraduate" type="checkbox" name="73" value="73" id="u73">
                                    <label class="custom-control-label text-xs" for="u73">Archivos de tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-undergraduate" type="checkbox" name="74" value="74" id="u74">
                                    <label class="custom-control-label text-xs" for="u74">Pdf de tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-undergraduate" type="checkbox" name="75" value="75" id="u75">
                                    <label class="custom-control-label text-xs" for="u75">Excel de tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-undergraduate" type="checkbox" name="76" value="76" id="u76">
                                    <label class="custom-control-label text-xs" for="u76">Correos de tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-undergraduate" type="checkbox" name="77" value="77" id="u77">
                                    <label class="custom-control-label text-xs" for="u77">Eliminar tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-undergraduate" type="checkbox" name="78" value="78" id="u78">
                                    <label class="custom-control-label text-xs" for="u78">Estadisticas de tesis</label>
                                </div>
                            </div>
                            <hr class="separator">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `update-investigation` )">Investigaciones docente:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-investigation" type="checkbox" name="79" value="79" id="u79">
                                    <label class="custom-control-label text-xs" for="u79">Ver investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-investigation" type="checkbox" name="80" value="80" id="u80">
                                    <label class="custom-control-label text-xs" for="u80">Crear investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-investigation" type="checkbox" name="81" value="81" id="u81">
                                    <label class="custom-control-label text-xs" for="u81">Editar investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-investigation" type="checkbox" name="82" value="82" id="u82">
                                    <label class="custom-control-label text-xs" for="u82">Asignar investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-investigation" type="checkbox" name="83" value="83" id="u83">
                                    <label class="custom-control-label text-xs" for="u83">Proceso de investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-investigation" type="checkbox" name="84" value="84" id="u84">
                                    <label class="custom-control-label text-xs" for="u84">Archivos de investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-investigation" type="checkbox" name="85" value="85" id="u85">
                                    <label class="custom-control-label text-xs" for="u85">Pdf de investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-investigation" type="checkbox" name="86" value="86" id="u86">
                                    <label class="custom-control-label text-xs" for="u86">Excel de investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-investigation" type="checkbox" name="87" value="87" id="u87">
                                    <label class="custom-control-label text-xs" for="u87">Correos de investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-investigation" type="checkbox" name="88" value="88" id="u88">
                                    <label class="custom-control-label text-xs" for="u88">Eliminar investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary update-investigation" type="checkbox" name="89" value="89" id="u89">
                                    <label class="custom-control-label text-xs" for="u89">Estadisticas de investigaciones</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-dark btn-sm fs-7 mb-0 me-2" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success btn-sm fs-7 mb-0">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import vuenisimo from '../../../helper/vuenisimo.js'

export default
{
    data()
    {
        return {
            element : null,
            modal : null,
            form : null,
        }
    },

    mounted()
    {
        this.modal = new bootstrap.Modal( document.getElementById( `roleUpdateModal` ) )
        this.form = document.getElementById( `roleUpdateForm` )
    },

    methods:
    {
        groupCheck( attribute )
        {
            let elements = document.getElementsByClassName( attribute )
            let active = 0
            let numbers = 0
            for( let element of elements )
            {
                if(element.checked)
                active = active + 1
                numbers = numbers + 1
            }
            if( active > 0 && active < numbers )
            {
                for( let element of elements )
                {
                    element.checked = true
                }
            }
            if( active == numbers )
            {
                for( let element of elements )
                {
                    element.checked = false
                }
            }
            if( active == 0 )
            {
                for( let element of elements )
                {
                    element.checked = true
                }
            }
        },

        update( element )
        {
            this.element = element
            let checkboxes = this.form.querySelectorAll( `input[type=checkbox]:checked` )
        
            for (let i = 0; i < checkboxes.length; i++)
            checkboxes[i].checked = false

            this.modal.show()
            vuenisimo.clearError( this.form )
            vuenisimo.loader( this.form, true )
            this.axios.get( `${this.$uri}/role/${element.id}` )
            .then( response => 
            {
                vuenisimo.setData( this.form, response.data.role )
                for( const element of response.data.permissions )
                this.form.querySelector( `#u${element.id}` ).checked = true
            })
            .catch( error =>
            {
                vuenisimo.error( error.response )
            })
            .finally(() =>
            {
                vuenisimo.loader( this.form, false )
            })
        },

        updateEvent( e )
        {
            e.preventDefault()
            vuenisimo.clearError( this.form )
            vuenisimo.loader( this.form, true )
            vuenisimo.processing( this.modal, true )

            let data = vuenisimo.getData( this.form )
            let checks = []
            let checkboxes = this.form.querySelectorAll( `input[type=checkbox]:checked` )

            for (let i = 0; i < checkboxes.length; i++)
            checks.push(checkboxes[i].value)

            this.axios.put( `${this.$uri}/role/${this.element.id}`, { id : this.element.id ,name : data.name , guard_name : `web` , permissions : checks } )
            .then( response =>
            {
                if( response.data.id == response.data.actual )
                {
                    this.$store.commit( `SET_KEYS`, response.data.permissions )
                    let data = JSON.parse( localStorage.getItem( `user` ) )
                    data.permissions = response.data.permissions
                    localStorage.setItem( `user`, JSON.stringify( data ) )
                }

                this.modal.hide()
                this.$emit( `row`, response.data )
                vuenisimo.updateNotification()
            })
            .catch( error =>
            {
                vuenisimo.error( error.response, this.form )
            })
            .finally( () =>
            {
                vuenisimo.loader( this.form, false )
                vuenisimo.processing( this.modal, false )
            })
        },
    },
}
</script>
