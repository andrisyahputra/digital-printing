<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'alamat' => ['nullable'],
            'notelp' => ['required', 'string', 'max:13'],
            'nowa' => ['required', 'string', 'max:13'],
            'foto' => ['required', 'image', 'mimes:png,jpg', 'max:1000'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
