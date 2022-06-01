<form action="/public/create" method="post">
    {{ csrf_field() }}
    <label for="name">Организация:</label>
    <input type="text" name="name"><br>
    <button>Send</button>
</form>
