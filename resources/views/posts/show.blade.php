@extends('layouts.app')

@section('title' , 'Form')

@section('content')

@if(isset($post['image']))
<img  src="{{ Storage::url($post['image']) }}"  class="img-responsive">
@endif

<table style="margin-top: 30px;" class="table table-striped table-hover">

    <th>Title</th>
    <th>Owner</th>
    <th>Body</th>
    <th>Enabled</th>
    <th>Pusblished At</th>
    <th>User ID</th>
    <th>Created At</th>
    <th>Updated At</th>



</tr>

    <tr>


<td><a href="{{ Route('posts.show',['id'=>$post['P_id'] ]) }}">{{$post['title']}}</a></td>
<td>{{$post->user->name}}</td>
<td>{{$post['body']}}</td>
<td>{{$post['enabled']}}</td>
<td>{{$post['published_at']}}</td>
<td>{{$post['user_id']}}</td>
<td>{{$post['created_at']}}</td>
<td>{{$post['updated_at']}}</td>

</tr>







</table>


@endsection
