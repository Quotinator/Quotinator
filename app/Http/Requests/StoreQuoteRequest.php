<?php

namespace Quotinator\Http\Requests;

use Quotinator\Http\Requests\Request;

class StoreQuoteRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $quote = $this->route('quote');
        if ($quote !== null)
        {
          if ($quote->user->id != \Auth::User()->id) return false;
        }
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
          'title' => 'required|max:255',
          'quote' => 'required',
        ];
    }
}
