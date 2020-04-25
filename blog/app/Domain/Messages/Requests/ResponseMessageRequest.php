<?php

namespace App\Domain\Messages\Requests;

use App\Domain\Messages\DTO\ResponseMessageDTO;
use Illuminate\Foundation\Http\FormRequest;

class ResponseMessageRequest extends FormRequest
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
            'response_text' => 'required',
            'message_id' => 'required|exists:messages,id'
        ];
    }

    public function toDTO()
    {
        $dto = new ResponseMessageDTO();
        $dto->response_theme = $this->input('response_theme');
        $dto->response_text = $this->input('response_text');
        $dto->message_id = $this->input('message_id');
        return $dto;
    }
}
