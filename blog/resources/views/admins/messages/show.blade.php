@php
    /**
     * @var \App\Message $message
    */
@endphp
@extends('admins.layouts.master')

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
            <td>Действие</td>
            <td>
                <form action="{{route('admin.messages.destroy', $message)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="cancelType" id="cancelType" value="2">
                    <button type="submit" class="btn btn-danger btn-sm">
                        Отменить
                    </button>
                    <a class="btn btn-primary btn-sm" href="{{route('admin.messages.create', ['id' =>$message->id])}}">
                        Ответить
                    </a>
                </form>

            </td>
        </tr>
        </tbody>
    </table>
@endsection
