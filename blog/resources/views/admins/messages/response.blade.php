@php
    /**
     * @var \App\Message $message
    */
@endphp
@extends('admins.layouts.master')

@section('content')
    <form action="{{route('admin.messages.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <br>
        <div class="form-group">
            <div class="row card">
                <br>
                <div>
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <td>
                                Поле
                            </td>
                            <td>
                                Значение
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Тема</td>
                            <td>{{$message->theme}}</td>
                            <input type="hidden" name="response_theme" value="{{$message->theme}}">
                        </tr>
                        <tr>
                            <td>Статус</td>
                            <td>
                                @if($message->read === 1)
                                    <i class="btn btn-success btn-sm">
                                        Просмотрено
                                    </i>
                                @else
                                    <i class="btn btn-info btn-sm">
                                        Не просмотрено
                                    </i>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Текст обращения</td>
                            <td>{{$message->message}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="h5 text-center">
                    Ответ на заявку:
                </div>

                <div class="justify-content-lg-center">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <label for="response_text">Текст ответа</label>
                            </div>
                            <div class="col-lg-2">
                                <textarea type="text" name="response_text" id="response_text" cols="22"
                                          rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="btn-group">
                        <input type="hidden" name="response" id="response" value="1">
                        <input type="hidden" name="message_id" value="{{$message->id}}">
                        <button type="submit" class="btn btn-primary">
                            Отправить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
