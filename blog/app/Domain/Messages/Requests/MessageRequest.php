<?php

namespace App\Domain\Messages\Requests;

use App\Domain\Messages\DTO\MessageDTO;
use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'theme' => 'required',
            'message' => 'required',
            'file' => 'file',
        ];
    }

    public function toDTO()
    {
        $dto = new MessageDTO();
        $dto->theme = $this->input('theme');
        $dto->message = $this->input('message');
        $dto->user_id = $this->user()->id;

        if ($this->has('response')) {
            $dto->response = $this->input('response');
            $dto->response_theme = $this->input('response_theme');
            $dto->response_text = $this->input('response_text');
        }

        if ($this->hasFile('file')) {
            $dto->file = $this->file('file');
            $dto->size = $this->file('file')->getSize();
            $dto->mime = $this->file('file')->getMimeType();
        }

        return $dto;
    }
}
