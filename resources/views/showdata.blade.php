<h1>Product Detail</h1>
<form action="product" method="get">

    <table border="1">
        <tr>
            <td>Id</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td colspan="2">Oprations</td>
            {{-- <td>Product Name</td>
            <td>Product Image</td>
            <td>Price</td>
            <td>Sell Price</td>
            <td>Qtantity</td> --}}
        </tr>
        @foreach ($data as $item)
        <tr>    
            <td>{{$item['id']}}</td>
            <td>{{$item['fname']}}</td>
            <td>{{$item['lname']}}</td>
            <td><a href="delete/{{$item['id']}}">Delete</a></td>
            <td><a href="edit/{{$item['id']}}">Edit</a></td>
            {{-- <td>{{$item['p_name']}}</td>
            <td><img src="{{$item['p_image']}}" height="100" width="100"></td>
            <td>{{$item['price']}}</td>
            <td>{{$item['sell_price']}}</td>
            <td>{{$item['qty']}}</td> --}}
        </tr>
        @endforeach
    </table>
</form>

<div>
    {{$data->links()}}
</div>
<style>
    .w-5{
        display: none;
    }
</style>

<button><a href="addstudent">Add Student</a></button>