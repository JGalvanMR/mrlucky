@extends('admin.layouts.master')

@section('titulo', 'Data Tables Component')

@section('page')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Data Tables</h4>
                    </div>
                    <div class="card-body">
                        <div class="code p-1">
                            x-data-tables
                            $exportable = 0
                            $scripts = 1
                        </div>
                        <div class="py-4"></div>
                        <table class="listado table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Nombre</td>
                                    <td>Edad</td>
                                    <td>Nacionalidad</td>
                                    <td>Género</td>
                                </tr>
                            </thead>
                        </table>
                        <x-data-tables />

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/styles/default.min.css" />
    <style>
        div.code {
            white-space: pre;
        }
    </style>
@stop

@section('customJS')
    @parent

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/languages/php.min.js"></script>
    <script>
        $(function(){
            document.querySelectorAll('div.code').forEach(el => {
              // then highlight each
              hljs.highlightElement(el);
            });
        });
    </script>


@stop