<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout Page</h1>
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <label for="numItems">Number of Items:</label>
        <input type="number" name="numItems" id="numItems" min="1" required><br><br>
        @for ($i = 1; $i <= 3; $i++)
            <label for="item{{$i}}_name">Item {{$i}} Name:</label>
            <input type="text" name="item{{$i}}_name" id="item{{$i}}_name"><br>
            <label for="item{{$i}}_price">Item {{$i}} Price:</label>
            <input type="number" name="item{{$i}}_price" id="item{{$i}}_price" min="0" step="0.01"><br><br>
        @endfor
        <button type="submit">Checkout</button>
    </form>
</body>
</html>
