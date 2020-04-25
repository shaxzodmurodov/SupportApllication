<?php

namespace App\Http\Controllers\Users;

use App\Domain\Messages\Actions\MessageCancelingAction;
use App\Domain\Messages\Actions\MessageStoreOrUpdateAction;
use App\Message;
use App\Domain\Messages\Repositories\MessagesRepository;
use App\Domain\Messages\Requests\MessageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MessagesController extends Controller
{
    /**
     * @var MessagesRepository
     */
    private $messagesRepository;

    /**
     *  Контроллер заявок для пользователя.
     * @param MessagesRepository $messagesRepository
     */
    public function __construct(MessagesRepository $messagesRepository)
    {
        $this->messagesRepository = $messagesRepository;
    }

    /**
     * Просмотр заявок пользователя.
     *
     * @return Factory|View
     */
    public function index()
    {
        $messages = $this->messagesRepository->allByUser(\Auth::id());
        return view('users.messages.index', compact('messages'));
    }

    /**
     * Страница создания заявки.
     *
     * @return Factory|RedirectResponse|View
     */
    public function create()
    {
        $messages = $this->messagesRepository->allByUser(Auth::id());
        foreach ($messages as $message) {
            if (date_format($message->created_at, 'd') == date('d')) {
                return redirect()->back();
            }
        }
        return view('users.messages.create');
    }

    /**
     * Сохранение заявки.
     *
     * @param MessageRequest $request
     * @param MessageStoreOrUpdateAction $action
     * @return RedirectResponse
     */
    public function store(MessageRequest $request, MessageStoreOrUpdateAction $action)
    {
        $action->execute($request->toDTO());
        return redirect()->route('user.messages.index');
    }

    /**
     * Просмотр заявки по id.
     *
     * @param Message $message
     * @return Factory|View
     */
    public function show(Message $message)
    {
        return view('users.messages.show', compact('message'));
    }

    /**
     * Редактирование заявки.
     *
     * @param Message $message
     * @return Factory|View
     */
    public function edit(Message $message)
    {
        return view('users.messages.edit', compact('message'));
    }

    /**
     * Сохранение изменений заявки.
     *
     * @param MessageRequest $request
     * @param Message $message
     * @param MessageStoreOrUpdateAction $action
     * @return RedirectResponse
     */
    public function update(MessageRequest $request, Message $message, MessageStoreOrUpdateAction $action)
    {
        $action->execute($request->toDTO(), $message);
        return redirect()->back();
    }

    /**
     * Отмена заявки.
     *
     * @param Message $message
     * @param MessageCancelingAction $action
     * @return RedirectResponse
     */
    public function destroy(Message $message, MessageCancelingAction $action)
    {
        $cancelType = request()->input('cancelType');
        $action->execute($message, $cancelType);
        return redirect()->back();
    }
}
