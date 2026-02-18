<div>
    <div class="form-group row">
        <label class="control-label text-md-right col-md-3">Orden</label>
        <div class="col-md-7">
           	<input type="number" name="{{ $name }}" value="{{ $value ?? ''}}" style="width: 110px;" class="form-control" data-error="*El orden es requerido." required>
            <div class="help-block with-errors text-danger"></div>
        </div>
    </div>
</div>