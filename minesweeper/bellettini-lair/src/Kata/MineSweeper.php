<?php
namespace Kata;

class MineSweeper
{
    public function run($field)
    {
        $output = 'Field #1' . PHP_EOL;

        $lines = explode(PHP_EOL, $field);

        sscanf(
            array_shift($lines),
            '%d %d',
            $rows,
            $columns
        );

        $map = [];

        for ($i = 0; $i < $rows; $i++) {
            $line = trim(array_shift($lines));

            for ($j = 0; $j < $columns; $j++) {
                $cell = $line[$j];

                if ($this->isBomb($cell)) {
                    $map[$i][$j] = $cell;
                } else {
                    $map[$i][$j] = (string)$this->neighbours($map, $i, $j);
                }
            }

        }

        var_dump($map);

        $i = 0;

        foreach ($map as $row) {
            foreach ($row as $cell) {
                $output .= $cell;
            }

            if (++$i < $rows) {
                $output .= PHP_EOL;
            }
        }

        return $output;
    }

    private function isBomb($cell)
    {
        return $cell === '*';
    }

    private function neighbours(array $map, $row, $column)
    {
        $neighbourList = [
            [$row - 1, $column - 1],
            [$row - 1, $column    ],
            [$row - 1, $column + 1],
            [$row    , $column - 1],
            [$row    , $column + 1],
            [$row + 1, $column - 1],
            [$row + 1, $column    ],
            [$row + 1, $column + 1],
        ];

        var_dump($neighbourList);

        $neighbours = 0;

        foreach ($neighbourList as $idx) {
            list ($i, $j) = $idx;

            if (isset($map[$i][$j]) && $this->isBomb($map[$i][$j])) {
                $neighbours++;
            }
        }


        return $neighbours;
    }
}
