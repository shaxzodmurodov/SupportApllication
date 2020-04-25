@php
    /**
     * @var \App\Message $message
    */
@endphp

@extends('admins.layouts.master')

@section('content')
    <br>
    <div class="form-control">
        <form action="{{route('admin.messages.index')}}" method="GET">
            <label for="sortBy"></label>
            <select name="sortBy" id="sortBy">
                @foreach([
                    'all' => 'Все',
                    'asUnRead' => 'Не прочитанные',
                    'asRead' => 'Прочитанные',
                    'asResponse' => 'Отвеченные',
                    'asUnResponse' => 'Не отвеченные',
                    'asCancel' => 'Закрытые',
                    'asUnCancel' => 'Не закрытые',
                          ] as $field => $title)
                    <option value="{{$field}}"
                            @if(request()->input('sortBy') == $field) selected @endif>{{$title}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-outline-primary btn-sm">Сортировать</button>
            <a class="btn btn-outline-primary btn-sm" href="{{route('admin.messages.index')}}">Сброс</a>
        </form>
    </div>
    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col">ID</th>
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
                    <form action="{{route('admin.messages.destroy', $message)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="cancelType" id="cancelType" value="2">
                        <a class="btn btn-success btn-sm" href="{{route('admin.messages.show', $message)}}">
                            Просмотреть
                        </a>
                        <button type="submit" class="btn btn-danger btn-sm">
                            Отменить
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(request()->has('sortBy'))
        {{$messages->links()}}
    @endif
@endsection
