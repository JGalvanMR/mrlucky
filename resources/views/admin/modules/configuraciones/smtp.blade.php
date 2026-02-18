@extends('admin.layouts.master')

@section('titulo', 'Configuraciones')

@section('page')
	<div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Configuraciones</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item active">Configuraciones</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Editar configuración</h4>
                    </div>
                    <div class="card-body">
                        
                         <form id="editarForm" action="{{ route('configuraciones.editar_smtp') }}" class="form-horizontal form-bordered m-t-40">
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Mailer</label>
                                    <div class="col-md-7">
                                        <select id="mailer" name="mailer" class="form-control">
                                            <option value="smtp" {{ (EnvEditor::getKey('MAIL_MAILER') == 'smtp') ? 'selected' : '' }}>SMTP (Recomendado)</option>
                                            <option value="sendmail" {{ (EnvEditor::getKey('MAIL_MAILER') == 'sendmail') ? 'selected' : '' }}>Sendmail</option>
                                            <option value="mailgun" {{ (EnvEditor::getKey('MAIL_MAILER') == 'mailgun') ? 'selected' : '' }}>Mailgun</option>
                                            <option value="mailtrap" {{ (EnvEditor::getKey('MAIL_MAILER') == 'mailtrap') ? 'selected' : '' }}>Mailtrap</option>
                                            <option value="mail" {{ (EnvEditor::getKey('MAIL_MAILER') == 'mail') ? 'selected' : '' }}>Mail</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div id="smtp_settings" class="{{ (EnvEditor::getKey('MAIL_MAILER') == 'sendmail') ? 'd-none' : '' }}">
                                    <div class="form-group row">
                                        <label class="control-label text-md-right col-md-3">Host</label>
                                        <div class="col-md-7">
                                            <input type="text" name="host" class="form-control" value="{{ EnvEditor::getKey('MAIL_HOST') }}">
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label text-md-right col-md-3">Puerto</label>
                                        <div class="col-md-7">
                                            <input type="text" name="puerto" class="form-control" value="{{ EnvEditor::getKey('MAIL_PORT') }}">
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label text-md-right col-md-3">Usuario</label>
                                        <div class="col-md-7">
                                            <input type="text" name="usuario" class="form-control" value="{{ EnvEditor::getKey('MAIL_USERNAME') }}">
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label text-md-right col-md-3">Contraseña</label>
                                        <div class="col-md-7">
                                            <input type="text" name="contrasena" class="form-control" value="{{ EnvEditor::getKey('MAIL_PASSWORD') }}">
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label text-md-right col-md-3">Encriptado</label>
                                        <div class="col-md-7">
                                            <select name="encriptado" class="form-control">
                                                <option value="null" {{ (EnvEditor::getKey('MAIL_ENCRYPTION') == 'null') ? 'selected' : '' }}>Ninguno</option>
                                                <option value="tls" {{ (EnvEditor::getKey('MAIL_ENCRYPTION') == 'tls') ? 'selected' : '' }}>tls</option>
                                                <option value="ssl" {{ (EnvEditor::getKey('MAIL_ENCRYPTION') == 'ssl') ? 'selected' : '' }}>ssl</option>
                                            </select>
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label class="control-label text-md-right col-md-3">Nombre</label>
                                        <div class="col-md-7">
                                            <input type="text" name="nombre" class="form-control" value="{{ EnvEditor::getKey('MAIL_FROM_NAME') }}">
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label text-md-right col-md-3">Correo</label>
                                        <div class="col-md-7">
                                            <input type="text" name="correo" class="form-control" value="{{ EnvEditor::getKey('MAIL_FROM_ADDRESS') }}">
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>
                                <div class="form-group row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-7">
                                        <button type="submit" class="btn btn-primary btn-block btn-lg disabled">
                                            Guardar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('customCSS')
    @parent

@stop

@section('customJS')
    @parent
    <script>
        $(function(){
            $('#mailer').on('change', function(){
                let mailer = $(this).val();

                if(mailer == 'smtp'){
                    $("#smtp_settings").removeClass('d-none');
                }else{
                    $("#smtp_settings").addClass('d-none');
                }
            });
        });
    </script>
    <x-validator /> 
    <x-ajax-form id="editarForm" titulo="Editar configuración" reload="1" />
@stop