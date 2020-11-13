@extends('layouts.app')


@section('head')
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/simpleUpload.js"></script>
@endsection

@section('script')
    var $j = jQuery.noConflict();

    $j(document).ready(function(){

        $j('input[type=file]').change(function(){
            $j(this).simpleUpload("{{ route('videos.store_trailer_ajax', $data->id) }}", {

                start: function(file){
                    //upload started
                    $j('#filename').html(file.name);
                    $j('#progress').html("");
                    $j('#progressBar').width(0);
                },


                data: {
                "_token": "{{ csrf_token() }}",
                "id": {{ $data->id }},
                },

                progress: function(progress){
                    //received progress
                    $j('#progress').html("Progress: " + Math.round(progress) + "%");
                    $j('#progressBar').width(progress + "%");
                    $j("#progress-bar").attr("style",  "width:" + Math.round(progress) +  "%;" );
                },

                success: function(data){

                    if(data.status == 'success'){
                        $j('#progress').html("<span class=\"text-success\"><i class=\"fas fa-check\"></i>&nbsp;" + data.message + "</span>");
                    }else if(data.status == 'error'){
                        $j('#progress').html("<span class=\"text-danger\"><i class=\"fa fa-exclamation-triangle\"></i>&nbsp;" + data.message.file + "</span>");
                    }
                    
                    console.log(data.message.file);
                    
                   
                },

                error: function(error){
                    //upload failed
                    //$('#progress').html("Failure!<br>" + error.name + ": " + error.message);
                   // console.log(data.message);
             
     
                    $j('#progress').html("Trailer upload failed!");
                }

            });

        });

    });
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="/videos">{{ __('Videos') }}</a></li>
                    <li class="breadcrumb-item"><a href="/videos/{{ $data->id }}">{{ $data->title }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('videos.edit' , $data->id )}}">Metadata</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Trailer') }}</li>
                    <li class="breadcrumb-item"><a href="{{ route('videos.video' , $data->id )}}">Video</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('videos.poster' , $data->id )}}">Poster</a></li>
                  
                </ol>
            </nav>

            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif


            @if ($errors->any())
                
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
     
             


                <div class="col card">
              
                    <div class="card-body col col-6">
                       
                        @if (file_exists(public_path('/uploads/' .$data->id. '/trailer/original.mp4')))
                        
                        @else
                            <img class="img img-thumbnail mb-2" src="/src/poster/trailer.png" />
                        @endif
                        <div class="progress">
                            <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;"  aria-valuemin="0" aria-valuemax="100">
                                <span id="filename"></span>
                            </div>
                        </div>
                        
                        <div class="input-group mt-1 mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                           
                        </div>
                        <div class="input-group mt-1 mb-1"><span id="progress"></span></div>


                    </div>
                </div>            


            
        </div>
    </div>
</div>
@endsection


