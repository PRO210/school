@include('msg')

<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $profile->name ?? old('name') }}">
</div>

{{-- <div class="form-group">
    <label>Preço:</label>
    <input type="text" name="price" class="form-control" placeholder="Preço:" value="{{ $plan->price ?? old('price') }}">
</div> --}}

<div class="form-group">
    <label>Descrição:</label>
<input type="text" name="description" class="form-control" placeholder="Descrição:" value="{{ $profile->description ?? old('description') }}">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success">Enviar</button>
</div>