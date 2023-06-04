<?php
$array = [
    ['id' => 1, 'date' => "12.01.2020", 'name' => "test1"],
    ['id' => 2, 'date' => "02.05.2020", 'name' => "test2"],
    ['id' => 4, 'date' => "08.03.2020", 'name' => "test4"],
    ['id' => 1, 'date' => "22.01.2020", 'name' => "test1"],
    ['id' => 2, 'date' => "11.11.2020", 'name' => "test4"],
    ['id' => 3, 'date' => "06.06.2020", 'name' => "test3"],
];

function removeAllIDDoubles(array $array) {
    $idDoubles = [];
    $arrayWithUniqueIDs = array_filter($array,
        function ($value) use (&$idDoubles) {
            if (!in_array($value['id'], $idDoubles)) {
                $idDoubles[] = $value['id'];
                return $value;
            }
        }
    );

    print_r($arrayWithUniqueIDs);
}

function sortArrayBySpecificKey(array $array, string $key) {
    $sortedArray = usort($array, function($a, $b) use ($key) {
        return $a[$key] <=> $b[$key];
    });

    print_r($sortedArray);
}

function returnArrayWithSpecificKeyValue(array $array, string|int $key, mixed $value) {
    $filteredArray = array_filter($array,
        function ($item) use ($key, $value) {
            if ($item[$key] === $value) {
                return $item;
            }
        }
    );

    print_r($filteredArray);
}

function generateArrayWithCustomKeyValue(array $array,  string|int $keyForKeys,  string|int $keyForValues) {
    $arrayOfKeys = array_map(
        function ($item) use ($keyForKeys) {
            return $item[$keyForKeys];
        },
        $array);

    $arrayOfValues = array_map(
        function ($item) use ($keyForValues) {
            return $item[$keyForValues];
        },
        $array);

    $customArray = array_combine($arrayOfKeys, $arrayOfValues);

    print_r($customArray);
}
