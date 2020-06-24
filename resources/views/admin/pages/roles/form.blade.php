
@include('msg')

@csrf

<div class="form-group">
    <label>* Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $role->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <input type="text" name="label" class="form-control" placeholder="Descrição:" value="{{ $role->label ?? old('label') }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success">Enviar</button>
</div>
