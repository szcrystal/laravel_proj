@extends('app')

	@section('content')
    
    <a href="/admin/logout">LogOut</a>
    <br />
    <a href="/dashboard/create">新規作成</a>
    
    	@foreach($pages as $page)
    		<article>
            	<header>
	        		<h1>{{$page->title}}</h1>
                    <a href="dashboard/edit/{{$page->id}}">編集</a>
                </header>
                
                <div>
                	{{$page->type}}
                </div>
                
                <div>
                	{{$page->cont1}}
                </div>
        	</article>
        @endforeach
    
    <?php echo $pages->render(); ?>
    
    @endsection

