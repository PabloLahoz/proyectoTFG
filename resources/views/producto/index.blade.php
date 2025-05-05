@section('content')
    <div>
        <div class="flex flex-wrap justify-center">
            @foreach($productos as $producto)
                <div class="card bg-base-100 w-96 shadow-sm">
                    <figure>
                        <img src="/img/{{$producto->imagen}}"/>
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{$producto->nombre}}</h2>
                        <p>{{$producto->precio}}</p>
                        <div class="card-actions justify-end">
                            <form action="{{route('add')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$producto->id}}">
                                <input type="submit" name="btn" class="btn" value="Añadir">
                            </form>
                            <div class="badge badge-outline">Fashion</div>
                            <div class="badge badge-outline">Products</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
