<?php

namespace App\Http\Requests;

use App\Repository\Contracts\FileRepositoryInterface;
use App\Repository\Contracts\ShareRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class ShareStoreRequest extends FormRequest
{
    private $fileRepository;

    public function __construct(FileRepositoryInterface $fileRepository)
    {
        parent::__construct();

        $this->fileRepository = $fileRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $file = $this->fileRepository->findOrFail($this->route('id'));
        return auth()->check() && $this->user()->can('share', $file);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
        ];
    }
}
