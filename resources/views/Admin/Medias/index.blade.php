@extends('layouts.admin')

@section('content')

      @foreach ($mediasWithType as $mediaType => $medias)
          <div class="row">
              <div class="col-12">
                  <h2>{{$mediaType}}</h2>
              </div>
          </div>
          <div class="row">
              <div class="col-12">
                  <div class="row">
                      @foreach ($medias as $media)
                          <div class="col-2 col-lg-2 col-xl-2 test">
                            <div class="card">
                              <div class="card-header bg-grey">
                                {{ $media->id }}
                              </div>
                              <div class="card-body experience-img" style="background-image: url('{{ Storage::url($media->path) }}')">

                               </div>
                              <div style="text-align:center" class="bg-dark text-white">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="col-5">Image de</td>
                                                <td class="col-7">{{$media->mediable->name}}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-5">Type</td>
                                                <td class="col-7">{{$media->type}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row">

                                        @if($mediaType == 'Realisation' && $media->type !== 'cover')
                                            <div class="col-12">
                                            <a class="col-12 btn btn-success" href="{{ route('MediasUpdateCover', $media->id)}}">Update Cover</a>
                                            </div>
                                        @endif
                                        <div class="col-12">
                                            <a class="btn btn-primary col-12" href="{{ route('MediasEdit', $media->id)}}">Editer</a>
                                        </div>
                                        <div class="col-12">
                                            <form style="display:inline" method="POST" action="{{route('MediasDestroy', $media->id)}}">
                                              {{ csrf_field() }}
                                              {{ method_field('DELETE')}}
                                              <button type="submit" class="btn btn-danger col-12">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                              </div>
                            </div>
                          </div>
                      @endforeach
                  </div>
              </div>
          </div>
      @endforeach
@endsection
