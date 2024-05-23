@extends('template')

@section('container')
<table id="example" class="display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>TRANSACTION CODE</th>
            <th>PRODUCT NAME</th>
            <th>UNIT</th>
            <th>QUANTITY</th>
            <th>DISCOUNT</th>
            <th>TOTAL PRICE</th>
        </tr>
    </thead>
    <tbody>
        @foreach($trans as $t)

        <tr>

        </tr>
        @endforeach

    </tbody>
</table>
@endsection