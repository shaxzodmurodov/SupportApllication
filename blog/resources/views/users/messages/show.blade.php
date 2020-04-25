@php
    /**
     * @var \App\Message $message
    */
@endphp

@extends('users.layouts.master')

@section('content')
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
        </tr>
        <tr>
            <td>Статус</td>
            <td>
                @if($message->asCanceled())
                    <i class="btn btn-danger btn-sm">
                        Отменено
                    </i>
                @elseif($message->asResponse())
                    <i class="btn btn-success btn-sm">
                        Отвечено
                    </i>
                @elseif($message->asRead())
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
        <tr>
            <td>Вложенный файл</td>
            <td>
                @if($message->file)
                    <a href="{{asset('storage/'.$message->file->path)}}">
                        {{$message->file->title}}
                    </a>
                @endif
            </td>
        </tr>
        <tr>
            @if(!$message->asResponse())
                <td>Действие</td>
                <td>
                    <form action="{{route('user.messages.destroy', $message)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="cancelType" id="cancelType" value="1">
                        <button type="submit" class="btn btn-danger btn-sm">
                            Отменить
                        </button>
                    </form>
                </td>
            @endif
        </tr>
        <tr>
            @if($message->messageResponse)
                <td>Ответ</td>
                <td>{{$message->messageResponse->response_text}}</td>
            @endif
        </tr>
        </tbody>
    </table>
@endsection
