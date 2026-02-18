@extends('admin.layouts.master')

@section('titulo', 'Color picker Component')

@section('page')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Color picker</h4>
                    </div>
                    <div class="card-body">
                        <div class="code p-1">
                            x-color-picker
                        </div>
                        <div class="py-4"></div>
                        <input type="text" class="form-control colorPicker mb-3" value="#000">
                        <x-color-picker />

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