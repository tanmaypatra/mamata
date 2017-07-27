<?php
function _encode($password)
{
	$majorsalt = '';

	// if PHP5
	if (function_exists('str_split'))
	{
		$_pass = str_split($password);
	}
	// if PHP4
	else
	{
		$_pass = array();
		if (is_string($password))
		{
			for ($i = 0; $i < strlen($password); $i++)
			{
				array_push($_pass, $password[$i]);
			}
		}
	}

	// encrypts every single letter of the password
	foreach ($_pass as $_hashpass)
	{
		$majorsalt .= md5($_hashpass);
	}

	// encrypts the string combinations of every single encrypted letter
	// and finally returns the encrypted password
	return md5($majorsalt);
}

$hashed = _encode('password')."<br>";
$d = crypt($hashed, 'password');
echo $d;
echo md5('password');


$amount = '10000034000';
$amount = moneyFormatIndia( $amount );
echo $amount;

function moneyFormatIndia($num) {
    $explrestunits = "" ;
    if(strlen($num)>3) {
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if($i==0) {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}