<?php

class goldbach
{

    const MIN_THRESHHOLD = 4;

    private $cap = 0;
    private $prime_sequence = [];

    public function __construct($goldBachCap)
    {
        $this->cap = $goldBachCap;
        $this->generatePrimeSequence($goldBachCap);
    }

    private function generatePrimeSequence($goldBachCap)
    {
        for ($i = 1; $i <= $goldBachCap; $i++) {
            if ($this->isPrime($i)) {
                $this->prime_sequence[] = $i;
            }
        }
    }

    private function isPrime($numberToCheck): bool
    {
        if ($numberToCheck == 1) {
            return false;
        }

        for ($i = 2; $i <= sqrt($numberToCheck); $i++) {
            if ($numberToCheck % $i == 0) {
                return false;
            }

        }
        return true;
    }

    public function output()
    {
        if ($this->isCapTooLow()) {
            return false;
        }

        for ($target = 1; $target <= $this->cap; $target++) {
            if ($this->isAnEvenNumber($target) && $this->cap >= self::MIN_THRESHHOLD) {
                foreach ($this->prime_sequence as $index => $sequencePrimeNumber1) {
                    if ($this->isFirstPrimeNumberGreaterThanTargetNumber($target, $sequencePrimeNumber1)) {
                        break;
                    }

                    foreach ($this->prime_sequence as $index => $sequencePrimeNumber2) {
                        if ($this->isSecondPrimeNumberGreaterThanDifference($target, $sequencePrimeNumber1, $sequencePrimeNumber2)) {
                            break;
                        }
                        if ($this->doesSumOfPrimeOneAndPrimeTwoEqualTarget($target, $sequencePrimeNumber1, $sequencePrimeNumber2)) {
                            $this->printGoldbachOutput($target, $sequencePrimeNumber1, $sequencePrimeNumber2);
                            break 2; //Remove this line to see all Solutions for the target #
                        }
                    }
                }
            }
        }
    }

    private function isCapTooLow()
    {
        if ($this->cap < self::MIN_THRESHHOLD) {
            print "The Goldbach Cap is set too low.  Set a higher number.";
            return true;
        } else {
            return false;
        }
    }

    private function isAnEvenNumber($number): bool
    {
        if ($number % 2 == 0) {
            return true;
        } else {
            return false;
        }
    }

    private function isFirstPrimeNumberGreaterThanTargetNumber($target, $primeNumber)
    {
        if ($primeNumber > $target) {
            return true;
        } else {
            return false;
        }
    }

    private function isSecondPrimeNumberGreaterThanDifference($target, $sequencePrimeNumber1, $sequencePrimeNumber2)
    {
        $diff = $target - $sequencePrimeNumber1;
        if ($sequencePrimeNumber2 > $diff) {
            return true;
        } else {
            return false;
        }
    }

    private function doesSumOfPrimeOneAndPrimeTwoEqualTarget($target, $sequencePrimeNumber1, $sequencePrimeNumber2)
    {
        if ($target == ($sequencePrimeNumber1 + $sequencePrimeNumber2)) {
            return true;
        } else {
            return false;
        }
    }

    private function printGoldbachOutput($primeNumber, $sequence1, $sequenc2)
    {
        print sprintf("%s = %s + %s\n", $primeNumber, $sequence1, $sequenc2);
    }
}
