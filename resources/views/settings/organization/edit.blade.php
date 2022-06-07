<h2>Редактирование организации</h2>
<form method="post" action="{{ url('/organizations/'.$organization->id) }}" >
    {{ csrf_field() }}
    <label for="name">Организация:</label>
    <input type="text" name="name" placeholder="Введите наименование..." value="{{old('name') ?? $organization->name}}"><br>
    <button>Send</button>
</form>
