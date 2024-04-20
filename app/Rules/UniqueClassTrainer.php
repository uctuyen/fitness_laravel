<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\classModel;
class UniqueClassTrainer implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
    public function passes($attribute, $value)
    {
        $classId = request()->get('id');
        $trainerId = request()->get('trainer_id');

        return !classModel::where('id', $classId)
                        ->where('trainer_id', $trainerId)
                        ->exists();
    }

    public function message()
    {
        return 'Lớp này của huấn luyện viên này đã được tạo rồi.';
    }
}
