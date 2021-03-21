@extends('master_page')
@section('content')
    
        @if(session('status'))
        <div class="alert alert-success" role="alert">
           <h3 class="badge bg-success">{{ session('status') }}</h3> 
        </div>
        @endif
        <table class="table table-striped">
        <thead>
            <tr>
                <th>title</th>
                <th>content</th>
                <th>action</th>
            </tr>        
        </thead>
        
        <tbody>
            @forelse ($posts as $post)
            <tr>
                  <td>{{ $post->title }}</td>
                  <td>{{ $post->content }}</td>
                  <td>
                      <a class="btn btn-primary" href="{{ route('posts.edit',['post'=>$post->id]) }}">edit</a>            
                    </td> 
                    @if(!$post->deleted_at)
                    <td> 
                        <form action="{{ route('posts.destroy',['post'=>$post->id]) }}" method="POST">
                          @csrf
                          @method('DELETE')
                        <button type="submit" class="btn btn-danger">delete</button>
                        </form>                
                      </td>  
                      @else   
                    <td>
                        <form action="{{ url('/posts/'.$post->id.'/restore') }}" method="Post">
                        @csrf
                        @method('patch')
                        <button class="btn btn-success" type="submit" >Restore</button>
                    </form>
                    </td>  
                    @endif       
            @empty
            <h2 class="badge bg-danger">not product found!!!</h2>
        </tr>
        @endforelse
    </tbody>
    </table> 
    @endsection