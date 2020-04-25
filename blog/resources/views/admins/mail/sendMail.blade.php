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
            @if($data->read === 1)
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
        <a class="btn btn-primary" href="{{route('user.messages.show', $data)}}">
            Посмотреть
        </a>
    </tr>
    <tr>
        @if($data->asResponse())
            <td>Текст ответа</td>
            <td>
                {{$data->messageResponse->response_text}}
            </td>
        @endif
    </tr>
    </tbody>
</table>
