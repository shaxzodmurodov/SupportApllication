@php
    /**
     * @var \App\Message $message
    */
@endphp

@extends('users.layouts.master')

@section('content')
    <br>
    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Тема</th>
            <th scope="col">Статус</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($messages as $message)
            <tr>
                <th scope="row">{{$message->id}}</th>
                <td>{{$message->theme}}</td>
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
                <td>
                    <div class="btn-group-sm d-inline">
                        <form action="{{route('user.messages.destroy', $message)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-success btn-sm" href="{{route('user.messages.show', $message)}}">
                                Просмотреть
                            </a>
                            <a class="btn btn-info btn-sm" href="{{route('user.messages.edit', $message)}}">
                                Редактировать
                            </a>
                            <input type="hidden" name="cancelType" id="cancelType" value="1">
                            <button type="submit" class="btn btn-danger btn-sm">
                                Отменить
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
