@php
    /**
     * @var \App\Message $message
    */
@endphp
@extends('users.layouts.master')

@section('content')
    <br>
    <div class="form-group">
        <div class="row card">
            <br>
            <form action="{{route('user.messages.update', $message)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="justify-content-lg-center">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <label for="theme">Тема обращения</label>
                            </div>
                            <div class="col-lg-2">
                                <input type="text" name="theme" id="theme"
                                       @isset($message->theme) value="{{$message->theme}}" @endisset>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <label for="message">Текст обращения</label>
                            </div>
                            <div class="col-lg-2">
                                <textarea type="text" name="message" id="message" cols="22"
                                          rows="5">@isset($message->message){{$message->message}}@endisset
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            Отправить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
