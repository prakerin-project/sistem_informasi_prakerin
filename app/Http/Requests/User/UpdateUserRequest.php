<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Rules\LowerCaseValidation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'username'      => ['required', 'string', 'max:20', new LowerCaseValidation],
            'password'      => ['required', 'string'],
            'nama'          => ['required', 'max:100', 'string'],
            'no_telp'       => ['required', 'max:16'],
            'jenis_kelamin' => ['required', 'in:L,P'],
        ];
        //add more rules according to role requested
        switch ($this->role) {
            case 'tu':
                $rules = array_merge($rules, ['nip' => ['required', 'max:20']]);
                break;
            case 'hubin':
                $rules = array_merge($rules, ['nip' => ['required', 'max:20']]);
                break;
            case 'walas':
                $rules = array_merge($rules, [
                    'nip'      => ['required', 'max:20'],
                    'id_kelas' => ['required', 'integer']
                ]);
                break;
            case 'kaprog':
                $rules = array_merge($rules, [
                    'nip'        => ['required', 'max:20'],
                    'id_jurusan' => ['required', 'integer']
                ]);
                break;
            case 'pb_sekolah':
            case 'pb_industri':
                $rules = array_merge($rules, [
                    'nip_nik'    => ['required', 'max:20'],
                    'lingkup'    => ['required', 'in:sekolah,industri'],
                    'id_jurusan' => ['required', 'integer'],
                    'email'      => ['required', 'email'],
                ]);
                break;
            case 'siswa':
                $rules = array_merge($rules, [
                    'nis'           => ['required', 'max:12'],
                    'id_kelas'      => ['required', 'integer'],
                    'email'         => ['required', 'email'],
                    'tahun_masuk'   => ['required', 'date_format:Y'],
                    'tempat_lahir'  => ['required', 'max:30'],
                    'tanggal_lahir' => ['required', 'date_format:Y-m-d'],
                    'alamat'        => ['required', 'string'],
                    'no_telp_wali'  => ['required', 'max:16'],
                ]);
                break;
        }
        return $rules;
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->getMessageBag()
        ], 400));
    }
}