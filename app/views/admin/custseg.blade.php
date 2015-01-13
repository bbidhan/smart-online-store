@extends('admin.layout')
@section('content')
The <strong>Green</strong> Dots show <strong>Premium</strong> Users.<br/>
The <strong>Red</strong> Dots show <strong>Gold</strong> Users.<br/>
The <strong>Blue</strong> Dots show <strong>Standard</strong> Users.<br/>
<ul class="thumbnails">
@for($i=0;$i<8;$i++)
<li class="span1" >
  <div class="thumbnail">
  <img  src="/img/custseg/custseg{{$i +1}}.png" alt=""/>
  <div class="caption">
  </div>
  </div>
</li>
@endfor
</ul> 

@stop