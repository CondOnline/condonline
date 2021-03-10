<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        $passwordRule = new Password();

        $passwordRule->length(8); //Tamanho da senha
        //$passwordRule->requireNumeric(); //Requer Numero
        //$passwordRule->requireUppercase(); //Requer letra maiuscula
        //$passwordRule->requireSpecialCharacter(); //Requer caracter especial


        return ['required', 'string', $passwordRule, 'confirmed'];
    }
}
