@extends('app')

@section('content')
	<article>
    	<header>
    		<h1>{{$page -> title}}</h1>
        </header>
        
        <section>
            {{$page->cont1}}
        </section>
        <section>
            {{$page->cont2}}
        </section>
        <div>
            {{$page->cont3}}
        </div>
        <div>
            {{$page->type}}
        </div>
        <div>
            {{$page->price}}
        </div>
        
        <footer>
        
        </footer>
    </article>
@endsection
