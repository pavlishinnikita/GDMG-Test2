const prepare = (number) => {
    let divRes = number;
    let digit;
    const digits = [];
    const words = [
        [
            'одна тысяча',
            'две тысячи',
            'три тысячи',
            'четыре тысячи',
            'тысяч'
        ],
        [
            'сто',
            'двести',
            'триста',
            'четыреста',
            'пятьсот',
            'шестьсот',
            'семьсот',
            'восемьсот',
            'девятьсот',
        ],
        [
            'ноль',
            'десять',
            'двадцать',
            'тридцать',
            'сорок',
            'пятьдесят',
            'шестьдесят',
            'семьдесят',
            'восемьдесят',
            'девяносто'
        ],
        [
            'ноль',
            'один',
            'два',
            'три',
            'четыре',
            'пять',
            'шесть',
            'семь',
            'восемь',
            'девять',
            'десять',
            'одинадцать',
            'двенадцать',
            'тринадцать',
            'четырнадцать',
            'пятнадцать',
            'шестнадцать',
            'семнадцать',
            'восемнадцать',
            'девятнадцать'
        ]
    ];
    do {
        digit = divRes % 10;
        divRes -= digit;
        divRes /= 10;
        digits.push(digit);
    } while (divRes > 0);

    let digitsString = [];

    let thousands = digits[3];
    let hundreds = digits[2];
    let decimals = digits[1];
    let units = digits[0];

    // check thousands
    if(thousands < 5) {
        digitsString.push(words[0][thousands - 1]);
    } else if(thousands >= 5) {
        digitsString.push(`${words[3][thousands]} ${words[0][4]}`);
    }
    // check thousands

    // add hundreds
    digitsString.push(words[1][hundreds - 1]);
    // add hundreds

    // check decimals
    if(decimals > 1) {
        digitsString.push(words[2][decimals]);
    }
    if(decimals === 1) {
        // console.log('test', decimals);
        units += 10;
    }
    // console.log('dec', decimals);
    console.log('units', units);
    // check decimals

    // check units
    if(!(digits.length > 1 && units === 0)) {
        digitsString.push(words[3][units]);
    }
    // check units
    

    return digitsString.join(' ').trim();
}


let test = [ 0, 1, 2, 3, 4, 7, 10, 11, 12, 16, 20, 25, 36, 156, 500, 111, 201, 310, 1000, 1001, 2010, 3100, 777, 1562, 3001, 6231, 7200, 9999];

console.log('200', prepare(200));
console.log('201', prepare(201));
console.log('210', prepare(210));
console.log('213', prepare(213));

console.log('2000', prepare(2000));
console.log('2001', prepare(2001));
console.log('2010', prepare(2010));
console.log('2011', prepare(2011));
console.log('2100', prepare(2100));
console.log('2101', prepare(2101));
console.log('2110', prepare(2110));
console.log('2111', prepare(2111));



test.map( (it) => {
    console.log(`${it} | ${prepare(it)}`);
});

