    <?php

function getWeatherStringMeppel()
{
    $BASE_URL = "http://query.yahooapis.com/v1/public/yql";
    $yql_query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="Meppel, NL")';
    $yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=xml";

    $reader = new XMLReader();
    $tempLocation = 0;
    $tempText = '';
    $tempCode = '';
    $location = '';

    if (!$reader->open($yql_query_url))
    {
        print "can't read link";
    }

    while ($reader->read())
    {
        if ($reader->nodeType == XMLReader::ELEMENT)
        {
            $name = $reader->name;

            if ($name == 'yweather:location')
            {
                $location = $reader->getAttribute('city');
            }

            if ($name == 'yweather:condition')
            {
                $tempText = $reader->getAttribute('text');
                $tempCode = $reader->getAttribute('code');
                $tempLocation = $reader->getAttribute('temp');
            }
        }

        if (in_array($reader->nodeType, array(XMLReader::TEXT, XMLReader::CDATA, XMLReader::WHITESPACE, XMLReader::SIGNIFICANT_WHITESPACE)) && $name != '')
        {
            $value = $reader->value;
        }
    }
    return $location." ".round(($tempLocation - 32 ) * 0.55)." &#8451; ";
}
?>
<!DOCTYPE html>
<html>
    <head>

    <body>
        <?php
        $weerstring = getWeatherStringMeppel();
        $weerarray = explode(" ", $weerstring, $limit = 4);
        $celcius = ($weerarray[1] - 32 ) * 0.55;

        function achtergrond()
        {
            $weerstring = getWeatherStringMeppel();
            $weerarray = explode(" ", $weerstring, $limit = 4);

            $locatie = $weerarray[0];
            $weercode = $weerarray[2];
            $temp = $weerarray[1];
            $weernaam = $weerarray[3];

            switch ($weercode)
            {
                case 1:
                case 2:
                case 3:
                case 4: echo "thunder";
                    break;
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                case 10: echo "snow";
                    break;
                case 11:
                case 12: echo "rain";
                    break;
                case 13:
                case 14:
                case 15:
                case 16: echo "snow";
                    break;
                case 17:echo "hail";
                case 18:
                case 19:
                case 20:
                case 21:
                case 22:
                case 23:
                case 24: echo "cloudy";
                    break;
                case 25: echo "snow";
                    break;
                case 26:
                case 27:
                case 28:
                case 29:
                case 30:echo "cloudy";
                    break;
                case 31:
                case 32:
                case 33:
                case 34:echo "clear";
                    break;
                case 35:echo "hail";
                    break;
                case 36:echo "clear";
                    break;
                case 37:
                case 38:
                case 39:
                case 40:
                case 41:
                case 42:echo "rain";
                    break;
                default:echo "rain";
            }
        }
        ?>
    </body>
</html>