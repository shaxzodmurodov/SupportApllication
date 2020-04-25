<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Messages\Actions\MessageCancelingAction;
use App\Domain\Messages\Actions\MessageResponseAction;
use App\Domain\Messages\Requests\ResponseMessageRequest;
use App\Message;
use App\Domain\Messages\Repositories\MessagesRepository;
use App\Domain\Messages\Requests\MessageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessagesController extends Controller
{
    /**
     * @var MessagesRepository
     */
    private $messagesRepository;

    /**
     * Котроллер заявок для менеджера.
     * @param MessagesRepository $messagesRepository
     */
    public function __construct(MessagesRepository $messagesRepository)
    {
        $this->messagesRepository = $messagesRepository;
    }

    /**
     * Вывод всех заявок и сортировка.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->has('sortBy')) {
            $messagesQuery = $this->messagesRepository->sortBy();
            if ($request->input('sortBy') == 'asRead') {
                $messagesQuery->where('read', '=', 1);
            }
            if ($request->input('sortBy') == 'asUnRead') {
                $messagesQuery->where('read', '=', 0);
            }
            if ($request->input('sortBy') == 'asResponse') {
                $messagesQuery->where('response', '=', 1);
            }
            if ($request->input('sortBy') == 'asUnResponse') {
                $messagesQuery->where('response', '=', 0)->where('read', '=', 0);
            }
            if ($request->input('sortBy') == 'asCancel') {
                $messagesQuery->where('user_canceled', '=', 1)->orWhere('manager_canceled', '=', 1);
            }
            if ($request->input('sortBy') == 'asUnCancel') {
                $messagesQuery->where('user_canceled', '=', 0)->where('manager_canceled', '=', 0)
                    ->where('response', '=', 0);
            }
            if ($request->input('sortBy') == 'all') {
                $messagesQuery->get();
            }
            $messages = $messagesQuery->paginate(5)->withPath("?" . $request->getQueryString());
        } else {
            $messages = $this->messagesRepository->all();
        }

        return view('admins.messages.index', compact('messages'));
    }

    /**
     * Создание ответа к заявке.
     *
     * @return Factory|View
     */
    public function create()
    {
        $message = $this->messagesRepository->show(\request('id'));
        return view('admins.messages.response', compact('message'));
    }

    /**
     * Сохраняет ответ к заявке.
     *
     * @param ResponseMessageRequest $request
     * @param MessageResponseAction $action
     * @return RedirectResponse
     */
    public function store(ResponseMessageRequest $request, MessageResponseAction $action)
    {
        $action->execute($request->toDTO());
        return redirect()->route('admin.messages.index');
    }

    /**
     * Показывает заявку по id.
     *
     * @param Message $message
     * @return Factory|View
     */
    public function show(Message $message)
    {
        $message->read = 1;
        $this->messagesRepository->save($message);
        return view('admins.messages.show', compact('message'));
    }

    /**
     * Отмена завки.
     *
     * @param Message $message
     * @param MessageCancelingAction $action
     * @return RedirectResponse
     */
    public function destroy(Message $message, MessageCancelingAction $action)
    {
        $cancelType = \request()->input('cancelType');
        $action->execute($message, $cancelType);
        return redirect()->back();
    }
}
