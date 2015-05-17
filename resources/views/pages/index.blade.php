@extends('app')

	@section('content')
    
    	@foreach($pages as $page)
    		<article>
        		<h1>{{$page->title}}</h1>
                <div>
                	{{$page->type}}
                </div>
                <div>
                	{{$page->cont1}}
                </div>
        	</article>
        @endforeach
    
    
    @endsection

