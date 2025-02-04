<?php

namespace Database\Factories\Providers;

use Faker\Provider\Base as BaseProvider;

class CpfProvider extends BaseProvider
{
    public function cpf()
    {
        $n = [];
        for ($i = 0; $i < 9; $i++) {
            $n[] = mt_rand(0, 9);
        }

        $n[9] = $this->calculateDigit($n);
        $n[10] = $this->calculateDigit($n);

        return implode('', $n);
    }

    private function calculateDigit($n)
    {
        $sum = 0;
        for ($i = 0, $j = count($n) + 1; $i < count($n); $i++, $j--) {
            $sum += $n[$i] * $j;
        }

        $remainder = $sum % 11;
        return $remainder < 2 ? 0 : 11 - $remainder;
    }
}
