<?

function getCraftmannPrefix()
{
	$Prefix = "Внешний аккумулятор" . " ";
	return $Prefix;
}

function getCraftmannMainProperties()
{
	$CraftmanMainProperties = array('CAPACITY', 'WARRANTY', 'COLOR_UNIVERSAL', 'ARTICLE', 'COMPLECT');
	return $CraftmanMainProperties;
}


function getCraftmanAllProperties()
{
	$CraftmanAllProperties = array(
            'ARTICLE',
            'CAPACITY',
            'POWER',
            'VOLTAGE',
            'CURRENT',
            'CAPACITY_COEFF',
            'COLOR_UNIVERSAL',
            'WEIGHT',
            'SIZE',
            'MATERIAL',
            'TYPE',
            'CERTIFICATION',
            'WARRANTY',
            'COMPLECT',
            'SERIES',
            'EAN_13',
            'DISCONTINUED'
        );
	return $CraftmanAllProperties;
}


?>