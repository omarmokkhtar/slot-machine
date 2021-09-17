<?php
namespace App\Service;


use Illuminate\Http\Response;
use PHPUnit\Util\Json;

class SlotService
{
    protected $betAmount = 100; //equivalent to 1 euro

    protected $symbols = [
        '9',
        '10',
        'j',
        'q',
        'k',
        'a',
        'cat',
        'dog',
        'monkey',
        'bird',
    ];

    protected $payLines = [
        [0, 3, 6, 9, 12],
        [1, 4, 7, 10, 13],
        [2, 5, 8, 11, 14],
        [0, 4, 8, 10, 12],
        [2, 4, 6, 10, 14],
    ];

    //change the board size
    protected $boardSize = 15;

    protected $board = [];

    // the pay-out return to the winners
    protected $payOutReturn = [
        3 => 0.2,
        4 => 2,
        5 => 10,
    ];

    /**
     * Generate a random board depends on the defined symbols and the board size.
     */
    protected function generateBoard()
    {
        $symbolsCount = count($this->symbols) - 1;
        for ($cell = 0; $cell < $this->boardSize; $cell++) {
            $symbol = rand(0, $symbolsCount);
            $this->board[] = $this->symbols[$symbol];
        }
    }

    /**
     * Generate a random board depends on the defined symbols and the board size.
     * @return string $result The returned string contains JSON
     */
    public function checkForSimilarities(): string
    {
        $this->generateBoard();
        $data = [
            'board'      => $this->board,
            'payLines'   => [],
            'bet_amount' => $this->betAmount,
            'total_win'  => 0
        ];

        //Loop on the array of the payLines
        foreach ($this->payLines as $payLine) {
            $prevSymbol = null;
            $matched = 1;
            //Loop on every payLine individually
            foreach ($payLine as $symbolIndex) {
                $payLineSymbol = $this->board[$symbolIndex];
                ($payLineSymbol == $prevSymbol) ? $matched++ : $matched = 1;
                $prevSymbol = $payLineSymbol;
            }
            if ($matched >= min(array_keys($this->payOutReturn))) {
                $data['payLines'][]= array('payLine' => $payLine, 'matched' => $matched);
                $data['total_win'] += $this->payOutReturn[$matched] * $this->betAmount;
            }
        }

       return json_encode($data);

    }

}

