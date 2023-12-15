<template>
    <div class="modal fade" id="roleStoreModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit="storeEvent" id="roleStoreForm">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h5 class="modal-title text-sm">
                                    <i class="lni lni-circle-plus me-1 fw-bold text-success"></i>
                                    Nuevo rol
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label">Nombre del rol (*)</label>
                                <input name="name" class="form-control form-control-sm" type="text" autocomplete="off" maxlength="30" minlength="2">
                                <p error="name" class="error"></p>
                            </div>
                        </div>
                        <label class="label-flask text-xs mb-2">Lista de permisos:</label>
                        <div class="row mt-2 mb-3 scroll-permission">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `store-role` )">Roles:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-role" type="checkbox" name="1" value="1" id="s1">
                                    <label class="custom-control-label text-xs" for="s1">Ver roles</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-role" type="checkbox" name="2" value="2" id="s2">
                                    <label class="custom-control-label text-xs" for="s2">Crear roles</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-role" type="checkbox" name="3" value="3" id="s3">
                                    <label class="custom-control-label text-xs" for="s3">Editar roles</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-role" type="checkbox" name="4" value="4" id="s4">
                                    <label class="custom-control-label text-xs" for="s4">Pdf de roles</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-role" type="checkbox" name="5" value="5" id="s5">
                                    <label class="custom-control-label text-xs" for="s5">Excel de roles</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-role" type="checkbox" name="6" value="6" id="s6">
                                    <label class="custom-control-label text-xs" for="s6">Eliminar roles</label>
                                </div>
                            </div>
                            <hr class="split mt-3">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `store-user` )">Usuarios:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-user" type="checkbox" name="7" value="7" id="s7">
                                    <label class="custom-control-label text-xs" for="s7">Ver usuarios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-user" type="checkbox" name="8" value="8" id="s8">
                                    <label class="custom-control-label text-xs" for="s8">Crear usuarios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-user" type="checkbox" name="9" value="9" id="s9">
                                    <label class="custom-control-label text-xs" for="s9">Editar usuarios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-user" type="checkbox" name="10" value="10" id="s10">
                                    <label class="custom-control-label text-xs" for="s10">Asignar usuario</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-user" type="checkbox" name="11" value="11" id="s11">
                                    <label class="custom-control-label text-xs" for="s11">Pdf de usuarios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-user" type="checkbox" name="12" value="12" id="s12">
                                    <label class="custom-control-label text-xs" for="s12">Excel de usuarios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-user" type="checkbox" name="13" value="13" id="s13">
                                    <label class="custom-control-label text-xs" for="s13">Eliminar usuarios</label>
                                </div>
                            </div>
                            <hr class="split">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `store-headquarter` )">Sedes:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-headquarter" type="checkbox" name="14" value="14" id="s14">
                                    <label class="custom-control-label text-xs" for="s14">Ver sedes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-headquarter" type="checkbox" name="15" value="15" id="s15">
                                    <label class="custom-control-label text-xs" for="s15">Crear sedes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-headquarter" type="checkbox" name="16" value="16" id="s16">
                                    <label class="custom-control-label text-xs" for="s16">Editar sedes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-headquarter" type="checkbox" name="17" value="17" id="s17">
                                    <label class="custom-control-label text-xs" for="s17">Pdf de sedes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-headquarter" type="checkbox" name="18" value="18" id="s18">
                                    <label class="custom-control-label text-xs" for="s18">Excel de sedes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-headquarter" type="checkbox" name="19" value="19" id="s19">
                                    <label class="custom-control-label text-xs" for="s19">Eliminar sedes</label>
                                </div>
                            </div>
                            <hr class="split">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `store-faculty` )">Facultades:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-faculty" type="checkbox" name="20" value="20" id="s20">
                                    <label class="custom-control-label text-xs" for="s20">Ver planes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-faculty" type="checkbox" name="21" value="21" id="s21">
                                    <label class="custom-control-label text-xs" for="s21">Crear facultades</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-faculty" type="checkbox" name="22" value="22" id="s22">
                                    <label class="custom-control-label text-xs" for="s22">Editar facultades</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-faculty" type="checkbox" name="23" value="23" id="s23">
                                    <label class="custom-control-label text-xs" for="s23">Pdf de facultades</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-faculty" type="checkbox" name="24" value="24" id="s24">
                                    <label class="custom-control-label text-xs" for="s24">Excel de facultades</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-faculty" type="checkbox" name="25" value="25" id="s25">
                                    <label class="custom-control-label text-xs" for="s25">Eliminar facultades</label>
                                </div>
                            </div>
                            <hr class="split">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `store-career` )">Carreras:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-career" type="checkbox" name="26" value="26" id="s26">
                                    <label class="custom-control-label text-xs" for="s26">Ver carreras</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-career" type="checkbox" name="27" value="27" id="s27">
                                    <label class="custom-control-label text-xs" for="s27">Crear carreras</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-career" type="checkbox" name="28" value="28" id="s28">
                                    <label class="custom-control-label text-xs" for="s28">Editar carreras</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-career" type="checkbox" name="29" value="29" id="s29">
                                    <label class="custom-control-label text-xs" for="s29">Pdf de carreras</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-career" type="checkbox" name="30" value="30" id="s30">
                                    <label class="custom-control-label text-xs" for="s30">Excel de carreras</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-career" type="checkbox" name="31" value="31" id="s31">
                                    <label class="custom-control-label text-xs" for="s31">Eliminar carreras</label>
                                </div>
                            </div>
                            <hr class="split">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `store-laboratory` )">Laboratorios:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-laboratory" type="checkbox" name="32" value="32" id="s32">
                                    <label class="custom-control-label text-xs" for="s32">Ver laboratorios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-laboratory" type="checkbox" name="33" value="33" id="s33">
                                    <label class="custom-control-label text-xs" for="s33">Crear laboratorios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-laboratory" type="checkbox" name="34" value="34" id="s34">
                                    <label class="custom-control-label text-xs" for="s34">Editar laboratorios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-laboratory" type="checkbox" name="35" value="35" id="s35">
                                    <label class="custom-control-label text-xs" for="s35">Pdf de laboratorios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-laboratory" type="checkbox" name="36" value="36" id="s36">
                                    <label class="custom-control-label text-xs" for="s36">Excel de laboratorios</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-laboratory" type="checkbox" name="37" value="37" id="s37">
                                    <label class="custom-control-label text-xs" for="s37">Eliminar laboratorios</label>
                                </div>
                            </div>
                            <hr class="split">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `store-convocatory` )">Convocatorias:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-convocatory" type="checkbox" name="38" value="38" id="s38">
                                    <label class="custom-control-label text-xs" for="s38">Ver convocatorias</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-convocatory" type="checkbox" name="39" value="39" id="s39">
                                    <label class="custom-control-label text-xs" for="s39">Crear convocatorias</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-convocatory" type="checkbox" name="40" value="40" id="s40">
                                    <label class="custom-control-label text-xs" for="s40">Editar convocatorias</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-convocatory" type="checkbox" name="41" value="41" id="s41">
                                    <label class="custom-control-label text-xs" for="s41">Pdf de convocatorias</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-convocatory" type="checkbox" name="42" value="42" id="s42">
                                    <label class="custom-control-label text-xs" for="s42">Excel de convocatorias</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-convocatory" type="checkbox" name="43" value="43" id="s43">
                                    <label class="custom-control-label text-xs" for="s43">Eliminar convocatorias</label>
                                </div>
                            </div>
                            <hr class="split">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `store-line` )">Lineas de investigación:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-line" type="checkbox" name="44" value="44" id="s44">
                                    <label class="custom-control-label text-xs" for="s44">Ver lineas</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-line" type="checkbox" name="45" value="45" id="s45">
                                    <label class="custom-control-label text-xs" for="s45">Crear lineas</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-line" type="checkbox" name="46" value="46" id="s46">
                                    <label class="custom-control-label text-xs" for="s46">Editar lineas</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-line" type="checkbox" name="47" value="47" id="s47">
                                    <label class="custom-control-label text-xs" for="s47">Pdf de lineas</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-line" type="checkbox" name="48" value="48" id="s48">
                                    <label class="custom-control-label text-xs" for="s48">Excel de lineas</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-line" type="checkbox" name="49" value="49" id="s49">
                                    <label class="custom-control-label text-xs" for="s49">Eliminar lineas</label>
                                </div>
                            </div>
                            <hr class="split">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `store-process` )">Procesos:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-process" type="checkbox" name="50" value="50" id="s50">
                                    <label class="custom-control-label text-xs" for="s50">Ver procesos</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-process" type="checkbox" name="51" value="51" id="s51">
                                    <label class="custom-control-label text-xs" for="s51">Crear procesos</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-process" type="checkbox" name="52" value="52" id="s52">
                                    <label class="custom-control-label text-xs" for="s52">Editar procesos</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-process" type="checkbox" name="53" value="53" id="s53">
                                    <label class="custom-control-label text-xs" for="s53">Pdf de procesos</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-process" type="checkbox" name="54" value="54" id="s54">
                                    <label class="custom-control-label text-xs" for="s54">Excel de procesos</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-process" type="checkbox" name="55" value="55" id="s55">
                                    <label class="custom-control-label text-xs" for="s55">Eliminar procesos</label>
                                </div>
                            </div>
                            <hr class="split">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `store-lecturer` )">Docentes:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-lecturer" type="checkbox" name="56" value="56" id="s56">
                                    <label class="custom-control-label text-xs" for="s56">Ver docentes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-lecturer" type="checkbox" name="57" value="57" id="s57">
                                    <label class="custom-control-label text-xs" for="s57">Crear docentes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-lecturer" type="checkbox" name="58" value="58" id="s58">
                                    <label class="custom-control-label text-xs" for="s58">Editar docentes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-lecturer" type="checkbox" name="59" value="59" id="s59">
                                    <label class="custom-control-label text-xs" for="s59">Pdf de docentes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-lecturer" type="checkbox" name="60" value="60" id="s60">
                                    <label class="custom-control-label text-xs" for="s60">Excel de docentes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-lecturer" type="checkbox" name="61" value="61" id="s61">
                                    <label class="custom-control-label text-xs" for="s61">Eliminar docentes</label>
                                </div>
                            </div>
                            <hr class="split">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `store-student` )">Estudiantes:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-student" type="checkbox" name="62" value="62" id="s62">
                                    <label class="custom-control-label text-xs" for="s62">Ver estudiantes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-student" type="checkbox" name="63" value="63" id="s63">
                                    <label class="custom-control-label text-xs" for="s63">Crear estudiantes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-student" type="checkbox" name="64" value="64" id="s64">
                                    <label class="custom-control-label text-xs" for="s64">Editar estudiantes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-student" type="checkbox" name="65" value="65" id="s65">
                                    <label class="custom-control-label text-xs" for="s65">Pdf de estudiantes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-student" type="checkbox" name="66" value="66" id="s66">
                                    <label class="custom-control-label text-xs" for="s66">Excel de estudiantes</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-student" type="checkbox" name="67" value="67" id="s67">
                                    <label class="custom-control-label text-xs" for="s67">Eliminar estudiantes</label>
                                </div>
                            </div>
                            <hr class="split">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `store-undergraduate` )">Tesis:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-undergraduate" type="checkbox" name="68" value="68" id="s68">
                                    <label class="custom-control-label text-xs" for="s68">Ver tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-undergraduate" type="checkbox" name="69" value="69" id="s69">
                                    <label class="custom-control-label text-xs" for="s69">Crear tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-undergraduate" type="checkbox" name="70" value="70" id="s70">
                                    <label class="custom-control-label text-xs" for="s70">Editar tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-undergraduate" type="checkbox" name="71" value="71" id="s71">
                                    <label class="custom-control-label text-xs" for="s71">Asignar tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-undergraduate" type="checkbox" name="72" value="72" id="s72">
                                    <label class="custom-control-label text-xs" for="s72">Proceso de tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-undergraduate" type="checkbox" name="73" value="73" id="s73">
                                    <label class="custom-control-label text-xs" for="s73">Archivos de tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-undergraduate" type="checkbox" name="74" value="74" id="s74">
                                    <label class="custom-control-label text-xs" for="s74">Pdf de tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-undergraduate" type="checkbox" name="75" value="75" id="s75">
                                    <label class="custom-control-label text-xs" for="s75">Excel de tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-undergraduate" type="checkbox" name="76" value="76" id="s76">
                                    <label class="custom-control-label text-xs" for="s76">Correos de tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-undergraduate" type="checkbox" name="77" value="77" id="s77">
                                    <label class="custom-control-label text-xs" for="s77">Eliminar tesis</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-undergraduate" type="checkbox" name="78" value="78" id="s78">
                                    <label class="custom-control-label text-xs" for="s78">Estadisticas de tesis</label>
                                </div>
                            </div>
                            <hr class="split">
                            <div class="row">
                                <strong class="fs-6" role="button" @click="groupCheck( `store-investigation` )">Investigaciones docente:</strong>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-investigation" type="checkbox" name="79" value="79" id="s79">
                                    <label class="custom-control-label text-xs" for="s79">Ver investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-investigation" type="checkbox" name="80" value="80" id="s80">
                                    <label class="custom-control-label text-xs" for="s80">Crear investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-investigation" type="checkbox" name="81" value="81" id="s81">
                                    <label class="custom-control-label text-xs" for="s81">Editar investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-investigation" type="checkbox" name="82" value="82" id="s82">
                                    <label class="custom-control-label text-xs" for="s82">Asignar investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-investigation" type="checkbox" name="83" value="83" id="s83">
                                    <label class="custom-control-label text-xs" for="s83">Proceso de investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-investigation" type="checkbox" name="84" value="84" id="s84">
                                    <label class="custom-control-label text-xs" for="s84">Archivos de investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-investigation" type="checkbox" name="85" value="85" id="s85">
                                    <label class="custom-control-label text-xs" for="s85">Pdf de investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-investigation" type="checkbox" name="86" value="86" id="s86">
                                    <label class="custom-control-label text-xs" for="s86">Excel de investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-investigation" type="checkbox" name="87" value="87" id="s87">
                                    <label class="custom-control-label text-xs" for="s87">Correos de investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-investigation" type="checkbox" name="88" value="88" id="s88">
                                    <label class="custom-control-label text-xs" for="s88">Eliminar investigaciones</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary store-investigation" type="checkbox" name="89" value="89" id="s89">
                                    <label class="custom-control-label text-xs" for="s89">Estadisticas de investigaciones</label>
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
            modal : null,
            form : null,
        }
    },

    mounted()
    {
        this.modal = new bootstrap.Modal( document.getElementById( `roleStoreModal` ) )
        this.form = document.getElementById( `roleStoreForm` )
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
                if( element.checked )
                active = active + 1
                numbers = numbers + 1
            }
            if( active > 0 && active < numbers )
            {
                for( let element of elements )
                element.checked = true
            }
            if( active == numbers )
            {
                for( let element of elements )
                element.checked = false
            }
            if( active == 0 )
            {
                for(let element of elements)
                element.checked = true
            }
        },

        store()
        {
            vuenisimo.clearData( this.form )
            vuenisimo.clearError( this.form )
            this.modal.show()
        },

        storeEvent( e )
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
            
            this.axios.post( `${this.$uri}/role`, { name : data.name , guard_name : `web` , permissions : checks } )
            .then( response =>
            {
                this.modal.hide()
                this.$emit( `reload`, true )
                vuenisimo.storeNotification()
            })
            .catch( error =>
            {
                vuenisimo.error( error.response, this.form )
            })
            .finally(() =>
            {
                vuenisimo.loader( this.form, false )
                vuenisimo.processing( this.modal, false )
            })
        },
    },
}
</script>
