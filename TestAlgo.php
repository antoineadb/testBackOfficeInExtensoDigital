<?php


class TestAlgo
{
    public function increment(array $a): array
    {
        $int = (int)implode('',$a) + 1 ;
        $a = [];
        for($i=0;$i<strlen("$int");$i++)
        {
            $a[] = substr($int,$i,1);
        }

        return $a;
    }

    public function fizzBuzz(int $i): void
    {
        if (0 === $i % 3 && 0 === $i % 5) {
            dump('FIZZBUZZ');
        } elseif (0 === $i % 3) {
            dump('FIZZ');
        } elseif (0 === $i % 5) {
            dump('BUZZ');
        } else {
            dump($i);
        }
    }
}