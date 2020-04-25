@php
    /**
    * @var \App\Message $data
    */
@endphp
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
        <td>{{$data->theme}}</td>
    </tr>
    <tr>
        <td>Статус</td>
        <td>
            @if($data->asCanceled())
                <i class="btn btn-danger btn-sm">
                    Отменено
                </i>
            @elseif($data->asResponse())
                <i class="btn btn-success btn-sm">
                    Отвечено
                </i>
            @elseif($data->asRead())
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
        <td>{{$data->message}}</td>
    </tr>
    <tr>
        @if($data->asResponse())
            <td>Текст ответа</td>

            <td>
                {{$data->messageResponse->response_text}}
            </td>
        @endif
    </tr>
    <tr>
        <td>Действие</td>
        <td>
            <a class="btn btn-primary" href="{{route('user.messages.show', $data)}}">
                Посмотреть
            </a>
        </td>
    </tr>
    </tbody>
</table>
