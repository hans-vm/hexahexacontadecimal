<?php
/**
 * Encode hexahexacontadecimal numbers.
 * Hexahexacontadecimal is a compact format to express a number in a URL. It uses all characters allowed in a URL without escaping -- the unreserved characters -- making it the shortest possible way to express an integer in a URL.
 * @see http://www.slevenbits.com/blog/2013/08/compact-url-numbering-format-hexahexacontadecimal-now-on-pypi.html
 * @param GMP $n
 * @return string
 */
function hexahexacontadecimal_encode_int($n) {
    $base66_alphabet = str_split('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-_.~');
    $base = count($base66_alphabet);

    if (gmp_cmp($n, 0) == 0) {
        return $base66_alphabet[0];
    }
    $expr = '';
    while (gmp_cmp($n, 0) > 0) {
        $t = gmp_intval(gmp_mod($n, $base));
        $n = gmp_div_q($n, $base);
        $expr = $base66_alphabet[$t] . $expr;
    }
    return $expr;
}
